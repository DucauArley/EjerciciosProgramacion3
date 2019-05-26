<?php

	include "manejoArchivos.php";
	include "producto.php";

	$id = $_POST["id"];
	$nombreImg = $id . "-" . date("d.m.y");
	$imagenVieja = $_FILES["imagen"]["name"];
	$imagenVieja = explode(".", $imagenVieja);
	$imagen = $_FILES["imagen"];
	$imagen["name"] = $nombreImg;
	$destino = "./fotos/" . $nombreImg . "." . end($imagenVieja); 

	move_uploaded_file($imagen["tmp_name"], $destino);

	$imagen["tmp_name"] = $destino;

	$imagen = json_encode($imagen);

	$producto = new producto($id, $_POST["nombre"], $_POST["precio"], $imagen, $_POST["usuario"]);

	$datos = $producto->id . " " . $producto->nombre . " " . $producto->precio . " " . $producto->imagen . " " . $producto->usuario . PHP_EOL;

	//rename($_FILES["imagen"]["tmp_name"], "./fotos/" . $nombreImg);

	var_dump($datos);

	guardar("productos.txt", $datos, null);

?>