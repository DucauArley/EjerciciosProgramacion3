<?php
include "manejoArchivos.php";

	class pizza
	{
		public $precio;
		public $tipo;
		public $cantidad;
		public $sabor;
		public $imagen;
			

		function __construct()
		{
		}


		function PizzaCarga()
		{
			$id = 1;
			$i = 1;
			$pizzas = leer("Pizza.txt");
			$esta = 0;
			$array = $this->imagen->getClientFileName();
			$array = explode(".", $array);

			if(strcasecmp($this->tipo, "molde") == 0 || strcasecmp($this->tipo, "piedra") == 0)
			{
				if(strcasecmp($this->sabor, "muzza") == 0 || strcasecmp($this->sabor, "jamon") == 0 || strcasecmp($this->sabor, "especial") == 0)
				{
					$this->sabor = $this->sabor . PHP_EOL;
						
					while(validar("Pizza.txt", $i) == true)
					{
						$i ++;
						$id = $i;
					}

					if($pizzas != null)
					{
						foreach ($pizzas as $item) 
						{
							if(strcasecmp($item[2], $this->tipo) == 0 && strcasecmp($item[5], $this->sabor) == 0)
							{
								$esta ++;
							}
						}
					}

					if($esta == 0)
					{
						$this->imagen->moveTo("./fotos/" . $this->imagen->getClientFileName());

						$this->imagen = json_encode($this->imagen);

						$datos = $id . ";" . $this->precio . ";" . $this->tipo . ";" . $this->cantidad . ";" . $this->imagen  . ";" . $this->sabor;

						var_dump($datos);
								
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

		function PizzaConsultar()
		{
			$contador = 0;
			$pizzas = leer("Pizza.txt");
			$this->sabor = $this->sabor . PHP_EOL;

			foreach ($pizzas as $item) 
			{
				if(strcasecmp($item[2], $this->tipo) == 0 && strcasecmp($item[5], $this->sabor) == 0)
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
				echo "No hay de " . $this->tipo . " y de " . $this->sabor;
			}
		}

		function BorrarItem()
		{
			$id = $request->getQueryParams();
			$pizzas = leer("Pizza.txt");
			$id = $id["id"];
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
				$datos = $item[0] . ";" . $item[1] . ";" . $item[2] . ";" . $item[3] . ";" . $item[4] . ";" . $item[5];

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

	}

?>