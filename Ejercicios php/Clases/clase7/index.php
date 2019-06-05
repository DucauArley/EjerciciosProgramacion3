<?php	
	require "vendor/autoload.php";
	require_once "claseApi.php";
	// use Psr\Http\Message\ServerRequestInterface as Request;
	// use Psr\Http\Message\ResponseInterface as Response;

	$config["displayErrorDetails"] = true;
	$config["addContentLengthHeader"] = false;

	$app = new \Slim\App(["settings" => $config]);

	$app->get("/saludo", function($request, $response)
	{
		$response->getBody()->write("GET => Bienvenido!!!, a SlimFramework");
		return $response;
	});

	$app->post("[/]", function($request, $response)
	{
		$response->write("POST => Bienvenido!!!, a SlimFramework");
		return $response;
	});

	$app->put("/{nombre}", function($request, $response, $arg)
	{
		$response->getBody()->write("PUT => Bienvenido!!!, " . $arg["nombre"] ." a SlimFramework");
		return $response;
	});

	$app->delete("/saludo[/]", function($request, $response)
	{
		$response->getBody()->write("delete() => Bienvenido!!!, a SlimFramework");
		return $response;
	});

	$app->group("/cd", function()
	{
		$this->get("/", function($request, $response)
		{
			$response->write("GET => Bienvenido!!!, a SlimFramework");
			return $response;
		});

		$this->get("/{nombre}-{version}", function($request, $response, $arg)
		{
			$response->write("GET MOD => Bienvenido!!!, " . $arg["nombre"] . " a SlimFramework " . $arg["version"]);
			return $response;
		});

		$this->post("/", \claseApi::class . ':Post');


		$this->post("/{nombre}-{version}", \claseApi::class . ':PostMod');
	});

	//Git de octavio APIREST-PHP-POO-JWT-MIDDLEWARE-Documentar/apirestV2-POO Tiene lo de pasar los comandos sql por post, get, etc hacer alta baja y modificacion de sql que tendria que haber hecho para hoy con esto nuevo
	//Tp TP_PROG3_1C_2018 git de octavio creo que hay que hacerle un fork para que lo evaluen o algo asi pero la verdad que no tengo ni idea porque supuestamente lo teniamos que subir a un servidor pero que se yo

	$app->run();
?>