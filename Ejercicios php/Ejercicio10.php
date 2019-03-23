<?php

	$vec = array(1,3,5,7,9,1,3,5,7,9,1,3,5,7,9);
	$contador = 0;

	for ($i=0; $contador < 10 ; $i++) 
	{ 
		if($vec[$i] % 2 == 1)
		{
			echo "$vec[$i] <br/>";
			$contador = $contador + 1; 
		}
	}

	$i = 0;
	$contador = 0;
	while ($contador < 10)
	{
		$i = $i + 1;
		if($vec[$i] % 2 == 1)
		{
			echo "$vec[$i] <br/>";
			$contador = $contador + 1; 
		}
	}


	$contador = 0;
	foreach ($vec as $item) 
	{
		if($item % 2 == 1 && $contador != 10)
		{
			echo "$item <br/>";
			$contador = $contador + 1; 
		}
	}




?>