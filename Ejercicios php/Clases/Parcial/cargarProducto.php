<?php

	include "manejoArchivos.php";
	include "producto.php";

	$id = $_POST["id"];

	$imagen = $_FILES["imagen"];
	$imagen["name"] = $id . "." . date("d/m/y");

	$imagen = json_encode($imagen);

	$producto = new producto($id, $_POST["nombre"], $_POST["precio"], $imagen, $_POST["usuario"]);

	$datos = $producto->id . " " . $producto->nombre . " " . $producto->precio . " " . $producto->imagen . " " . $producto->usuario . PHP_EOL;

	foreach ($_FILES as $item)
	{
		move_uploaded_file($item["tmp_name"], "./fotos/" . $item["name"]);
	}

	var_dump($datos);

	guardar("productos.txt", $datos, null);

?>