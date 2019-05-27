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

		function cargarFotos($id)
		{
			$destino = "./Fotos/";
			$destinoB = "./FotosBackUp/";
		    $nombreImagen = $_FILES["imagen"]["name"];
		    $hoy = date("m.d.y");
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

		    $destinoB .= $datoImagen . "." . end($explode);

			if(!file_exists($destino))
			{
		        
		        move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino);	
		        	
			}
			else
			{
		        
		        
				move_uploaded_file($_FILES["imagen"]["tmp_name"], $dicBackup);
			}
		    
		    return $destino;

		}

?>