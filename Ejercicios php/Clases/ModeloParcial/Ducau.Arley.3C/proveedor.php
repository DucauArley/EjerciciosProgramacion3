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
			guardar("proveedores.txt", $datos, null);
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

		public function modificarProveedor()
		{
			$id = $_POST["id"];
			$nombre = $_POST["nombre"];
			$email = $_POST["email"];
			$foto = $_FILES["foto"];
			$contador = 0;
			$idCont == 0;

			$arrayProveedores = leer("proveedores.txt");


			foreach ($arrayProveedores as $item) 
			{
				if($id = $item[0])
				{
					$item[1] = $nombre;
					$item[2] = $email;
					$arrayProveedores[$idCont] = $item;
					//$item[3]["name"] = $id . "" . date("j/n/Y");
					//move_uploaded_file($item[3]["tmp_name"], "./backUpFotos/" . $item[3]["name"]); 
					//$item[3] = $foto;
					break;
				}
				$idCont ++;
			}

			var_dump($arrayProveedores);
			foreach ($arrayProveedores as $proveedor) 
			{
				echo "Llego";
				if($contador == 0)
				{
					$datos = $proveedor[0] . " " . $proveedor[1] . " " . $proveedor[2] . " " . $proveedor[3];
					guardar("proveedores.txt", $datos, "w");
					$contador ++;
				}
				else
				{
					$datos = $proveedor[0] . " " . $proveedor[1] . " " . $proveedor[2] . " " . $proveedor[3];
					guardar("proveedores.txt", $datos, "a");
				}
			}
		}

	}
?>