<?php

	$vec1 = array("Perro", "Gato", "Raton", "Araña", "Mosca");
	$vec2 = array(1986, 1996, 2015, 78, 86);
	$vec3 = array("PHp", "Mysql", "Html5", "TypeScript", "Ajax");

	$vecArrays1 = array($vec1, $vec2, $vec3);
	$vecArrays2 = array("Vector1"=>$vec1, "Vector2"=>$vec2, "Vector3"=>$vec3);

	foreach ($vecArrays1 as $item) 
	{
		foreach ($item as $key) 
		{
			echo "$key";
		}
	}

	echo "<br/>";

	foreach ($vecArrays2 as $item) 
	{
		foreach ($item as $key) 
		{
			echo "$key";
		}
	}


?>