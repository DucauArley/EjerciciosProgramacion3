<?php

	include "manejoArchivos.php";

	if(isset($_POST["id"]))
	{
		$pizzas = leer("Pizza.txt");
		$id = $_POST["id"];
		$vec = array();
		$contador = 0;

		foreach ($pizzas as $item) 
		{
			if($id != $item[0])
			{
				$vec[] = $item;
			}
		}

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

		echo "Item borrado correctamente";

	}
?>