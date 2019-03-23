<?php

	$vector = array("J", "u", "a", "n", "s", "e");

	$vector = invertir($vector);
	
	foreach ($vector as $item) 
	{
		echo "$item";
	}	


	function invertir($vec)
	{
		$aux;
		$j = sizeof($vec, 0) - 1;
		for ($i=0; $i < sizeof($vec, 0) / 2 ; $i++) 
		{ 
			$aux = $vec[$i];
			$vec[$i] = $vec[$j];
			$vec[$j] =  $aux;

			$j--;
		}


		return $vec;
	}

?>