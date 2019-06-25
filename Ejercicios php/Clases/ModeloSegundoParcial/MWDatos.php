<?php

	require "vendor/autoload.php";
	include_once "./Dato.php";

	class MWDatos
	{

		public static function AgregarDato($request, $response, $next)
		{
			try
			{
				$response = $next($request, $response);

				$datos = $request->getAttribute("token");

				$dato = new Dato($datos->nombre, "get", "/usuario");

   				/*
   				$metodo = $request->getMethod();
    			$ruta = $request->getUri();
    			Con estas linas de codigo soluciono el no tener que hardcodear el metodo/la ruta
				*/
				var_dump($dato);

				$dato->AltaDato();

				return $response;

			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}
		}




	}
?>