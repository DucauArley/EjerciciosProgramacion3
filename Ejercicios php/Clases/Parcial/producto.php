<?php

	class producto
	{
		public $id;
		public $nombre;
		public $precio;
		public $imagen;
		public $usuario;

		function __construct($id, $nombre, $precio, $imagen, $usuario)
		{
			$this->id = $id;
			$this->nombre = $nombre;
			$this->precio = $precio;
			$this->imagen = $imagen;
			$this->usuario = $usuario;
		}
	}


?>