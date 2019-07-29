<?php

	use \Firebase\JWT\JWT;
	require "./vendor/autoload.php";
	include_once "Usuario.php";
	include_once "Pedido.php";
	include_once "Carta.php";
	include_once "Cliente.php";
	include_once "Mesa.php";
	include_once "Encuesta.php";

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

					if(!$usuarioaux)
					{
						$usuario->AltaUsuario();
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

				if($datos["tipo"] == "socio")//Tendria que usar token asi me aseguro que es socio
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
		    $usuario = new Usuario();
		    $usuario->nombre = $datos["nombre"];
		    $usuario->clave = $datos["clave"];
		    $usuario->tipo = $datos["tipo"];
		    $aux = $usuario->Buscar();

			if($aux[0] == $usuario->nombre && $aux[1] == $usuario->clave && $aux[2] == $usuario->tipo && $aux[3] == 1)
			{
				$usuario->activo = true;
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
		    	echo "La clave, el nombre o el tipo no existen o el usuario no esta activo";
		    }
		}

		//Hasta aca funciona todo

		//Las cosas de pedidos las dejo para despues porque depende de muchas cosas
		public function AltaPedido($request, $response)
		{
			try
			{
				$datos = $request->getParsedBody();
				$pedido = new Pedido();
				$carta = new Carta();
				
				if(isset($datos["cerveceros"]))
				{
					$carta->item = $datos["cerveceros"];
					$auxCarta = $carta->Buscar();
					$pedido->tipo = "cerveceros";
					$pedido->idMesa = $datos["idMesa"];//Le tendria que pasar el codigovich de la mesovich
					$pedido->cantidad = $datos["cantidad"];
					$pedido->precio = $auxCarta->precio * $pedido->cantidad;
					$pedido->codigo = $this->generarCodigo();
					var_dump($pedido);
					//$pedido->AltaPedido();
				}

				if(isset($datos["bartenders"]))
				{
					$carta->item = $datos["bartenders"];
					$auxCarta = $carta->Buscar();
					$pedido->tipo = "bartenders";
					$pedido->idMesa = $datos["idMesa"];
					$pedido->cantidad = $datos["cantidad"];
					$pedido->precio = $auxCarta->precio;
					$pedido->codigo = generarCodigo();

					$pedido->AltaPedido();
				}

				if(isset($datos["cocineros"]))
				{
					$carta->item = $datos["cocineros"];
					$auxCarta = $carta->Buscar();
					$pedido->tipo = "cocineros";
					$pedido->idMesa = $datos["idMesa"];
					$pedido->cantidad = $datos["cantidad"];
					$pedido->precio = $auxCarta->precio;
					$pedido->codigo = generarCodigo();

					$pedido->AltaPedido();
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
	        $mesa = new Mesa();
	        $mesa->codigo = $codigo;

	        $auxPed = $pedido->Esta();
	        $auxMes = $mesa->Esta();

	        if($auxPed || $auxMes)//posible problema aca
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

				//Creo que tambien habria que poner algo de los tokens para saber si es mozo o socio
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
					$cliente = new Cliente();

					$cliente->nombre = $datos["nombre"];
					$cliente->apellido = $datos["apellido"];

					$cliente->AltaCliente();

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
				$pedido = new Pedido();
				$pedido->idMesa = $args["codigo"];

				$pedido->ListarPorMesa();
			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}
		}

		public static function AltaMesa($request, $response)
		{
			try
			{
				$datos = $request->getParsedBody();

				//Tengo que usar los tokens si o si
				if($datos["tipo"] == "socio")
				{
					$mesa = new Mesa();

					$mesa->codigo = generarCodigo();

					$mesa->AltaMesa();
				}
				else
				{
					echo "Solamente los socios puden cargar mesas";
				}

			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}
		}

		public static function ModificarMesa($request, $response)
		{
			try
			{
				$datos = $request->getParsedBody();
				//Usar los tokens para saber si es mozo o socio

				if($datos["tipo"] == "mozo" || $datos["tipo"] == "socio")
				{
					$mesa = new Mesa();
					$mesa->estado = $datos["estado"]; 
					$mesa->codigo = $datos["codigo"];

					$ok = $mesa->ModificarMesa();

					if($ok)
					{
						echo "Se modifico la mesa exitosamente";
					}
					else
					{
						echo "No se encontro la mesa";
					}
				}
				else
				{
					echo "Solamente los mozos y los socios pueden modificar";
				}
			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}
		}

		public static function FotoMesa($request, $response)
		{
			try
			{
				$datos = $request->getParsedBody();

				if($datos["tipo"] == "mozo" || $datos["tipo"] == "socio")
				{

					$array = $imagen->getClientFileName();
					$array = explode(".", $array);


					$imagen->moveTo("./fotos/" . $imagen->getClientFileName());


				}
				else
				{
					echo "Solamente mozos y socios pueden agregar fotos";
				}

			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}
		}


		public static function AltaEncuesta($request, $response)
		{
			try
			{
				//Tendria que poner algo que diga que hay un problema si no se puso un puntaje correcto o algo pero lo voy a hacer cuando empiece a debugear Aguante k1ng vieja es lo mas grande que hay, mas grande que bokita el mas grande
				$datos = $request->getParsedBody();
				$mesa = new Mesa();
				$mesa->codigo = $datos["codigo"];

				if($mesa->Esta())//Posible error
				{
					$mesa = $mesa->Buscar();

					if($mesa->estado == "cerrada")
					{
						$encuesta = new Encuesta();
						$encuesta->mozo = $datos["mozo"];
						$encuesta->restaurant = $datos["restaurant"];
						$encuesta->mesa = $datos["mesa"];
						$encuesta->cocinero = $datos["cocinero"];
						$encuesta->setComentario($datos["comentario"]);

						$encuesta->AltaEncuesta();
					}
					else
					{
						echo "La mesa debe estar cerrada";
					}

				}
				else
				{
					echo "La mesa no existe";
				}

			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}
		}

		public static function OperacionesPorSector($request, $response)
		{
			try
			{
				
			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}
		}

		public static function Ingresos($request, $response)
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