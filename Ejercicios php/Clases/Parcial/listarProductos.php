<?php

	include "manejoArchivos.php";

	$productos = leer("productos.txt");
	$hay = 0;

	foreach ($productos as $item) 
	{
		echo $item[0] . " " . $item[1] . " " . $item[2] . " " . $item[3] . " " . $item[4] . "\r\n";
		$hay ++;
	}

	if($hay == 0)
	{
		echo "No hay productos";
	}

?>