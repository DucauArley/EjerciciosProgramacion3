<?php

	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);
	error_reporting(E_ALL);

	include "manejoArchivos.php";

	if(isset($_GET["tipo"]) || isset($_GET["sabor"]))
	{
		$tipo = $_GET["tipo"];
		$sabor = $_GET["sabor"];
		$contador = 0;
		$ventas = leer("Venta.txt");
		$sabor = $sabor . PHP_EOL;

		foreach ($ventas as $item) 
		{
			if(strcasecmp($item[2], $tipo) == 0 || strcasecmp($item[5], $sabor) == 0)
			{
				echo $item[0] . " " . $item[1] . " " . $item[2] . " " . $item[3] . " " . $item[4] . " " . $item[5] . PHP_EOL;
				$contador ++;
			}
		}

		if($contador == 0)
		{
			echo "No hay pizzas encargadas";
		}
	}
	else
	{
		echo "Faltan datos";
	}
?>