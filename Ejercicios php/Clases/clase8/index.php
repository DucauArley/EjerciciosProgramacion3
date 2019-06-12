<?php
	namespace Firebase\JWT;
	use \Firebase\JWT\JWT;
	require "vendor/autoload.php";

	use Psr\Http\Message\ServerRequestInterface as Request;
	use Psr\Http\Message\ResponseInterface as Response;

	$config["displayErrorDetails"] = true;
	$config["addContentLengthHeader"] = false;

	$app = new \Slim\App(["settings" => $config]);

	$app->post('/crearToken', function (Request $request, Response $response) 
	{
	    $name = $request->getParsedBody();
	    $now = time();
	    $playload = array(
	    "iat" => $now,
	    "exp" => $now + (60),
	    "data" => $name,
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
    
     
	});
	$app->post('/verificarToken', function (Request $request, Response $response) {
    $token =$request->getHeader('token');
    var_dump($tokenDos[0]);
    $token = $tokenDos[0];
    
    if(empty($token) || $token === ""){
    	throw new Exception("error 0x1");  	
    }
    try{
    	$tokenDeco = JWT::decode($token,
    	"clave",
    		['HS256']
    	);
    		
	}catch(Exception $exception){
		throw new Exception("error 0x2");
	}
    
    return "ok";
     
	});
	$app->run();

?>