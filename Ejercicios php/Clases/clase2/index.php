<?php

	include 'Alumno.php';

	$vec = array();
	$i = 0;
	$json;
	$alumnos = array();

	$archivo = fopen("Hola.txt", "w");

	if(!is_null($archivo))
	{

		fwrite($archivo, "Pepe;Perez;222;620" . PHP_EOL . "Juan;Lopez;435;982" . PHP_EOL . "Maria;Disalvo;423;452");
	}

		

	$archivo = fopen("Hola.txt", "r");

	if(!is_null($archivo))
	{
		while(!feof($archivo))
		{
			$vec[] =  fgets($archivo);
			$vec[$i] = explode(";", $vec[$i]);

			$i++;
		}

	}

	$json = json_encode($vec);

	$json = json_decode($json);

	foreach ($json as $arrays) 
	{
		$alumnoAux = new Alumno();
		$alumnoAux->nombre = $arrays[0];
		$alumnoAux->apellido = $arrays[1];
		$alumnoAux->legajo = $arrays[2];
		$alumnoAux->id = $arrays[3];

		$alumnos[] = $alumnoAux;
	}

	var_dump($alumnos);

	fclose($archivo);

	/*$archivo = fopen("Hola.txt", "w");

	if(!is_null($archivo))
	{
		$vec[2] = "Coscu;Disalvo;213;200";

		fwrite($archivo, "$vec[0]$vec[1]$vec[2]");
	}

	fclose($archivo);*/

?>