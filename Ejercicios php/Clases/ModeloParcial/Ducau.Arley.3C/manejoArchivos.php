<?php

		function guardar($path, $datos)
		{
			if(file_exists($path))
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

?>