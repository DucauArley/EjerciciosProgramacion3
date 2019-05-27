<?php

	include "manejoArchivos.php";
	include "usuario.php";

	$usuario = new usuario($_POST["nombre"], $_POST["clave"]);
	$usuarios = leer("usuarios.txt");
	$esta = 0;

	foreach ($usuarios as $item) 
	{
		if (strcasecmp($item[0], $usuario->nombre) == 0) 
		{
			$esta ++;
		}
	}

	if($esta == 0)
	{
		$datos = $usuario->nombre . " " . $usuario->clave . PHP_EOL;

		var_dump($datos);

		guardar("usuarios.txt", $datos, null);
	}
	else
	{
		echo "El usuario ya existe";
	}
?>