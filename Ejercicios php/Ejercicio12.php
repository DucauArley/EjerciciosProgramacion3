<?php

	$lapicera1 = array("Color"=>"Negro", "Marca"=>"Bic", "Trazo"=>"Fino" , "Precio"=> "20 pesos");
	$lapicera2 = array("Color"=>"Azul", "Marca"=>"Fisher", "Trazo"=>"Grueso", "Precio"=> "10 pesos");
	$lapicera3 = array("Color"=>"Rojo", "Marca"=>"Cross", "Trazo"=>"Ultra fino" , "Precio"=> "30 pesos");


	echo "Lapicera1 <br/>";
	foreach ($lapicera1 as $item) 
	{
		echo "$item ";
	}

	echo "<br/><br/>Lapicera2 <br/>";
	foreach ($lapicera2 as $item) 
	{
		echo "$item ";
	}

	echo "<br/><br/>Lapicera3 <br/>";
	foreach ($lapicera3 as $item) 
	{
		echo "$item ";
	}


?>