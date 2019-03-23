<?php

	$vec1 = array("Perro", "Gato", "Raton", "Araña", "Mosca");
	$vec2 = array(1986, 1996, 2015, 78, 86);
	$vec3 = array("PHp", "Mysql", "Html5", "TypeScript", "Ajax");


	$resultado = array_merge($vec1, $vec2, $vec3);

	foreach ($resultado as $item) 
	{
		echo "$item ";
	}
?>