<?php

	include "manejoArchivos.php";

	//Hacer un cargar imagen para reducir codigo, tratar de reducir codigo en las demas funciones, hay cosas que se repiten, hacer un validar o algo por el estilo, ya que se puede usar tanto para el crear usuario como para el cargar producto
	//Adaptar las demas funciones y crear carpetas para las funciones y los archivos y demas
	if(isset($_POST["id"]) && isset($_POST["nombre"]) && isset($_POST["precio"]) && isset($_FILES["imagen"]) && isset($_POST["usuario"]))
	{
		$productos = leer("productos.txt");

		$id = $_POST["id"];
		//$nombre = $_FILES["imagen"]["name"];
		$imagen = $_FILES["imagen"];
		//$origen = $_FILES["imagen"]["tmp_name"];
		$nombreImg = $id . "-" . date("d.m.y");
		$imagen["name"] = $nombreImg;
		//$nombre = explode(".", $nombre);
		$esta = 0;
		$contador = 0;
		//$destino = "./fotos/" . $nombreImg . "." . end($nombre);
		$vec = array();

		//$imagen["tmp_name"] = $destino;

		foreach ($productos as $item) 
		{
			if($item[0] == $id)
			{
				$imagenMod = json_decode($item[3], true);
				$imagen["tmp_name"] = cargarFotos($id, $imagenMod);
				//rename($imagenMod["tmp_name"], "./backUpFotos/" . $imagenMod["name"] . "." . end($nombre));

				$item[1] = $_POST["nombre"];
				$item[2] = $_POST["precio"];
				$item[3] = $imagen;
				$item[3] = json_encode($item[3]);
				$item[4] = $_POST["usuario"] . PHP_EOL;
				$esta ++;
				$vec[] = $item;
			}
			else
			{
				$vec[] = $item;
			}
		}

		//move_uploaded_file($origen, $destino);

		if($esta == 0)
		{
			echo "El producto no existe";
		}
		else
		{
			/*if($id =! 1)
			{
				array_pop($vec);
			}Deveria ir si el producto que modifico es el ultimo para que no me deje un item de mas en el array pero funciona igual no se como jajajajajajaja*/

			foreach ($vec as $item) 
			{
				$datos = $item[0] . " " . $item[1] . " " . $item[2] . " " . $item[3] . " " . $item[4];

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
	}
	else
	{
		echo "Faltan datos";
	}

?>