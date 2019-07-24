<?php

	use \Firebase\JWT\JWT;
    require "./vendor/autoload.php";

    $config["displayErrorDetails"] = true;
    $config["addContentLengthHeader"] = false;
    $app = new \Slim\App(["settings" => $config]);

    $app->group('/usuario', function()
    {
        $this->post('/AltaUsuario', \Usuario::class . ':AltaUsuario');
        $this->get('/Listar', \Usuario::class . ':Listar')->add(\MWparaAutentificar::class . ':VerificarToken');
        $this->post('/borrar', \UsuarioApi::class . ':EliminarUsuario')->add(\MWparaAutentificar::class . ':VerificarToken');
    });

    $app->post('/login', function($request, $response) 
	{
	    $datos = $request->getParsedBody();
	    $usuario = new Usuario($datos["nombre"], $datos["clave"], $datos["tipo"], $datos["activo"]);
	    $aux = $usuario->Buscar();

		if($aux[0] == $usuario->nombre && $aux[1] == $usuario->clave && $aux[2] == $usuario->tipo)
		{
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
	});

    $app->group('/pedido', function(){
        $this->post('', \pedidoApi::class . ':AltaPedido');
        $this->get('', \pedidoApi::class . ':Listar');
        $this->post('/', \pedidoApi::class . ':ModificarPedido');
    })->add(\MWparaAutentificar::class . ':VerificarToken');


?>