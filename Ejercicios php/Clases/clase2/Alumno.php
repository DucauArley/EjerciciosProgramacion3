<?php

	class Alumno
	{
		public $nombre;
		public $apellido;
		public $legajo;
		public $id;

		function __construct($nombre, $apellido, $legajo, $id)
		{
			$this->nombre = $nombre;
			$this->apellido = $apellido;
			$this->legajo = $legajo;
			$this->id = $id;
		}

		function ToCSV()
		{
			$retorno = $nombre . ";" . $apellido . ";" . $legajo . ";" . $id;

			return $retorno;
		}

		function ToJson()
		{
			return json_encode($this);
		}


	}

?>