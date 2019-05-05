<?php

	include "manejoArchivos.php";

	class proveedor
	{
		private $id;
		private $nombre;
		private $email;
		private $foto;

		function __construct($id, $nombre, $email, $foto)
		{
			$this->id = $id;
			$this->nombre = $nombre;
			$this->email = $email;
			$this->foto = $foto;
		}

		public function cargarProveedor()
		{
			$datos = $this->id . " " . $this->nombre . " " . $this->email . " " . $this->foto . PHP_EOL;
			guardar("proveedores.txt", $datos);
		}

		public function consultarProveedor($nombre)
		{
			$contador = 0;
			$json;

			$json = json_encode(leer("proveedores.txt"));
			
			$json = json_decode($json);

			foreach ($json as $item) 
			{

				if(strcasecmp($item[1], $nombre) == 0)
				{
					echo $item[0] . " " . $item[1] . " " . $item[2] . " " . $item[3];
					$contador ++;
				}
					
			}

			if($contador == 0)
			{
				echo "No existe proveedor " . $nombre;
			}
		}

		public function listar()
		{
			$json;

			$json = json_encode(leer("proveedores.txt"));

			$json = json_decode($json);

			foreach ($json as $item) 
			{
				foreach ($item as $variables ) 
				{
					echo $variables;
				}
			}
		}

	}
?>