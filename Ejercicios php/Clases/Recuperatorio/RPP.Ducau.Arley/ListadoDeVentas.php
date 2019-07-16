<?php
	
	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);
	error_reporting(E_ALL);
	
	include "manejoArchivos.php";

	$ventas = leer("Venta.txt");
	$hay = 0;

	foreach ($ventas as $item) 
	{
		foreach ($item as $key) 
		{
			if ($item != "")
			{
				echo $key . " ";
				$hay ++;
			}
		}
	}

	if($hay == 0)
	{
		echo "No hay ventas";
	}



?>