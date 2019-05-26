<?php

	include "manejoArchivos.php";

	$productos = leer("productos.txt");

	$id = $_POST["id"];
	$nombre = $_FILES["imagen"]["name"];
	$imagen = $_FILES["imagen"];
	$origen = $_FILES["imagen"]["tmp_name"];
	$nombreImg = $id . "-" . date("d.m.y");
	$imagen["name"] = $nombreImg;
	$nombre = explode(".", $nombre);
	$esta = 0;
	$contador = 0;
	$destino = "./fotos/" . $nombreImg . "." . end($nombre);
	$vec = array();

	$imagen["tmp_name"] = $destino;

	foreach ($productos as $item) 
	{
		if($item[0] == $id)
		{
			$imagenMod = json_decode($item[3], true);//Revisar bien esto
			rename($imagenMod["tmp_name"], "./backUpFotos/" . $imagenMod["name"] . "." . end($nombre));
			var_dump($imagenMod);
			$item[1] = $_POST["nombre"];
			$item[2] = $_POST["precio"];
			$item[3] = $imagen;
			$item[4] = $_POST["usuario"];
			$esta ++;
			$vec[] = $item;
		}
		else
		{
			$vec[] = $item;
		}
	}

	move_uploaded_file($origen, $destino);

	if($esta == 0)
	{
		echo "El producto no existe";
	}
	else
	{
		foreach ($vec as $item) 
		{
			$item[3] = json_encode($item[3]);
			$datos = $item[0] . " " . $item[1] . " " . $item[2] . " " . $item[3] . " " . $item[4] . PHP_EOL;

			if($contador == 0)
			{
				guardar("productos.txt", $datos, "w");
				$contador ++;
			}
			else
			{
				guardar("productos.txt", $datos, null);
			}
		}
	}

?>