<?php

	class venta
		{
			public $email;
			public $tipo;
			public $cantidad;
			public $sabor;
			

			function __construct($email, $tipo, $cantidad, $sabor)
			{
				$this->email = $email;
				$this->tipo = $tipo;
				$this->cantidad = $cantidad;
				$this->sabor = $sabor;
			}
		}


?>