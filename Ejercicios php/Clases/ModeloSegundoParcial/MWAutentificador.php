<?php

	require_once './vendor/autoload.php';
	use Firebase\JWT\JWT;

	class MWAutentificador
	{
		public static function VerificarToken($request, $response, $next)
		{
			$arrayToken = $request->getHeader('token');
		    $token = $arrayToken[0];
	    
		    if(empty($token) || $token === "")
		    {
		    	echo "Hola";
		    }
		    
		    try
		    {
		    	$tokenDeco = JWT::decode($token, "claveloide",['HS256'])->data;

		    	if($tokenDeco->perfil == "admin")
		    	{
		    		$request = $request->withAttribute("token", $tokenDeco);
		    		$response = $next($request, $response);
		    	}

			}
			catch(Exception $exception)
			{
				echo "Hola";
			}
			
			return $response;
		}
	}

?>