<?php

	class Triangulo extends FiguraGeometrica
	{
		private $_altura;
		private $_base;

		public function __construct($b, $h)
		{
			$this->$_altura = $h;
			$this->$_base = $b;
			CalcularDatos();
		}

		protected function CalcularDatos()
		{
			$ladox;
			$ladox = sqrt((pow($_base, 2) + pow($_altura, 2)));


			$this->$_perimetro = $ladox + $this->$_base + $this->$_altura;
			$this->$_superficie = ($this->$_base * $this->$_altura) / 2;
		}

		public function Dibujar()
		{
			



		}

		public function ToString()
		{
			$retorno = parent::ToString() . " Lado uno: " . $this->$_base . " Lado dos: " . $this->_ladoDos;

			return $retorno;
		}

	}

?>