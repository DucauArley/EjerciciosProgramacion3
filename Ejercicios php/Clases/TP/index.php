<?php

	use \Firebase\JWT\JWT;
    require "./vendor/autoload.php";
    include_once "funciones.php";
    include_once "Usuario.php";
    include_once "Pedido.php";

    $config["displayErrorDetails"] = true;
    $config["addContentLengthHeader"] = false;
    $app = new \Slim\App(["settings" => $config]);

    $app->post('/AltaUsuario', \funciones::class . ':AltaUsuario');
    $app->get('/ListarUsuario', \Usuario::class . ':Listar');//->add(\MWparaAutentificar::class . ':VerificarToken');
    $app->post('/EliminarUsuario', \funciones::class . ':EliminarUsuario');//->add(\MWparaAutentificar::class . ':VerificarToken');

    $app->post('/login', \funciones::class . ':Login');

    
    $app->post('/AltaPedido', \funciones::class . ':AltaPedido');
    $app->get('/ListarPedido', \Pedido::class . ':Listar');
    $app->post('/ModificarPedido', \funciones::class . ':ModificarPedido');//->add(\MWparaAutentificar::class . ':VerificarToken');

    $app->post('/AltaCliente', \funciones::class . ':AltaCliente');//->add(\MWparaAutentificar::class . ':VerificarToken');
    $app->get('/{codigo}', \funciones::class . ':TraerTodos');

    /*$app->group('/mesa', function()
    {
        $this->post('', \funciones::class . ':CargarUno')->add(\MWparaAutentificar::class . ':VerificarToken');
        $this->post('/', \funciones::class . ':ModificarUno')->add(\MWparaAutentificar::class . ':VerificarToken');
        $this->post('/foto', \funciones::class . ':fotoMesa')->add(\MWparaAutentificar::class . ':VerificarToken');
    });

    $app->post('/', \funciones::class . ':CargarUno');
     
    $app->group('/logs', function()
    {
        $this->get('/operacionesPorSector', \funciones::class . ':OperacionesPorSector');
        $this->get('/ingresos', \funciones::class . ':Ingresos');
    })->add(\MWparaAutentificar::class . ':VerificarToken');*/


    $app->run();

?>