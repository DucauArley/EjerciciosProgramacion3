<?php

	include "manejoArchivos.php";
	include "producto.php";

	if(isset($_POST["id"]) && isset($_POST["nombre"]) && isset($_POST["precio"]) && isset($_FILES["imagen"]) && isset($_POST["usuario"]))
	{
		$id = $_POST["id"];
		
		if(validar("productos.txt", $id) == false)
		{
			$nombreImg = $id . "-" . date("d.m.y");
			//$imagenVieja = $_FILES["imagen"]["name"];
			//$imagenVieja = explode(".", $imagenVieja);
			$imagen = $_FILES["imagen"];
			$imagen["name"] = $nombreImg;
			//$destino = "./fotos/" . $nombreImg . "." . end($imagenVieja); 

			$imagen["tmp_name"] = cargarFotos($id, $imagen);

			$imagen = json_encode($imagen);

			$producto = new producto($id, $_POST["nombre"], $_POST["precio"], $imagen, $_POST["usuario"]);

			$datos = $producto->id . " " . $producto->nombre . " " . $producto->precio . " " . $producto->imagen . " " . $producto->usuario . PHP_EOL;

			//rename($_FILES["imagen"]["tmp_name"], "./fotos/" . $nombreImg);

			var_dump($datos);

			guardar("productos.txt", $datos, null);
		}
		else
		{
			echo "El producto ya existe";
		}
	}
	else
	{
		echo "Faltan datos";
	}

?>