<?php

	echo date("j/n/Y");
	$fecha = date("nj");
	$estacion;

	switch ($fecha) 
	{
		case $fecha >= 321:
		case $fecha <= 620:
			$estacion = "Otoño";
			break;
		case $fecha >= 621:
		case $fecha <= 820:
			$estacion = "Invierno";
			break;
		case $fecha >= 821:
		case $fecha <= 1220:
			$estacion = "Primavera";
			break;
		default:
			$estacion = "Verano";
			break;
	}


	echo " $estacion";

?>