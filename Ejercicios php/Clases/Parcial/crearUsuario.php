<?php

	include "manejoArchivos.php";
	include "usuario.php";

	$usuario = new usuario("cacho", 1234);

	$datos = $usuario->nombre . " " . $usuario->clave . PHP_EOL;

	var_dump($datos);

	guardar("usuarios.txt", $datos, null);

?>