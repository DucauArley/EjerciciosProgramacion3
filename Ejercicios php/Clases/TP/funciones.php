<?php

	use \Firebase\JWT\JWT;
	require "./vendor/autoload.php";
	include_once "Usuario.php";
	include_once "Pedido.php";
	include_once "Carta.php";
	include_once "Cliente.php";

	class funciones
	{

		public static function AltaUsuario($request, $response)
		{
			try
			{
				$datos = $request->getParsedBody();
				
				if($datos["tipo"] == "cervecero" || $datos["tipo"] == "bartender" || $datos["tipo"] == "cocinero" || $datos["tipo"] == "mozo" || $datos["tipo"] == "socio")
				{
					$usuario = new Usuario();
					$usuario->nombre = $datos["nombre"];
					$usuario->clave = $datos["clave"];
					$usuario->tipo = $datos["tipo"];
					$usuario->activo = true;

					$usuarioaux = $usuario->Buscar();

					if(!$usuarioaux)//Posible problema aca
					{
						//$usuario->AltaUsuario();
						echo "El usuario fue cargado exitosamente!";
					}
					else
					{
						echo "El usuario ya existe";
					}
				}

				else
				{
					echo "No se puede agregar otro tipo de usuario";
				}
			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}
		}

		public static function BorrarUsuario($request, $response)
		{
			try
			{
				$datos = $request->getParsedBody();

				if($datos["tipo"] == "socio")
				{
					$usuario = new Usuario();
					$usuario->nombre = $datos["nombre"];

					 switch($datos['caso'])
                        {
                            case "borrar":
                                $usuario->EliminarUsuario();
                                echo "Usuario borrado";
                                break;
                            case "suspender":

                                $usuario->activo = false;
                                $usuario->ModificarUsuario();
                                echo "Usuario suspendido";
                                break;
                            default:
                            	echo "No es un caso valido";
                        }
				}
				else
				{
					echo "Solo los socios pueden borrar o suspender usuarios";
				}
			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}
		}


		public static function Login($request, $response) 
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
			}
		    else
		    {
		    	echo "La clave, el nombre o el tipo no existen";
		    }
		}

		public static function AltaPedido($request, $response)
		{
			try
			{
				$datos = $request->getParsedBody();
				$pedido = new Pedido();
				$carta = new Carta();
				
				if($datos["cerveceros"])//Aca va algo para comprobar que tenga algo la parte de cerveceros lo mismo con los otros
				{
					$carta->item = $datos["cerveceros"];
					$auxCarta = $carta->Buscar()
					$pedido->tipo = "cerveceros";
					$pedido->idMesa = $datos["idMesa"];
					$pedido->cantidad = $datos["cantidad"];
					$pedido->precio = $auxCarta->precio;
					$pedido->codigo = generarCodigo();
				}

				if($datos["bartenders"])
				{
					$carta->item = $datos["bartenders"];
					$auxCarta = $carta->Buscar()
					$pedido->tipo = "bartenders";
					$pedido->idMesa = $datos["idMesa"];
					$pedido->cantidad = $datos["cantidad"];
					$pedido->precio = $auxCarta->precio;
					$pedido->codigo = generarCodigo();
				}

				if($datos["cocineros"])
				{
					$carta->item = $datos["cocineros"];
					$auxCarta = $carta->Buscar()
					$pedido->tipo = "cocineros";
					$pedido->idMesa = $datos["idMesa"];
					$pedido->cantidad = $datos["cantidad"];
					$pedido->precio = $auxCarta->precio;
					$pedido->codigo = generarCodigo();
				}

				echo "Se cargaron los pedidos correctamente";
			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}
		}

		public function generarCodigo()
    	{
	        $codigo = '';
	        $caracteres = 'abcdefghijklmnopqrstuvwxyz1234567890';
	        $max = strlen($caracteres) -1;
	        for($i=0;$i < 5;$i++) 
	        {
	            $codigo .= $caracteres{mt_rand(0,$max)};
	        }
	        
	        $pedido = new Pedido();
	        $pedido->codigo = $codigo;

	        $aux = $pedido->Esta();

	        if($aux)//posible problema aca
	        {
	            $codigo = generarCodigo();
	        }
	        else
	        {
	        	return $codigo;
	    	}
    	}

		public static function ModificarPedido($request, $response)
		{
			try
			{
				$datos = $request->getParsedBody();

				$pedidoAux = new Pedido();

				$pedidoAux->codigo = $datos["codigo"];

				$pedido = $pedidoAux->Buscar();


				//Habria que ver que keys tienen valores para asi ir reemplazando en pedido todas las cosas para poder modificarlo todo junto

				$pedido->ModificarPedido();

			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}
		}

		public static function AltaCliente($request, $response)
		{
			try
			{
				$datos = $request->getParsedBody();

				//Creo que aca iria algo de los token, asi se mas facil si es de tipo mozo o que verga es
				if($datos["tipo"] == "mozo" || $datos["tipo"] == "socio")
				{
					
				}
				else
				{
					echo "Solo los mozos/socios pueden cargar clientes";
				}



			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}
		}

		public static function ListarClientes($request, $response, $args)
		{
			try
			{




			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}
		}



	}

?>