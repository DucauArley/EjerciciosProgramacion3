<?php

	class Rectangulo extends FiguraGeometrica
	{
		private $_ladoUno;
		private $_ladoDos;

		public function __construct($l1, $l2)
		{
			$this->$_ladoUno = $l1;
			$this->$_ladoDos = $l2;
			CalcularDatos();
		}


		protected function CalcularDatos()
		{

			$this->$_perimetro = 2*($this->$_ladoUno + $this->$_ladoDos);
			$this->$_superficie = $this->$_ladoUno * $this->$_ladoDos;
		}

		public function Dibujar()
		{
			for ($i=0; $i < $_ladoUno; $i++) 
			{ 
				for ($j=0; $j < $_ladoDos; $j++) 
				{ 
					echo "*";
				}
				echo "<br/>*";
			}

		}

		public function ToString()
		{
			$retorno = parent::ToString() . " Lado uno: " . $this->$_ladoUno . " Lado dos: " . $this->_ladoDos;

			return $retorno;
		}


	}

?>