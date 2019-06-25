<?php

	require "vendor/autoload.php";
	include_once "./Usuario.php";

	class Funciones
	{
		public static function ListarUsuarios($request, $response)
		{
			$token = $request->getAttribute("token");
			$usuario = new Usuario($token->nombre, $token->clave, $token->sexo, $token->perfil);

			$usuario->Listar();
		}

	}


?>