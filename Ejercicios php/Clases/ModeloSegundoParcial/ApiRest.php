<?php

	//namespace Firebase\JWT;
	use \Firebase\JWT\JWT;
	require "vendor/autoload.php";
	include_once "./Usuario.php";
	include_once "./AccesoDatos.php";

	$config["displayErrorDetails"] = true;
	$config["addContentLengthHeader"] = false;
	$app = new \Slim\App(["settings" => $config]);

	$app->post('/usuario', function($request, $response) 
	{
		try
		{
			$datos = $request->getParsedBody();

		    $usuario = new Usuario($datos["nombre"], $datos["clave"], $datos["sexo"], $datos["perfil"]);

		    $usuario->AltaUsuario();
		}
		catch(Exception $e)
		{
			throw new Exception("error ", $e);
		}
	});

	$app->post('/login', function($request, $response) 
	{
	    $datos = $request->getParsedBody();

	    $usuario = new Usuario($datos["nombre"], $datos["clave"], $datos["sexo"], "usuario");

	    $aux = $usuario->Buscar();

		if($aux[0] == $usuario->nombre && $aux[1] == $usuario->clave && $aux[2] == $usuario->sexo)
		{
			$usuario->perfil = $aux[3];
			$now = time();
			$playload = array(
			"iat" => $now,
			"exp" => $now + (60),
			"data" => $usuario,
			);

			try
			{
			 	$token = JWT::encode($playload,"claveloide");
			   	return $response->withJson($token,200);	
			}
			catch(Exception $exception)
			{
				var_dump($exception);
			}
			$contador ++;
		}
	    else
	    {
	    	echo "La clave, el nombre o el sexo no existen";
	    }

	});

	$app->get('/usuario', function($request, $response)
	{
		$usuario = $request->getAttribute("usuario");
		$usuario->Listar();

	})->add(function($request, $response, $next)
	{
		$usuario = new Usuario($_GET["nombre"], $_GET["clave"], $_GET["sexo"], "usuario");

		$aux = $usuario->Buscar();

		if($aux[3] == "admin")
		{
			$request = $request->withAttribute("usuario", $usuario);
			$response = $next($request, $response);
		}
		else
		{
			$response->getBody()->write("Hola");
		}

		return $response;
	});



	$app->run();	
?>