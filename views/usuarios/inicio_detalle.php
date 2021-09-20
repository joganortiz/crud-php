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
    <link rel="stylesheet" href="../Assets/css/style.css">
    <title>Usuario Detalles</title>
</head>
<body>
<div class="container mt-5">
        <div class="row">   
            <div class="col-sm-12 col-md-4 col-lg-6 col-xl-6 mtgl">
                <form name="FormEditarUsuario" id="FormEditarUsuario" method="post">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombres</label>
                        <div class="input-group flex-nowrap">   
                            <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person-fill"></i></span>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $arrData["nombre"] ?>" placeholder="nombre" aria-label="nombre" aria-describedby="addon-wrapping">
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
                        <input style="height: 25px; width: 50px; cursor:pointer;" class="form-check-input" type="checkbox" id="estado"  name="estado" value="1" <?php echo (($arrData["estado"]==1)?'checked':''); ?> disabled> <label class="form-check-label mt-1"> &nbsp;&nbsp; Estado</label>
                    </div>
                    <div class="mb-3 mt-3">
                        <a href="usuarios" type="submit" name="EditarusuarioBtn" class="btn btn-primary">Regresar</a>
                    </div>
                </form>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-6 col-xl-6 table-responsive">
                <div class="container">
                    <div class="row">
                        <center>
                        <?php if(!empty($arrData["imagen"])){ ?>
                            <img src="../Assets/img/usuarios/<?php echo $_GET["id"].'/'.utf8_decode($arrData["imagen"] ) ?>" class="img-thumbnail imagen" title="<?php echo $arrData["imagen"]?>" alt="<?php echo $arrData["imagen"]?>" style="height: 400px;width: 400px; object-fit: cover; display: block; margin-left: auto; margin-right: auto;">
                        <?php }else{ ?>
                            <img src="../Assets/img/default.png"  class="img-thumbnail" title="<?php echo $arrData["imagen"]?>" class="img-thumbnail imagen" alt="default.png" style="height: 400px;width: 400px;object-fit: cover; display: block; margin-left: auto; margin-right: auto;">
                        <?php } ?>
                        </center>
                    </div>
                </div>
                
            </div>
        </div>
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