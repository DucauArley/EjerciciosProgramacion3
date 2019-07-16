<?php

	class venta
	{
		public $email;
		public $tipo;
		public $cantidad;
		public $sabor;
			
		//Me parece que tengo que hacer todo con json porque me sigue rompiendo las pelotas con el undefined offset

		function __construct()
		{
		}

		function AltaVenta()
		{
			$i = 1;
			$id = 1;
			$vec = array();
			$this->sabor = $this->sabor . PHP_EOL;
			$pizzas = leer("Pizza.txt");
			$contador = 0;
			$Agotado = false;
			$precio = 0;

			while(validar("Venta.txt", $i) == true)
			{
				$i ++;
				$id = $i;
			}

			foreach($pizzas as $item) 
			{
				if(strcasecmp($item[2], $this->tipo) == 0 && strcasecmp($item[5], $this->sabor) == 0)
				{
					if($item[3] >= $this->cantidad)
					{
						$item[3] = $item[3] - $this->cantidad;
						$precio = $this->cantidad * $item[1];
					}
					else
					{
						$Agotado = true;
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
				$dato =$id . ";" . $this->email . ";" . $this->tipo . ";" . $this->cantidad . ";" . $precio . ";" . $this->sabor;

				var_dump($dato);

				guardar("Venta.txt", $dato, null);

				array_pop($vec);
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
			}
			else
			{
				echo "La cantidad de pizzas requeridas no esta disponible";
			}
		}

		function ListadoDeVentas()
		{
			$ventas = leer("Venta.txt");
			$hay = 0;

			foreach ($ventas as $item) 
			{
				foreach ($item as $key) 
				{
					if ($key != "")
					{
						echo $key . " ";
						$hay ++;
					}
				}
			}

			if($hay == 0)
			{
				echo "No hay ventas";
			}

		}

		function ListadoDeVentas2()
		{
			$contador = 0;
			$ventas = leer("Venta.txt");
			$this->sabor = $this->sabor . PHP_EOL;

			foreach ($ventas as $item) 
			{
				if(strcasecmp($item[2], $this->tipo) == 0 || strcasecmp($item[5], $this->sabor) == 0)
				{
					echo $item[0] . " " . $item[1] . " " . $item[2] . " " . $item[3] . " " . $item[4] . " " . $item[5] . PHP_EOL;
					$contador ++;
				}
			}

			if($contador == 0)
			{
				echo "No hay pizzas";
			}
		}
	}

?>