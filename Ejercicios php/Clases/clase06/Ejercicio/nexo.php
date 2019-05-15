<?php
	
	include_once "AccesoDato.php";
	include_once "Alumno.php";

	$alumno = new Alumno($_POST["nombre"], $_POST["apellido"], $_POST["legajo"], $_POST["id"]);

	$caso = $_POST["caso"];

	switch ($caso) 
	{
		case 'insertar':
			$alumno->InsertarAlumno();
			break;
		case 'eliminar':
			$alumno->EliminarAlumno($_POST["id"]);
			break;
		case 'modificar':
			$alumno->ModificarAlumno($_POST["id"], $_POST["nombre"], $_POST["apellido"], $_POST["legajo"]);
			break;
		case 'traer todos':
			$als = $alumno->TraerAlumnos();

			foreach ($als as $al) 
			{
	            
	            print_r($al->MostrarDatos());
	            print("\r\n");
        	}
			break;
		/*case 'traer uno':
			$alumno->EliminarAlumno();
			break;*/
	}

?>