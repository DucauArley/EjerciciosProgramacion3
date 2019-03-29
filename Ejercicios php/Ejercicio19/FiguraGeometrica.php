<?php

	class FiguraGeometrica
	{
		protected $_color;
		protected $_perimetro;
		protected $_superficie;

		public function __construct()
		{

		}


		public function GetColor()
		{
			return $this->$_color;
		}

		public function SetColor($color)
		{
			$this->$_color = $color;
		}

		public function ToString()
		{
			$retorno = "Color: " . $this->$_color . " Perimetro: " . $this->$_perimetro . " Superficie: " .	$this->$_superficie;
			
			return $retorno;		
		}

		public abstract function Dibujar();

		protected abstract function CalcularDatos();

	}

?>