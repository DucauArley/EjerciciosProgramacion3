<?php

	include "manejoArchivos.php";

	if(isset($_GET["tipo"]) && isset($_GET["sabor"]))
	{
		$tipo = $_GET["tipo"];
		$sabor = $_GET["sabor"];
		$contador = 0;
		$pizzas = leer("Pizza.txt");
		$sabor = $sabor . PHP_EOL;

		foreach ($pizzas as $item) 
		{
			if(strcasecmp($item[2], $tipo) == 0 && strcasecmp($item[5], $sabor) == 0)
			{
				$contador ++;
			}
		}

		if($contador != 0)
		{
			echo "Si hay";
		}
		else
		{
			echo "No hay de " . $tipo . " y de " . $sabor;
		}
	}
	else
	{
		echo "Faltan datos";
	}

?>