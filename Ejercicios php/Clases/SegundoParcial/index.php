<?php

	use \Firebase\JWT\JWT;
	require "vendor/autoload.php";
	include_once "./Usuario.php";
	include_once "./AccesoDatos.php";
	include_once "./rutas.php";
	include_once "./Materia.php";
	include_once "./Inscripcion.php";

	$config["displayErrorDetails"] = true;
	$config["addContentLengthHeader"] = false;
	$app = new \Slim\App(["settings" => $config]);


	$app->post('/usuario', \rutas::class . ':crearUsuario');

	$app->post('/login', \rutas::class . ':login');

	$app->post('/materia', \rutas::class . ':crearMateria');

	$app->post('/usuario/{legajo}', \rutas::class . ':usuarioLegajo');

	$app->post('/inscripcion/{materia}', \rutas::class . ':inscripcion');

	$app->get('/materias', \rutas::class . ':mostrarMaterias');

	$app->run();

?>