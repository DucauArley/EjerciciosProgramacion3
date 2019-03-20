<?php
	include 'C:\xampp\htdocs\clase1\Clases\Humano.php';
	include 'C:\xampp\htdocs\clase1\Clases\Persona.php';
	include 'C:\xampp\htdocs\clase1\Clases\Alumno.php';

	$humano = new Humano("Juan", "Perez");
	$persona = new Persona("Rodolfo", "Ramirez", "14269874");
	$alumno = new Alumno("Roman", "Pellita", "34165414", "14000");

	var_dump($humano);
	var_dump($persona);
	var_dump($alumno);
?>