<?php 
require_once("../../Libraries/includes.php");

	class Usuarios extends Conexion{
		private $intIdUsuario;
		private $strNombre;
		private $strImagen;
		private $intTelefono;
		private $strEmail;
		private $strestado;
		private $conexion;

		public function __construct(){
			$this->conexion = new Conexion();
			$this->conexiondb = $this->conexion->connect();
		}

		public function cargar_imagenes($id, $donde, $imagen, $ruta=0){

			switch($donde){
	
				case '4':
					$encontrado = false;
					if ($ruta==1) {
						$route = '../../Assets/img/usuarios/';
					}else{
						$route = '../../../Assets/img/usuarios/';
					}
					if(file_exists($route.$id.'/'.$imagen) && $imagen!=''){
	
						return '
							<img src="../Assets/img/usuarios/'.$id.'/'.utf8_decode($imagen).'" class="img-thumbnail" style="height: 40px;width: 40px;object-fit: cover; display: block; margin-left: auto; margin-right: auto;">';
							$encontrado = true;
						break;
					}
	
					if(!$encontrado){
						return '<img src="../Assets/img/default.png"  style="height: 40px;width: 40px;object-fit: cover; display: block; margin-left: auto; margin-right: auto;">';
					}
				break;
				
				default:
				break;
			}	
		}

		public function INSERT_Usuario($nombre, $telefono, $email, $imagen)
		{
			$this->strNombre = $nombre;
			$this->intTelefono = $telefono;
			$this->strEmail = $email;
			$this->strImagen = $imagen;

			$sql = "INSERT INTO usuarios(nombre,telefono,email,imagen) VALUES(?,?,?,?)";
			$insert = $this->conexiondb->prepare($sql);
			$arrData = array($this->strNombre,$this->intTelefono,$this->strEmail, $this->strImagen);
			$resInsert = $insert->execute($arrData);
			$idInsert = $this->conexiondb->lastInsertId();
			if($resInsert){
				$result = array('rps' => true, 'id' => $idInsert);
			}else{
				$result = array('rps' => false, 'id' => '');
			}
	
			return $result;
		}

		public function Listar_SELECT_Usuarios()
		{
			$sql = "SELECT id, nombre, telefono, imagen, status, sluck FROM usuarios WHERE estado_usuario='1' ORDER BY id ASC";
        	$result = $this->conexiondb->prepare($sql);
			$result->execute();
        	$data = $result->fetchall(PDO::FETCH_ASSOC);
        	return $data;
		}

		public function SELECT_Usuario($id)
		{
			$conexiondb = conexiondb();
			$sql = "SELECT id, nombre, telefono, email, imagen, status FROM usuarios WHERE id = $id";
        	$sentencia = $conexiondb->prepare($sql);
			
			$sentencia->execute();
			$sentencia->bind_result($id, $nombre,$telefono,$email, $imagen, $status);
				
			//Numero de resultados
			$sentencia->store_result();
			if($sentencia->num_rows>0){
				$existe = true;
				$sentencia->fetch();
				$result = array(
					"id" 		=> $id,
					"nombre"	=> $nombre,
					"telefono"	=> $telefono,
					"email"	=> $email,
					"estado" => $status,
					"imagen" => $imagen
				);
			}else{
				$existe = false;
				$result = array("id" => '', "nombre" => '', "telefono" => '', "email" => '', "estado" => '', "imagen" => '');
			}
	
			//Cierre de conexion
			$conexiondb->close();
	
			return $result;
		}

		public function DELETE_Usuario($id)
		{
			$this->intIdUsuario = $id;

			$sql = "UPDATE usuarios SET estado_usuario = '0' WHERE id = $this->intIdUsuario ";

			$result = $this->conexiondb->prepare($sql);
			if($result->execute()){
				$result = true;
			}else{
				$result = false;
			}
        	return $result;
		}

		public function UPDATE_Usuario($id, $imagen, $nombre, $telefono, $email, $estado){
			$this->strNombre = $nombre;
			$this->intTelefono = $telefono;
			$this->strEmail = $email;
			$this->strestado = $estado;
			$this->intIdUsuario = $id;
			$this->strImagen = $imagen;

			$sql = "UPDATE usuarios SET imagen =?, nombre=?, telefono=?, email=?, status= ? WHERE id = ?";
			$insert = $this->conexiondb->prepare($sql);
			$arrData = array($this->strImagen, $this->strNombre,$this->intTelefono,$this->strEmail, $this->strestado, $this->intIdUsuario);
			$resInsert = $insert->execute($arrData);

			if($resInsert){
				$result = true;
			}else{
				$result = false;
			}
        	return $result;

		}

	}

?>