<?php

	include "manejoArchivos.php";

	//Hacer un cargar imagen para reducir codigo, Probar el modificar con varios productos, arreglar el crear usuario, y creo que nada mas
	//Quizas pueda arreglar el guardar para que no me guarde un item del array vacio con el pop como lo use en el $vec
	//Adaptar las demas funciones y crear carpetas para las funciones y los archivos y demas
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
			$imagenMod = json_decode($item[3], true);
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
		array_pop($vec);

		var_dump($vec);

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