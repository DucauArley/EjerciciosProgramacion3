<?php

	include "manejoArchivos.php";

	$nombre = $_POST["nombre"];
	$clave = $_POST["clave"];
	$contador = 0;
	$usuarios = leer("usuarios.txt");
	var_dump($clave);

	//var_dump($usuarios);
	foreach ($usuarios as $item) 
	{
		//var_dump($item);
		var_dump($item[1]);
		if(/*strcmp($item[0], $nombre) == 0 && *//*strcmp($item[1], $clave) == 0*/ $item[1] == $clave)
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

?>