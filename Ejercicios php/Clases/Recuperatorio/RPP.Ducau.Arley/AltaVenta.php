<?php

	include "manejoArchivos.php";
	include "venta.php";

	if(isset($_POST["email"]) && isset($_POST["tipo"]) && isset($_POST["cantidad"]) && isset($_POST["sabor"]))
	{
		$i = 1;
		$id = 1;
		$cantidad = $_POST["cantidad"];
		$vec = array();
		$tipo = $_POST["tipo"];
		$sabor = $_POST["sabor"];
		$sabor = $sabor . PHP_EOL;
		$venta = new venta($_POST["email"], $tipo, $cantidad, $sabor);
		$pizzas = leer("Pizza.txt");
		$contador = 0;
		$Agotado = false;

		while(validar("Venta.txt", $i) == true)
		{
			$i ++;
			$id = $i;
		}

		foreach ($pizzas as $item) 
		{
			if(strcasecmp($item[2], $tipo) == 0 && strcasecmp($item[5], $sabor) == 0)
			{
				if($item[3] >= $venta->cantidad)
				{
					$item[3] = $item[3] - $venta->cantidad;
					$precio = $cantidad * $item[1];
				}
				else
				{
					$Agotado = true
				}
				$vec[] = $item;
			}
			else
			{
				$vec[] = $item;
			}
		}

		var_dump($vec);

		if($Agotado == false)
		{
			$datos = $id . " " . $venta->email . " " . $venta->tipo . " " . $venta->cantidad . " " . $precio . " " . $venta->sabor . PHP_EOL;

			var_dump($datos);

			guardar("Venta.txt", $datos, null);
			
			foreach ($vec as $item) 
			{
				$datos = $item[0] . " " . $item[1] . " " . $item[2] . " " . $item[3] . " " . $item[4] . " " . $item[5];

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
		}
		else
		{
			echo "La cantidad de pizzas requeridas no esta disponible";
		}
	}
	else
	{
		echo "Faltan datos";
	}



?>