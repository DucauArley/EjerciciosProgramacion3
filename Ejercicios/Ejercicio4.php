<?php

	$total = 0;


	for ($i=1; $total < 1000 ; $i++) 
	{ 
		if(($total + $i) < 1000)
		{
			$total = $i + $total;

			echo "$i <br/>";
		}
		else
		{
			break;
		}
	}

	echo "La cantidad de numeros sumados es: ", $i - 1 ;

?>