<?php

	include "manejoArchivos.php";
	include "usuario.php";

	if(isset($_POST["nombre"]) && isset($_POST["clave"]))
	{
		$usuario = new usuario($_POST["nombre"], $_POST["clave"]);

		if(validar("usuarios.txt", $usuario->nombre) == false)
		{
			$datos = $usuario->nombre . " " . $usuario->clave . PHP_EOL;

			var_dump($datos);

			guardar("usuarios.txt", $datos, null);
		}
		else
		{
			echo "El usuario ya existe";
		}
	}
	else
	{
		echo "Faltan datos";
	}
?>