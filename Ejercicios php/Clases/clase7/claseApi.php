<?php

	class claseApi
	{
		public function Post($request, $response)
		{
			$response->write("POST => Bienvenido!!!, a SlimFramework");
			return $response;
		}

		public function PostMod($request, $response, $arg)
		{
			$response->write("POST MOD => Bienvenido!!!, " . $arg["nombre"] . " a SlimFramework " . $arg["version"]);
			return $response;
		}
	}


?>