<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Css -->
    <link href="../Assets/boostrap/css/bootstrap.min2.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- <link rel="stylesheet" href="./Assets/js/dist/sweetalert.css"> -->
    <link rel="stylesheet" href="../Assets/js/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="../Assets/css/style.css">
    <title>Inicio</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">   
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <form name="FormCrearUsuario" id="FormCrearUsuario" method="post" enctype="multipart/form-data" data-parsley-validate>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombres</label>
                        <div class="input-group flex-nowrap">   
                            <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person-fill"></i></span>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre" aria-label="nombre" aria-describedby="addon-wrapping">
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
                            <input type="number" class="form-control" id="tel" name="tel" placeholder="Teléfono" aria-label="Telefono" aria-describedby="addon-wrapping">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">email</label>
                        <div class="input-group flex-nowrap">   
                            <span class="input-group-text" id="addon-wrapping"><i class="bi bi-envelope-fill"></i></span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" aria-label="email" aria-describedby="addon-wrapping">
                        </div>
                    </div>
                    <input type="hidden" name="case" value="CrearUsuario">
                    <button type="submit" name="CrearusuarioBtn" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8 table-responsive">
                <table class="table table-bordered table-striped " id="ListarUsuarios">
                    <thead>
                        <tr>
                        <th class="cell">#</th>
                        <th class="cell">Nombre</th>
                        <th class="cell">Telefono</th>
                        <th class="cell">Imagen</th>
                        <th class="cell">Estado</th>
                        <th class="cell">Opciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


    <!-- JavasCripts -->
    
    <script src="../Assets/js/usuarios.js"></script>
    <!-- <script src="./Assets/js/dist/sweetalert.js"></script> -->
    <script src="../Assets/js/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="../Assets/boostrap/js/bootstrap.bundle.min.js"></script>
   
    <script language="JavaScript" type="text/javascript">
		$(document).ready(function(){
			procesosInsertarProducto.initInsertarUsario();
            App.init();
            
		});
	</script>
</body>
</html>