<?php

	echo date("j/n/Y");
	$fecha = date("nj");
	$estacion;

	switch ($fecha) 
	{
		case ($fecha >= 321 && $fecha <= 620):
			$estacion = "Otoño";
			break;
		case ($fecha >= 621 && $fecha <= 820):
			$estacion = "Invierno";
			break;
		case ($fecha >= 821 && $fecha <= 1220):
			$estacion = "Primavera";
			break;
		default:
			$estacion = "Verano";
			break;
	}


	echo " $estacion";

?>