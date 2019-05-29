<?php

	include "manejoArchivos.php";
	include "pizza.php";

	if(isset($_POST["precio"]) && isset($_POST["tipo"]) && isset($_POST["cantidad"]) && isset($_POST["sabor"]) && isset($_FILES["imagen"]) )
	{
		$id = 1;
		$i = 1;
		$imagen = $_FILES["imagen"];
		$tipo = $_FILES["imagen"]["name"];
		$tipo = explode(".", $tipo);
		$pizzas = leer("Pizza.txt");
		$esta = 0;
		$tipo = $_POST["tipo"];
		$sabor = $_POST["sabor"];
		
		if(strcasecmp($tipo, "molde") == 0 || strcasecmp($tipo, "piedra") == 0)
		{
			if(strcasecmp($sabor, "muzza") == 0 || strcasecmp($sabor, "jamon") == 0 || strcasecmp($sabor, "especial") == 0)
			{
				$sabor = $sabor . PHP_EOL;
			
				while(validar("Pizza.txt", $i) == true)
				{
					$i ++;
					$id = $i;
				}

				if($pizzas != null)
				{
					foreach ($pizzas as $item) 
					{
						if(strcasecmp($item[2], $tipo) == 0 && strcasecmp($item[5], $sabor) == 0)
						{
							$esta ++;
						}
					}
				}

				if($esta == 0)
				{
					move_uploaded_file($imagen["tmp_name"], "./fotos/" . $imagen["name"] . " . " . end($tipo));

					$imagen = json_encode($imagen);

					$pizza = new pizza($_POST["precio"], $tipo, $_POST["cantidad"], $imagen, $sabor);

					$datos = $id . " " . $pizza->precio . " " . $pizza->tipo . " " . $pizza->cantidad . " " . $pizza->imagen  . " " . $pizza->sabor;

					echo $datos;
					
					guardar("Pizza.txt", $datos, null);
				}
				else
				{
					echo "Ya existe ese tipo y sabor";
				}
			}
			else
			{
				echo "No existe ese sabor de pizza";
			}
		}
		else
		{
			echo "No existe ese tipo de pizza";
		}
	}
	else
	{
		echo "Faltan datos";
	}




?>