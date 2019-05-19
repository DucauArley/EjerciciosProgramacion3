<?php

	include "manejoArchivos.php";

	$usuarios = leer("usuarios.txt");
	$nombre = $_GET["nombre"];
	$esta = 0;

	foreach ($usuarios as $item) 
	{
		
		if(strcasecmp($item[0], $nombre) == 0)
		{
			echo $item[0] . " " . $item[1];
			$esta ++;
		}
	}

	if($esta == 0)
	{
		echo "No existe " . $nombre;
	}

?>