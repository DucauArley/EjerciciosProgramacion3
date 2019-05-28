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

		function validar($path, $comparacion)
		{
			$vec = leer($path);
			$esta = false;

			foreach ($vec as $item) 
			{
				if(strcasecmp($item[0], $comparacion) == 0)
				{
					$esta = true;
				}
			}

			return $esta;
		}

		//Funciona, ahora tengo que ver de que me sirve pasarle el destino, por ahi puedo escribir el tmp_name en el archivo con eso
		//No Cambia las fotos de dias anteriores por mas que tenga la misma id porque se modifica en base a el tmp_name que es un nombre actual, o algo asi, es medio raro
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