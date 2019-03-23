<?php

	
	$vec;

	$vec = potencias(1);

	foreach ($vec as $item)
	{
		echo "$item ";
	}

	echo "<br/>";
	$vec = potencias(2);

	foreach ($vec as $item)
	{
		echo "$item ";
	}

	echo "<br/>";
	$vec = potencias(3);

	foreach ($vec as $item)
	{
		echo "$item ";
	}

	echo "<br/>";
	$vec = potencias(4);

	foreach ($vec as $item)
	{
		echo "$item ";
	}



	function potencias($num)
	{
		$resultado = array(pow($num, 1), pow($num, 2), pow($num, 3), pow($num, 4));

		return $resultado;
	}


?>