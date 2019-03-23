<?php


	echo EsPar(54);
	echo EsImpar(51);//Si es falso, no se muestra nada por pantalla

	function EsPar($num)
	{
		$ok = false;

		if($num % 2 == 0)
		{
			$ok = true;
		}

		return $ok;
	}

	function EsImpar($num)
	{
		return !EsPar($num);
	}


?>