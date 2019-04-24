<?php

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

		public function guardar($path, $datos)
		{
			if(file_exists($archivo))
			{
				$archivo = fopen($path, "a");		 
			}
			else
			{
				$archivo = fopen($path, "w");	 
        	}

			if(!is_null($archivo))
			{
				fwrite($archivo, $datos);
			}

			fclose($archivo);
		}

		public function leer($path)
		{
			$i = 0;
			$vec = array();
			$archivo = fopen($path, "r");

			if(!is_null($archivo))
			{
				while(!feof($archivo))
				{
					$vec[] =  fgets($archivo);
					$vec[$i] = explode(" ", $vec[$i]);

					$i++;
				}
			}

			fclose($archivo);

			return $vec;
		}

		public function cargarProveedor()
		{
			$datos = $this->id . " " . $this->nombre . " " . $this->email . " " . $this->foto . PHP_EOL;
			$this->guardar("proveedores.txt", $datos);
		}

		public function consultarProveedor($nombre)
		{
			$contador = 0;
			$json;

			$json = json_encode($this->leer("proveedores.txt"));

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

			$json = json_encode($this->leer("proveedores.txt"));

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