<?php

	include "manejoArchivos.php";

	$productos = leer("productos.txt");

	$criterio = $_GET["criterio"];
	$valor = $_GET["valor"];
	$hay = 0;

	foreach ($productos as $item) 
	{
		if(strcasecmp($item[1], $criterio) == 0 || strcasecmp($item[4], $criterio . PHP_EOL) == 0 && $valor == $item[2])
		{
			echo $item[0] . " " . $item[1] . " " . $item[2] . " " . $item[3] . " " . $item[4];
			$hay ++;
		}
	}

	if($hay == 0)
	{
		echo "El producto no existe";
	}




?>