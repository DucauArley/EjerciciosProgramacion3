<?php

	include "manejoArchivos.php";

	$ventas = leer("Venta.txt");
	$hay = 0;

	foreach ($ventas as $item) 
	{
		var_dump(count($item));
		if ($item != "")
		echo $item[0] . " " . $item[1] . " " . $item[2] . " " . $item[3] . " " . $item[4] . " " . $item[5] . "\r\n";
		$hay ++;
	}

	if($hay == 0)
	{
		echo "No hay ventas";
	}



?>