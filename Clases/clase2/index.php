<?php

	include 'Alumno.php';

	$vec = array();
	$i = 0;
	$alumno1 = new alumno();
	$alumno2 = new alumno(); 
	$alumno3 =  new alumno();
	$alumnos = array();
	$alumnos[] = $alumno1;
	$alumnos[] = $alumno2;
	$alumnos[] = $alumno3;

	$archivo = fopen("Hola.txt", "w");

	if(!is_null($archivo))
	{

		fwrite($archivo, "Pepe;Perez;222;620" . PHP_EOL . "Juan;Lopez;435;982" . PHP_EOL . "Maria;Disalvo;423;452");
	}

	fclose($archivo);

	$archivo = fopen("Hola.txt", "r");
	var_dump($alumnos);

	if(!is_null($archivo))
	{
		while(!feof($archivo))
		{
			$vec[] =  fgets($archivo);
			$vec[$i] = explode(";", $vec[$i]);
			$alumnos[$i]->nombre = $vec[$i]->{0};
			$alumnos[$i]->apellido = $vec[$i]->{1};
			$alumnos[$i]->legajo = $vec[$i]->{2};
			$alumnos[$i]->id = $vec[$i]->{3};

			$i++;
		}

		foreach ($alumnos as $item) 
		{
			foreach($item as $var)
			{
				echo $var;
			}

			echo "<br/>";
		}

	}

	var_dump($vec);

	fclose($archivo);

	/*$archivo = fopen("Hola.txt", "w");

	if(!is_null($archivo))
	{
		$vec[2] = "Coscu;Disalvo;213;200";

		fwrite($archivo, "$vec[0]$vec[1]$vec[2]");
	}

	fclose($archivo);*/

?>