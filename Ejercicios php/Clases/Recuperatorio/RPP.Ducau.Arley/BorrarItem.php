<?php

	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);
	error_reporting(E_ALL);

	include "manejoArchivos.php";

	if(isset($_POST["id"]))
	{
		$pizzas = leer("Pizza.txt");
		$id = $_POST["id"];
		$vec = array();
		$contador = 0;
		$entra = false;
		$destino = "./backUpFotos/";

		foreach ($pizzas as $item) 
		{
			if($id != $item[0])
			{
				$vec[] = $item;
			}
			else
			{
				$entra = true;
				$imagen = json_decode($item[4]);
				$explode = explode(".", $imagen->name);
				$destino .= $id . "-" . date("d.m.y") . "." . end($explode);
				rename("./fotos/" . $imagen->name, $destino);
			}
		}
		
		if ($entra == true) 
		{
			foreach ($vec as $item) 
			{
				if(strcasecmp($item[0], "")!= 0)
				{
					$datos = $item[0] . ";" . $item[1] . ";" . $item[2] . ";" . $item[3] . ";" . $item[4] . ";" . $item[5];
				}
				else
				{
					$datos = "";
				}

				if($contador == 0)
				{
					guardar("Pizza.txt", $datos, "w");
					$contador ++;
				}
				else
				{
					guardar("Pizza.txt", $datos, "a");
				}
				
			}

			echo "Item borrado correctamente";
		}
		else
		{
			echo "No se pudo encontrar la pizza que se desea borrar";
		}

	}
	else
	{
		echo "Faltan datos";
	}
?>