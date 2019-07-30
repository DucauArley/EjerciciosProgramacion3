<?php
	require_once './vendor/autoload.php';
	use Firebase\JWT\JWT;

	class MWAutentificador
	{
		public function VerificarTokenMS($request, $response, $next)
		{
		    try
		    {
		    	$token = $this->getToken($request);

		    	if($token->tipo == "mozo" || $token->tipo == "socio")
		    	{
		    		$request = $request->withAttribute("token", $token);
		    		$response = $next($request, $response);
		    	}
		    	else
		    	{
		    		echo "Solamente mozos y socios pueden realizar ciertas acciones";
		    	}
			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}
			
			return $response;
		}

		public function getToken($request)
		{
			try
			{
				$arrayToken = $request->getHeader('token');
				$token = $arrayToken[0];
			    
				if(empty($token) || $token === "")
				{
				  	echo "Error";
				}
					    
			    $tokenDeco = JWT::decode($token, "claveloide",['HS256'])->data;

			    return $tokenDeco;
			}
			catch(Exception $e)
			{
				throw new Exception("El token ingresado no es valido");
				
			}
		}



	}
?>