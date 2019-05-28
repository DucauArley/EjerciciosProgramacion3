<?php

	include "manejoArchivos.php";

	if(isset($_POST["nombre"]) && isset($_POST["clave"]))
	{
		$nombre = $_POST["nombre"];
		$clave = $_POST["clave"];
		$contador = 0;
		$usuarios = leer("usuarios.txt");
		$clave = $clave . PHP_EOL;

		var_dump($clave);

		//var_dump($usuarios);
		foreach ($usuarios as $item) 
		{
			var_dump($item);
			
			if(strcasecmp($item[0], $nombre) == 0 && strcasecmp($item[1], $clave) == 0 /*$item[1] == $clave*/)
			{
				$contador ++;
			}
		}

		echo $contador;
		if($contador != 0)
		{
			return true;
		}
		else
		{
			echo "Nombre o contraseña incorrectas";
		}
	}
	else
	{
		echo "Faltan datos";
	}


?>