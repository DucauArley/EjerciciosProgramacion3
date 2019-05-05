<?php

	include_once "manejoArchivos.php";

	class pedido
	{
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
			$datos = $this->producto . " " . $this->cantidad . " " . $this->idProveedor . PHP_EOL;
			$arrayProveedores = leer("proveedores.txt");
			$contador = 0;

			foreach ($arrayProveedores as $proveedor) 
			{
				if($proveedor[0] == $this->idProveedor)
				{
					guardar("pedidos.txt", $datos);
					$contador ++;
				}
			}

			if($contador == 0)
			{
				echo "No existe el proveedor";
			}
			
		}

		public function listarPedidos()
		{
			$pedidos = leer("pedidos.txt");

			foreach ($pedidos as $item) 
			{
				foreach ($item as $variables) 
				{
					echo $variables;
				}	
			}

		}

		public function listarPedidoProveedor($idProveedor)
		{
			$pedidos = leer("pedidos.txt");
			$contador = 0;

			foreach ($pedidos as $item) 
			{
				if($idProveedor == $item[2])
				{
					echo $item[0] . " " . $item[1] . " " . $item[2];
					$contador ++;;
				}
			}

			if($contador == 0)
			{
				echo "El proveedor no tiene pedidos";
			}
		}


	}
?>