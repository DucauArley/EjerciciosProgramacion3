<?php
	$nombre = "Mario";
	$legajo = 111;
	$heroes = array("nombre"=>"batman", "superpoder"=>"batimovil");
	$heroes["nombre"] = "batman";
	$lista = array(1,2,3,4,5,6,7,8,9,10);
	$persona = array("name"=>"Pepe");
	$personaO = (object)$persona;
	$personaSTD = new stdClass();
	//$heroes[] = 22; Te inicializa el primer indice que este libre
	//$heroes[22] = 22; inicializa la posicion 22



	shuffle($lista);//Desordena los valores del array
	
	foreach ($heroes as $item)
	{
		echo $item;
	}

	echo "<br>";

	foreach ($heroes as $clave => $valor)
	{
		echo $clave, $valor;
	}

	echo "<br> Hola php <br>";
	var_dump($legajo);
	var_dump($heroes);
	echo "<br> $nombre $legajo <br>";

	var_dump($_GET);
	var_dump($_POST);
	var_dump($personaO);
	$personaSTD->name = "Carlos";

	$personaO->name = "Mario";
	var_dump($personaO);
	var_dump($personaSTD);

	foreach ($lista as $item)
	{
		echo $item;
	}

?>