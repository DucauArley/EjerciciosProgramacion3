<?php
	include 'Punto.php';

	class Rectangulo
	{
		private $_vertice1;
		private $_vertice2;
		private $_vertice3;
		private $_vertice4;
		public $area;
		public $ladoDos;
		public $ladoUno;
		public $perimetro;

		public function __construct(Punto $v1, Punto $v3)
		{
			$this->$_vertice1 = $v1;
			$this->_vertice3 = $v3;
			$this->_vertice2->$_x = $v3->$_x;
			$this->_vertice2->$_y = $v1->$_y;
			$this->_vertice4->$_x = $v1->$_x;
			$this->_vertice4->$_y = $v3->$_y;
			Calcular();
		}


		public function Dibujar()
		{
			for ($i=0; $i < $_ladoDos; $i++) 
			{ 
				for ($j=0; $j < $_ladoUno; $j++) 
				{ 
					echo "*";
				}
				echo "<br/>*";
			}
		}


		private function Calcular()
		{
			$this->$ladoUno = $this->$_vertice3->$_y - $this->$_vertice2->$_y;
			$this->$ladoDos = $this->$_vertice2->$_x - $this->$_vertice1->$_x;

			$this->$perimetro = 2 * ($this->$ladoUno + $this->$ladoDos);

			$this->$area = $this->$ladoUno * $this->$ladoDos;
		}

		public function Tostring()
		{
			$retorno = "Area: " . $this->$area . " Permietro: ". $this->$perimetro . " Lado Uno: " . $this->$ladoUno . " Lado Dos: " . $this->ladoDos;

			return $retorno;
		}
	}
?>