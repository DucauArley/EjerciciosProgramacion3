<?php

	class pizza
		{
			public $precio;
			public $tipo;
			public $cantidad;
			public $sabor;
			public $imagen;
			

			function __construct($precio, $tipo, $cantidad, $imagen, $sabor)
			{
				$this->precio = $precio;
				$this->tipo = $tipo;
				$this->cantidad = $cantidad;
				$this->sabor = $sabor;
				$this->imagen = $imagen;
			}
		}

?>