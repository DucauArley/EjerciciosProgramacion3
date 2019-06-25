<?php

	//namespace Firebase\JWT;
	//Falta el punto 7 y ponerlo mas lindo ya que esta todo hardcodeado, pasar el codigo de rutas a otros archivos para que quede mas lindo todo y los midware tambien. Creo que deveria hacer compra con un constructor vacio asi no lo instancio con basura ya que no necesito todos los datos de la compra
	use \Firebase\JWT\JWT;
	require "vendor/autoload.php";
	include_once "./Usuario.php";
	include_once "./AccesoDatos.php";
	include_once "./Compra.php";
	include_once "./Dato.php";
	include_once "./MWAutentificador.php";
	include_once "./MWDatos.php";
	include_once "./Funciones.php";

	$config["displayErrorDetails"] = true;
	$config["addContentLengthHeader"] = false;
	$app = new \Slim\App(["settings" => $config]);


	$app->group('/usuario', function()
	{
		$this->post('[/]', function($request, $response) 
		{
			try
			{
				$datos = $request->getParsedBody();

			    $usuario = new Usuario($datos["nombre"], $datos["clave"], $datos["sexo"], $datos["perfil"]);

			    $usuario->AltaUsuario();
			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}
		})->add(function($request, $response, $next)
		{
			try
			{
				$response = $next($request, $response);

				$datos = $request->getParsedBody();

				$dato = new Dato($datos["nombre"], "post", "/usuario");

				$dato->AltaDato();

				return $response;

			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}
		});

		$this->get('[/]', \Funciones::class . ':ListarUsuarios')->add(\MWDatos::class . ':AgregarDato')->add(\MWAutentificador::class . ':Verificartoken');

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
			"exp" => $now + (60*60),
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

	})->add(function($request, $response, $next)
	{
		try
		{
			$response = $next($request, $response);

			$datos = $request->getParsedBody();

			$dato = new Dato($datos["nombre"], "post", "/login");

			$dato->AltaDato();

			return $response;

		}
		catch(Exception $e)
		{
			throw new Exception($e);
		}
	});


	$app->group('/compra', function()
	{
		$this->post('[/]', function($request, $response)
		{
			try
			{
				$datos = $request->getParsedBody();
				$usuario = $request->getAttribute("usuario");

			    $compra = new Compra($datos["articulo"], $datos["fecha"], $datos["precio"], $usuario);

			    $compra->AltaCompra();
			}
			catch(Exception $e)
			{
				throw new Exception("error ", $e);
			}

		})->add(function($request, $response, $next)
		{
			try
			{
				$response = $next($request, $response);

				$datos = $request->getAttribute("token");

				$dato = new Dato($datos->nombre, "post", "/compra");

				var_dump($dato);

				$dato->AltaDato();

				return $response;

			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}

		})->add(function($request, $response, $next)
		{
			$arrayToken = $request->getHeader('token');
		    $token = $arrayToken[0];
	    
		    if(empty($token) || $token === "")
		    {
		    	echo "Error";
		    }
		    
		    try
		    {
		    	$tokenDeco = JWT::decode($token, "claveloide",['HS256'])->data;

		    	$request = $request->withAttribute("usuario", $tokenDeco->nombre);
		    	$response = $next($request, $response);
			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}
			
			return $response;
		});



		$this->get('[/]', function($request, $response)
		{
			try
			{
				$datos = $request->getParsedBody();
				$usuario = $request->getAttribute("usuario");

			    $compra = new Compra("algo", "algo", "algo", $usuario);

			    $compra->ComprasUsuarios();

			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}

		})->add(function($request, $response, $next)
		{
			try
			{
				$response = $next($request, $response);

				$datos = $request->getAttribute("token");

				$dato = new Dato($datos->nombre, "get", "/compra");

				var_dump($dato);

				$dato->AltaDato();

				return $response;

			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}

		})->add(function($request, $response, $next)
		{
			$arrayToken = $request->getHeader('token');
		    $token = $arrayToken[0];
	    
		    if(empty($token) || $token === "")
		    {
		    	echo "Error";
		    }
		    
		    try
		    {
		    	$tokenDeco = JWT::decode($token, "claveloide",['HS256'])->data;

		    	if($tokenDeco->perfil == "admin")
		    	{
		    		$compra = new Compra("algo", "algo", "algo", "algo");
		    		$compra->Listar();
		    	}
		    	else
		    	{
			    	$request = $request->withAttribute("usuario", $tokenDeco->nombre);
			    	$response = $next($request, $response);
			   	}
			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}
			
			return $response;
		});
	});

	$app->run();	
?>