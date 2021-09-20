<?php
    require_once("../../Libraries/includes.php");
    $objUsuario = new Usuarios();
    $arrData = $objUsuario->SELECT_Usuario(Encrypter::decryption($_GET["id"]));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Css -->
     <link href="../Assets/boostrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../Assets/js/sweetalert2/sweetalert2.min.css">
    <title>Usuario Editar</title>
</head>
<body>
    <div class="container col-8">
       
        <form name="FormEditarUsuario" id="FormEditarUsuario" method="post">
            
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombres</label>
                <div class="input-group flex-nowrap">   
                    <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person-fill"></i></span>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $arrData["nombre"] ?>" placeholder="nombre" aria-label="nombre" aria-describedby="addon-wrapping">
                </div>
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">imagen</label>
                <div class="input-group flex-nowrap">   
                    <span class="input-group-text" id="addon-wrapping"><i class="bi bi-image"></i></span>
                    <input type="file" class="form-control" id="imagen" name="imagen" aria-describedby="addon-wrapping">
                </div>
            </div>
            <div class="mb-3">
                <label for="tel" class="form-label">Telefono</label>
                <div class="input-group flex-nowrap">   
                    <span class="input-group-text" id="addon-wrapping"><i class="bi bi-telephone-fill"></i></span>
                    <input type="number" class="form-control" id="tel" name="tel" value="<?php echo $arrData["telefono"] ?>" placeholder="Teléfono" aria-label="Telefono" aria-describedby="addon-wrapping">
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <div class="input-group flex-nowrap">   
                    <span class="input-group-text" id="addon-wrapping"><i class="bi bi-envelope-fill"></i></span>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $arrData["email"] ?>"placeholder="Correo electrónico" aria-label="email" aria-describedby="addon-wrapping">
                </div>
            </div>
            <div class="form-check form-switch">
                <input style="height: 25px; width: 50px; cursor:pointer;" class="form-check-input" type="checkbox" id="estado"  name="estado" value="1" <?php echo (($arrData["estado"]==1)?'checked':''); ?> > <label class="form-check-label mt-1"> &nbsp;&nbsp; Estado</label>
            </div>
            <div class="mb-3 mt-3">
                <input type="hidden" name="id" value="<?php echo $_GET["id"]?>">
                <input type="hidden" name="case" value="EditarUsuario">
                <button type="submit" name="EditarusuarioBtn" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

   <!-- JavasCripts -->
   <script src="../Assets/js/usuarios.js"></script>
    <script src="../Assets/js/sweetalert2/sweetalert2.min.js"></script>
    <script src="../Assets/js/tinymce/tinymce.min.js"></script>
    <script src="../Assets/js/plugins/pace.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script>
		$(document).ready(function(){
			procesosEditarUsuario.initEditarUsario();
            App.init();
            
		});
	</script>
</body>
</html>