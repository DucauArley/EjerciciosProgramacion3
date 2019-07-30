<?php

	use \Firebase\JWT\JWT;
	require "./vendor/autoload.php";
	include_once "Usuario.php";
	include_once "Pedido.php";
	include_once "Carta.php";
	include_once "Cliente.php";
	include_once "Mesa.php";
	include_once "Encuesta.php";
	include_once "MWAutentificador.php";

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
				$socio = $request->getAttribute("token");

				if($socio->tipo == "socio")
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
				"exp" => $now + (60*360),
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

		public function AltaPedido($request, $response)
		{
			try
			{
				$datos = $request->getParsedBody();
				$pedido = new Pedido();
				$carta = new Carta();
				$mesa = new Mesa();
				$auxCli = new Cliente();

				$auxCli->mesa = $datos["codigo"];
				$mesa->codigo = $datos["codigo"];	
			
				$cliente = $auxCli->Buscar();

				if($mesa->Esta() && $cliente["nombre"] != "")
				{
					if(isset($datos["cerveceros"]))
					{
						$carta->item = $datos["cerveceros"];
						$auxCarta = $carta->Buscar();
						if($auxCarta["item"] != "")
						{
							$pedido->tipo = "cervecero";
							$pedido->idMesa = $mesa->codigo;
							$pedido->cantidad = $datos["cantidadCer"];
							$pedido->precio = $auxCarta["precio"] * $pedido->cantidad;
							$pedido->codigo = $this->generarCodigo();

							var_dump($pedido);

							$pedido->AltaPedido();
						}
						else
						{
							echo "No existe ese producto en la carta de cervezas";
						}
					}

					if(isset($datos["bartenders"]))
					{
						$carta->item = $datos["bartenders"];
						$auxCarta = $carta->Buscar();
						if($auxCarta["item"] != "")
						{
							$pedido->tipo = "bartender";
							$pedido->idMesa = $mesa->codigo;
							$pedido->cantidad = $datos["cantidadBar"];
							$pedido->precio = $auxCarta["precio"] * $pedido->cantidad;
							$pedido->codigo = $this->generarCodigo();

							var_dump($pedido);

							$pedido->AltaPedido();
						}
						else
						{
							echo "No existe ese producto en la carta de tragos y vinos";
						}
					}

					if(isset($datos["cocineros"]))
					{
						$carta->item = $datos["cocineros"];
						$auxCarta = $carta->Buscar();
						if($auxCarta["item"] != "")
						{
							$pedido->tipo = "cocinero";
							$pedido->idMesa = $mesa->codigo;
							$pedido->cantidad = $datos["cantidadCo"];
							$pedido->precio = $auxCarta["precio"] * $pedido->cantidad;
							$pedido->codigo = $this->generarCodigo();

							var_dump($pedido);

							$pedido->AltaPedido();
						}
						else
						{
							echo "No existe ese producto en la carta de comida";
						}
					}

				}
				else
				{
					echo "La mesa no existe o no tiene clientes";
				}

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

	        if($auxPed || $auxMes)
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
				$mw = new MWAutentificador();

				$pedido= new Pedido();

				$pedido->codigo = $datos["codigo"];

				$pedidoAux = $pedido->Buscar();

				$pedido->estado = $pedidoAux["estado"];
				$pedido->tipo = $pedidoAux["tipo"];
				$pedido->idMesa = $pedidoAux["idMesa"];
				$pedido->tiempo = $pedidoAux["tiempo"];
				$pedido->cantidad = $pedidoAux["cantidad"];
				$pedido->precio = $pedidoAux["precio"];
				$pedido->inicio = $pedidoAux["inicio"];

				$usuario = $mw->getToken($request);

				if($pedido->tipo == $usuario->tipo)
				{
					if(isset($datos["estado"]))
					{
						$pedido->setEstado($datos["estado"]);
					}

					if(isset($datos["tiempo"]))
					{
						$pedido->tiempo = $datos["tiempo"];
					}

					if(isset($datos["cantidad"]))
					{
						$pedido->cantidad = $datos["cantidad"];
					}	


					$pedido->ModificarPedido();

					echo "Se modifico exitosamente";
				}
				else
				{
					echo "No puede modificar un pedido de otro sector o este no existe";
				}
			
			
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
				$mesa = new Mesa();

				$mesa->codigo = $datos["codigo"];

				$usuario = $request->getAttribute("token");

				if($mesa->Esta())
				{
					$aux = new Cliente();
					$aux->mesa = $mesa->codigo;

					if(!$aux->Buscar())//Posible error
					{
						$cliente = new Cliente();

						$cliente->nombre = $datos["nombre"];
						$cliente->apellido = $datos["apellido"];
						$cliente->mesa = $mesa->codigo;
						$cliente->AltaCliente();

						echo "Se cargo el cliente exitosamente";
					}
					else
					{
						echo "La mesa esta ocupada";
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

				$usuario = $request->getAttribute("token");

				if($usuario->tipo == "socio")
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
				
				$usuario = $request->getAttribute("token");
				$okE = false;

				$mesa = new Mesa();
				if($datos["estado"] != "cerrada")
				{
					$okE = $mesa->setEstado($datos["estado"]);
				}
				else
				{
					if($datos["estado"] == "cerrada" && $usuario->tipo == "socio")
					{
						$okE = $mesa->setEstado($datos["estado"]);
					}
					else
					{
						echo "Solamente los socios pueden cerrar una mesa";
					}
				}
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

				$usuario = $request->getAttribute("token");

				if($usuario->tipo == "mozo" || $usuario->tipo == "socio" && $mesa->Esta())
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

		public function OperacionesPorSector($request, $response)
		{
			try
			{
				$pedido = new Pedido();

				$arrayPedidos = $pedido->TraerTodos();
		        $bartender​ = 0;
		        $cerveceros​ = 0;
		        $cocineros​ = 0;

		        foreach($arrayPedidos as $item)
		        {
		            if(strcasecmp($item["tipo"], "bartender​") == 0)
		            {
		                $bartender​++;
		            }

		            if(strcasecmp($item["tipo"], "cervecero") == 0)
		            {
		                $cerveceros​++;
		            }

		            if(strcasecmp($item["tipo"], "cocinero") == 0)
		            {
		                $cocineros​++;  
		            }
		            
		        }

		       	//echo "Bartenders: " . $bartender ​. " Cerveceros: " . $cerveceros . " Cocineros: " . $cocineros;
		       	//No se porque carajo no me funciona
			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}
		}

		public function Ingresos($request, $response)
		{
			try
			{
				$pedido = new Pedido();

				$arrayPedidos = $pedido->TraerTodos();
				$total = 0;
				
				foreach ($arrayPedidos as $item) 
				{
					$total = $item["precio"] + $total;
				}


				echo "Ingresos totales: " . $total;
			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}
		}

		/*public static function OrdenadaPorSectorLista($request, $response)
		{
			try
			{
				$pedido = new Pedido();

				$arrayPedidos = $pedido->TraerTodos();
				$total = 0;
				
				foreach ($arrayPedidos as $item) 
				{
					$total = $item["precio"] + $total;
				}


				echo "Ingresos totales: " . $total;
			}
			catch(Exception $e)
			{
				throw new Exception($e);
			}
		}*/


	}

?>