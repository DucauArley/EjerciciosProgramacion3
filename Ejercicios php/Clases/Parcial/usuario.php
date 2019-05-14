<?php

	class usuario
	{
		public $nombre;
		public $clave;

		function __construct($nombre, $clave)
		{
			$this->nombre = $nombre;
			$this->clave = $clave;
		}


	}

?>