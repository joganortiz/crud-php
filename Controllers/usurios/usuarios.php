<?php
require_once("../../Libraries/includes.php");

//Se toma la peticion
$post = $get = false;
if(!empty($_POST["case"])){
	$post = true;
	$caseProcess = $_POST["case"];
}else if(!empty($_GET["case"])){
	$get = true;

	$caseProcess = $_GET["case"];
	
}else{
	$caseProcess = 0;
}

//Se verifique cual es la peticion y se realiza el proceso
switch($caseProcess){
	case 'ListarUsuarios':
        $objUsuario = new Usuarios();
        $arrData = $objUsuario->Listar_SELECT_Usuarios();
        for ($i=0; $i < count($arrData); $i++) {
            
            $btnEdit = '';
            $btnDelete = '';
            $arrData[$i]['#']= $i +1;
            $datalle ="";
            if($arrData[$i]['status'] == 1){
                $arrData[$i]['status'] = '<span class="badge bg-success botones"><i class="bi bi-hand-thumbs-up-fill"></i> Activo </span>';
            }else{
                $arrData[$i]['status'] = '<span class="badge bg-danger botones"><i class="bi bi-hand-thumbs-down-fill"></i> Inactivo </span>';
            }
            $datalle = '<div class="btn-group">
                            <a type="button" class="btn btn-lg dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-gear-fill"></i> acciones
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="usuarios-detalle-'. Encrypter::encryption($arrData[$i]['id']).'"><i class="bi bi-file-richtext"></i>  Ver detalle</a></li>
                                <li><a class="dropdown-item" href="usuarios-editar-'. Encrypter::encryption($arrData[$i]['id']).'" title="Editar usuario"><i class="bi bi-pencil-square"></i> Editar</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a href="#" class="dropdown-item btnDelUsuario" data-control="'.Encrypter::encryption($arrData[$i]['id']).'" title="Eliminar usuario"><i class="bi bi-trash"></i> Eliminar</a></li>
                            </ul>
                        </div>';
            //$btnEdit = '<a href="usuarios-editar-'. Encrypter::encryption($arrData[$i]['id']).'" class="btn btn-warning btn-sm" title="Editar usuario"><i class="bi bi-receipt"></i></a>';
            //$btnDelete = '<button class="btn btn-danger btn-sm btnDelUsuario" data-control="'.Encrypter::encryption($arrData[$i]['id']).'" title="Eliminar usuario"><i class="bi bi-trash-fill"></i></button>';
            $id_encriptado = Encrypter::encryption($arrData[$i]['id']);
            $arrData[$i]['imagen'] = $objUsuario->cargar_imagenes($id_encriptado, 4, $arrData[$i]['imagen'], 1);

            $arrData[$i]['options'] = $datalle;
        }
		echo json_encode( $arrData,JSON_UNESCAPED_UNICODE);
        
    break;

    case 'CrearUsuario':

        $objUsuario = new Usuarios();
        $nombre = $_POST["nombre"];
        $telefono = $_POST["tel"];
        $email = $_POST["email"];
        $imagen = $_FILES["imagen"]["name"];

        if(!empty($nombre)){
            $respuesta = $objUsuario->INSERT_Usuario($nombre, $telefono, $email, $imagen);

            if($respuesta['rps'] == true){
                $id_encrip	= $respuesta['id'];
				$id_contenido 	= Encrypter::encryption($id_encrip);

                if(isset($_FILES["imagen"]) && $_FILES["imagen"]["name"]){
					$permitidos = array("image/jpg", "image/jpeg", "image/png");

                    if(!in_array($_FILES['imagen']['type'], $permitidos)){
						$continue = array("accion" => false, "mensaje" => "no guardado", "resultado" => $caseProcess);
						$continuar = false;
					}

                    if (!file_exists('../../Assets/img/usuarios')) {
						mkdir("../../Assets/img/usuarios" , 0777, true);
						chmod("../../Assets/img/usuarios",0777);
					}

                    if (!file_exists('../../Assets/img/usuarios')) {
						mkdir("../../Assets/img/usuarios" , 0777, true);
						chmod("../../Assets/img/usuarios",0777);
					}

					if (!file_exists('../../Assets/img/usuarios/'.$id_contenido)) {
						mkdir("../../Assets/img/usuarios/".$id_contenido , 0777, true);
						chmod("../../Assets/img/usuarios/".$id_contenido, 0777);
					}

                    $carpeta = "../../Assets/img/usuarios/".$id_contenido;
					file_put_contents("../../Assets/img/usuarios/index.php", "<?php \r\n exit; \r\n ?>");
					file_put_contents("../../Assets/img/usuarios/".$id_contenido."/index.php", "<?php \r\n exit; \r\n ?>");
					file_put_contents($carpeta."/index.php", "<?php \r\n exit; \r\n ?>");

                    $file_name=$_FILES["imagen"]["name"];
                    $directorio =$carpeta.'/'.$file_name; // -> organizamos toda la direccion del directorio
                    $fupload = new Upload();
                    $fupload->setPath($carpeta);
                    $fupload->setFile("imagen", false);
                    $fupload->isImage(true);

                    $fupload->save();
                }
                $continue = array('status' => true, 'titulo' => '¡Buen trabajo!', 'msg' => 'El Usuario fue Creado correctamente.');
            }/*else{
                $continue = array("status" => false, 'titulo' => '¡Error!', "msg" => 'Error al crear usuario, comuniquese con soporte.');
            }*/


        }else{
            $continue = array("status" => false, "titulo" => "¡Oops...!", "msg" => "El campo Nombre no debe estar vacio.");
        }

        echo json_encode($continue,JSON_UNESCAPED_UNICODE);
    break;

    case 'EditarUsuario':
        $conexiondb 		= conexiondb();
        $objUsuario = new Usuarios();
        $id = $conexiondb->real_escape_string(Encrypter::decryption($_POST["id"]));
        $nombre = $conexiondb->real_escape_string($_POST["nombre"]);
        $telefono = $conexiondb->real_escape_string($_POST["tel"]);
        $email = $conexiondb->real_escape_string($_POST["email"]);
        $estado = $conexiondb->real_escape_string(((!empty($_POST["estado"]))?1:0));
        $imagen_guardada = $objUsuario->SELECT_Usuario($id)["imagen"];
        $id_contenido 	=$_POST["id"];

        if(isset($_FILES["imagen"]) && $_FILES["imagen"]["name"]){
            $imagen = $conexiondb->real_escape_string($_FILES["imagen"]["name"]);

            if (file_exists('../../Assets/img/usuarios'.$id_contenido)) {
                chmod('../../Assets/img/usuarios'.$id_contenido,0777);
                unlink('../../Assets/img/usuarios'.$id_contenido);
            }

            $permitidos = array("image/jpg", "image/jpeg", "image/png"); #Creamos un array que contengan los archivos que permitiremos
            if(!in_array($_FILES['imagen']['type'], $permitidos)){
                $continue = array("accion" => false, "mensaje" => "ajax_ticket_3", "resultado" => $caseProcess);
                $continuar = false;
            }

            if (!file_exists('../../Assets/img')) {
                mkdir("../../Assets/img" , 0777, true);
                chmod("../../Assets/img",0777);
            }

            if (!file_exists('../../Assets/img/usuarios')) {
                mkdir("../../Assets/img/usuarios" , 0777, true);
                chmod("../../Assets/img/usuarios",0777);
            }

            if (!file_exists('../../Assets/img/usuarios/'.$id_contenido)) {
                mkdir("../../Assets/img/usuarios/".$id_contenido , 0777, true);
                chmod("../../Assets/img/usuarios/".$id_contenido,0777);
            }

            $carpeta = "../../Assets/img/usuarios/".$id_contenido;
            file_put_contents("../../Assets/img/usuarios/index.php", "<?php \r\n exit; \r\n ?>");
            file_put_contents("../../Assets/img/usuarios/".$id_contenido."/index.php", "<?php \r\n exit; \r\n ?>");
            file_put_contents($carpeta."/index.php", "<?php \r\n exit; \r\n ?>");

             #Inicamos el proceso para guardar los archivos en la carpeta
            $file_name=$_FILES["imagen"]["name"];
            $directorio =$carpeta.'/'.$file_name; // -> organizamos toda la direccion del directorio
            $fupload = new Upload();
            $fupload->setPath($carpeta);
            $fupload->setFile("imagen", false);
            $fupload->isImage(true);

            $fupload->save();
        }else {
            $imagen=$imagen_guardada;
        }

        if(!empty($nombre)){
            if($objUsuario->UPDATE_Usuario($id, $imagen, $nombre, $telefono, $email, $estado)){

                $continue = array("status" => true, "titulo" => "¡Buen trabajo!", "texto" => "El Usuario fue Actualizado correctamente.");
            }/*else{
                $continue = array("accion" => false, "mensaje" => array("titulo" => "¡Error!", "texto" => "Algo salio mal."), "resultado" => '');
            }*/
        }else{
            $continue = array("status" => false, "titulo" => "¡Oops...!", "texto" => "El campo Nombre no debe estar vacio.");
        }

        echo json_encode($continue,JSON_UNESCAPED_UNICODE);
    break;

    case 'eliminarUsuario':
        $objUsuario = new Usuarios();
        $conexiondb 		= conexiondb();
        $id = $conexiondb->real_escape_string(Encrypter::decryption($_POST["id"]));
        
        if($objUsuario->DELETE_Usuario($id)){
			$continue = array("status" => true, "titulo" => "¡Eliminado!", "msg" => "El Usuario fue Eliminado correctamente.", "resultado" => $_POST["id"] );
		}/*else{

			$continue = array("status" => false, "mensaje" => array("titulo" => "error", "msg" => "Algo salio mal, Intentelo mas tarde."), "resultado" => '' );	
		}*/

        echo json_encode($continue,JSON_UNESCAPED_UNICODE);
    break;
    
}


?>