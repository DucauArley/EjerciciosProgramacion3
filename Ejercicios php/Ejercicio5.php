<?php

	$a = 88;
	$b = 245;
	$c = 45;
	$valorDelMedio = "No hay valor del medio";


	if(($a > $b && $a < $c) || ($a < $b && $a > $c))
	{
		$valorDelMedio = $a;
	}
	else
	{
		if(($b > $a && $b < $c) || ($b < $a && $b > $c))
		{
			$valorDelMedio = $b; 
		}
		else
		{
			if(($c > $a && $c < $b) || ($c < $a && $c > $b))
			{
				$valorDelMedio = $c;
			}
		}
	}

	echo "$valorDelMedio";

?>