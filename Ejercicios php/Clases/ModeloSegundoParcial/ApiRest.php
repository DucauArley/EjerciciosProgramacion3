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
		$contador = 0;
	    $datos = $request->getParsedBody();

	    $usuario = new Usuario($datos["nombre"], $datos["clave"], $datos["sexo"], "usuario");
		
		if(!is_null($usuario->Buscar()))
		{
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

	$app->run();	
?>