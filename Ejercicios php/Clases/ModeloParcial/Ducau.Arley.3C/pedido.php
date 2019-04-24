<?php
	
	class pedido
	{
		include 'proveedor.php';

		private $producto;
		private $cantidad;
		private $idProveedor;

		function __construct($producto, $cantidad, $idProveedor)
		{
			$this->producto = $producto;
			$this->cantidad = $cantidad;
			$this->idProveedor = $idProveedor;
		}

		public function hacerPedido()
		{
			$datos = $this->producto . " " . $this->cantidad . " " . $this->idProveedor . PHP_EOL);
			
		}


	}
?>