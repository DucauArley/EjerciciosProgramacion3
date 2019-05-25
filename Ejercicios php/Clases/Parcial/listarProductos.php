<?php

	include "manejoArchivos.php";

	$productos = leer("productos.txt");
	$hay = 0;

	foreach ($productos as $item) 
	{
		$imagen = json_decode($item[3], true);

		echo $item[0] . " " . $item[1] . " " . $item[2] . " " . $imagen["tmp_name"] . " " . $item[4] . "\r\n";
		$hay ++;
	}

	if($hay == 0)
	{
		echo "No hay productos";
	}

?>