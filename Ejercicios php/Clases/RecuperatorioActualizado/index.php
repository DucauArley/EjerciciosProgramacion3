<?php

    use \Firebase\JWT\JWT;
    require "./vendor/autoload.php";
    include_once "pizza.php";
    include_once "venta.php";

    $config["displayErrorDetails"] = true;
    $config["addContentLengthHeader"] = false;
    $app = new \Slim\App(["settings" => $config]);

    $app->post('/PizzaCarga', function($request, $response)
    {  
        try
        {
            $datos = $request->getParsedBody();

            $imagen = $request->getUploadedFiles();

            $pizza = new pizza();

            $pizza->precio = $datos["precio"];
            $pizza->tipo = $datos["tipo"];
            $pizza->cantidad = $datos["cantidad"];
            $pizza->imagen = $imagen["imagen"];
            $pizza->sabor = $datos["sabor"];

            $pizza->PizzaCarga();

        }
        catch(Exception $e)
        {
            throw new Exception($e);
            
        }

    });

    $app->get('/PizzaConsultar', function($request, $response)
    {
        try
        {
            $datos = $request->getQueryParams();

            $pizza = new pizza();

            $pizza->tipo = $datos["tipo"];
            $pizza->sabor = $datos["sabor"];

            $pizza->PizzaConsultar();

        }
        catch(Exception $e)
        {
            throw new Exception($e);
        }

    });

    $app->post('/AltaVenta', function($request, $response)
    {
        try
        {
            $datos = $request->getParsedBody();

            $venta = new venta();

            $venta->email = $datos["email"];
            $venta->tipo = $datos["tipo"];
            $venta->cantidad = $datos["cantidad"];
            $venta->sabor = $datos["sabor"];

            $venta->AltaVenta();
        }
        catch(Exception $e)
        {
            throw new Exception($e);
        }

    });

    $app->get('/ListadoDeVentas', function($request, $response)
    {
        try
        {
            $venta = new venta();

            $venta->ListadoDeVentas();
        }
        catch(Exception $e)
        {
            throw new Exception($e);
        }
    });

    $app->get('/ListadoDeVentas2', function($request, $response)
    {
        try
        {
            $datos = $request->getQueryParams();

            $venta = new venta();

            if(is_null($datos["sabor"] && is_null($datos["tipo"])))
            {
                echo "Ocurrio un problema";
            }
            else
            {
                if(!is_null($datos["tipo"]))
                {
                    $venta->tipo = $datos["tipo"];
                }
                if(!is_null($datos["sabor"]))
                {
                    $venta->sabor = $datos["sabor"];
                }

                $venta->ListadoDeVentas2();
            }

        }
        catch(Exception $e)
        {
            throw new Exception($e);
        }
    });

    $app->post('/BorrarItem', function($request, $response)
    {   
        try
        {
            $pizza = new pizza();

            $pizza->BorrarItem();
                
        }
        catch(Exception $e)
        {
            throw new Exception($e);
        }
    });


    $app->run();    
?>