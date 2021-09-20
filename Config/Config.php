<?php 
	
	//define("BASE_URL", "http://localhost/tienda_virtual/");
	const BASE_URL = "./proyecto_tienda";

	//Zona horaria
	date_default_timezone_set('America/Bogota');

	//Deliminadores decimal y millar Ej. 24,1989.00
	const SPD = ".";
	const SPM = ",";

	//Simbolo de moneda
	const SMONEY = "COP ";


	//Retorla la url del proyecto
	function base_url()
	{
		return BASE_URL;
	}

	


 ?>