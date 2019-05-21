<?php

	include "manejoArchivos.php";

	$productos = leer("productos.txt");

	$id = $_POST["id"];
	$imagen = $_FILES["imagen"];
	$imagen["name"] = $id . date("d/m/y")
	$esta = 0;
	$contador = 0;

	foreach ($productos as $item) 
	{
		if($item[0] == $id)
		{
			move_uploaded_file($item[3]["tmp_name"], "./backUpFotos/" . $item[3]["name"]);//aca iria todo lo de las imagenes
			//Se me ocurre un explode para sacar el nombre y otro para sacar el tmp las cosas estan separadas por comas
			$item[1] = $_POST["nombre"]; 
			$item[2] = $_POST["precio"];
			$item[3] = $imagen;
			$item[4] = $_POST["usuario"];
			$esta ++;
		}
	}

	move_uploaded_file($imagen["tmp_name"], "./fotos/" . $imagen["name"]);

	if($esta == 0)
	{
		echo "El producto no existe";
	}
	else
	{
		foreach ($productos as $item) 
		{
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