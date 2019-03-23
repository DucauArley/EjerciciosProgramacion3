<?php

	$var = array(rand(),rand(),rand(),rand(),rand());
	$promedio = 0;
	$mensaje;

	for ($i=0; $i < 5; $i++) 
	{ 
		$promedio = $promedio + $var[$i];
	}

	$promedio = $promedio / 5;

	if($promedio == 6)
	{
		$mensaje = "El promedio es igual a 6";
	}
	else
	{
		if($promedio < 6)
		{
			$mensaje = "El promedio es menor a 6";
		}
		else
		{
			$mensaje = "El promedio es mayor a 6";
		}
	}


	echo "$mensaje";

?>