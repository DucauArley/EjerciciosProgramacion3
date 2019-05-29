<?php

	function guardar($path, $datos, $tipo)
		{
			if(is_null($tipo))
			{
				if(file_exists($path))
				{
					$archivo = fopen($path, "a");		 
				}
				else
				{
					$archivo = fopen($path, "w");	 
	        	}
        	}
        	else
        	{
        		$archivo = fopen($path, $tipo . "");
        	}

			if(!is_null($archivo))
			{
				fwrite($archivo, $datos);
			}

			fclose($archivo);
		}

		function leer($path)
		{	
			$i = 0;
			$vec = null;
			$archivo = fopen($path, "r");

			if($archivo != false)
			{
				$vec = array();
				while(!feof($archivo))
				{
					$vec[] =  fgets($archivo);
					$vec[$i] = explode(" ", $vec[$i]);

					$i++;
				}

				fclose($archivo);
			}

			return $vec;
		}

		function validar($path, $comparacion)
		{
			$vec = leer($path);
			$esta = false;

			if(!is_null($vec))
			{
				foreach ($vec as $item) 
				{
					if($item[0] == $comparacion)
					{
						$esta = true;
					}
				}
				return $esta;
			}
			else
			{
				return false;
			}
		}

		function cargarFotos($id, $imagen)
		{
			$destino = "./fotos/";
			$destinoB = "./backUpFotos/";
		    $nombreImagen = $_FILES["imagen"]["name"];
		    $hoy = date("d.m.y");
			if($id!=null)
			{
				$datoImagen = $id . "-" . $hoy;
			}
		    else
		    {
		        $datoImagen = "sinDatos";
		    }
		    
			$explode = explode(".", $nombreImagen);

			$destino .= $datoImagen . "." . end($explode);

		    $destinoB .= $imagen["name"] . "." . end($explode);

			if(!file_exists($destino))
			{
		        move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino);	
			}
			else
			{
				rename($imagen["tmp_name"], $destinoB);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino);
			}
		    
		    return $destino;

		}

?>