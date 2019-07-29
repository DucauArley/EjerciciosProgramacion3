<?php

	use \Firebase\JWT\JWT;
	require "./vendor/autoload.php";
	include_once "Usuario.php";
	include_once "Pedido.php";
	include_once "Carta.php";
	include_once "Cliente.php";
	include_once "Mesa.php";
	include_once "Encuesta.php";
	include_once "manejoArchivos.php";

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
					$pedido->codigo = $this->generarCodigo();

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
					$pedido->codigo = $this->generarCodigo();

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

		public function AltaMesa($request, $response)
		{
			try
			{
				$datos = $request->getParsedBody();

				//Tengo que usar los tokens si o si
				if($datos["tipo"] == "socio")
				{
					$mesa = new Mesa();

					$mesa->codigo = $this->generarCodigo();

					$mesa->AltaMesa();

					echo "Mesa agregada";
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
					$okE = $mesa->setEstado($datos["estado"]); 
					$mesa->codigo = $datos["codigo"];

					if($okE)
					{
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
						echo "El estado al que se pretende cambiar no existe";
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
				$archivo = $request->getUploadedFiles();

				$imagen = $archivo["imagen"];

				$mesa = new Mesa();

				$mesa->codigo = $datos["codigo"];

				if($datos["tipo"] == "mozo" || $datos["tipo"] == "socio" && $mesa->Esta())
				{
					$array = $imagen->getClientFileName();
					$array = explode(".", $array);
					$path = $datos["codigo"] . "-" . date("d.m.y") . "." . end($array);

					$imagen->moveTo("./fotos/" . $path);
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
				$datos = $request->getParsedBody();
				$mesa = new Mesa();
				$mesa->codigo = $datos["codigo"];

				if($mesa->Esta())
				{
					$mesa = $mesa->Buscar();

					if(strcasecmp($mesa["estado"], "cerrada") == 0)
					{
						$encuesta = new Encuesta();
						$encuesta->idMesa = $mesa["codigo"];

						if($datos["mozo"] <= 10 && $datos["mozo"] >= 0)
						{
							$encuesta->mozo = $datos["mozo"];
						}

						if($datos["restaurant"] <= 10 && $datos["restaurant"] >= 0)
						{
							$encuesta->restaurant = $datos["restaurant"];
						}

						if($datos["mesa"] <= 10 && $datos["mesa"] >= 0)
						{
							$encuesta->mesa = $datos["mesa"];
						}

						if($datos["cocinero"] <= 10 && $datos["cocinero"] >= 0)
						{
							$encuesta->cocinero = $datos["cocinero"];
						}

						$ok = $encuesta->setComentario($datos["comentario"]);


						if($ok)
						{
							$encuesta->AltaEncuesta();
							echo "Encuesta realizada";
						}
						else
						{
							echo "El comentario excedio los caracteres permitidos";
						}
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

		public function getToken($request)
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

		public static function OperacionesPorSector($request, $response)
		{
			try
			{
				//Segun esta logica, habria que guardar en un txt todos los pedidos, aunque los podria leer de la base de datos y asi no hacer un re quilombo con manejo de archivos y toda esa verga
				$arrayPedidos = logs::leerArchivo("../logs/logs.txt");
		        $mozos = 0;
		        $bartender​ = 0;
		        $cerveceros​ = 0;
		        $cocineros​ = 0;
		        foreach($arrayPedidos as $value)
		        {
		            if(strcasecmp($value["Tipo"], "mozos") == 0)
		            {                
		                $mozos++;
		            }

		            if(strcasecmp($value["Tipo"], "bartender​") == 0)
		            {
		                $bartender​++;
		            }

		            if(strcasecmp($value["Tipo"], "cerveceros​") == 0)
		            {
		                $cerveceros​++;
		            }

		            if(strcasecmp($value["Tipo"], "cocineros​") == 0)
		            {
		                $cocineros​++;  
		            }
		            
		        }
		        $objRespuesta = new stdClass;
		        $objRespuesta->Mozos = $mozos;
		        $objRespuesta->Bartender​ = $bartender​;
		        $objRespuesta->Cerveceros​ = $cerveceros​;
		        $objRespuesta->Cocineros​ = $cocineros​;
		        return $response->withJson($objRespuesta, 200);
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
				//Lo mismo para este, habria que sumar todos los precios
			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}
		}

	}

?>