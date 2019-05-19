<?php

	include "manejoArchivos.php";
	include "producto.php";

	$producto = new producto(12, "caramelos", 1, "QueSeYoEstoyReLoco", "cacho");

	$datos = $producto->id . " " . $producto->nombre . " " . $producto->precio . " " . $producto->imagen . " " . $producto->usuario . PHP_EOL;

	var_dump($datos);

	guardar("productos.txt", $datos, null);

?>