<?php

	class Alumno
	{
		public $nombre;
		public $apellido;
		public $legajo;
		public $id;

		function __construct()
		{

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