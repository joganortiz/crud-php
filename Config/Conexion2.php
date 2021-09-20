<?php 

function conexiondb(){
	
	$servidor 	= 'localhost';
	$usuario 	= "root";
	$pass 		= "";
	$base_datos = "crud_usuarios";

	$conexion = new mysqli($servidor, $usuario, $pass, $base_datos);
	$conexion->set_charset("utf8");

	if($conexion->connect_errno){
	    printf("Conexión fallida: %s\n", $conexion->connect_error);
	    exit();
	}

	return $conexion;
}
?>