<?php

	echo validar("Programacion", 10);

	function validar($palabra, $max)
	{
		$ok = 0;
		if(strlen($palabra) <= $max)
		{
			switch ($palabra) 
			{
				case 'Recuperatorio':
					$ok = 1;
					break;
				case 'Parcial':
					$ok = 1;
					break;
				case 'Programacion':
					$ok = 1; 
					break;
			}
		}

		return $ok;
	}


?>