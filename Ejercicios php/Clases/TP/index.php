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
    $app->post('/EliminarUsuario', \funciones::class . ':BorrarUsuario');//->add(\MWparaAutentificar::class . ':VerificarToken');

    $app->post('/login', \funciones::class . ':Login');

    $app->post('/AltaPedido', \funciones::class . ':AltaPedido');
    $app->get('/ListarPedido', \Pedido::class . ':Listar');
    $app->post('/ModificarPedido', \funciones::class . ':ModificarPedido');//->add(\MWparaAutentificar::class . ':VerificarToken');

    $app->post('/AltaCliente', \funciones::class . ':AltaCliente');//->add(\MWparaAutentificar::class . ':VerificarToken');
    $app->get('/{codigo}', \funciones::class . ':ListarClientes');

    
    $app->post('/AltaMesa', \funciones::class . ':AltaMesa');//->add(\MWparaAutentificar::class . ':VerificarToken');
    $app->post('/ModificarMesa', \funciones::class . ':ModificarMesa');//->add(\MWparaAutentificar::class . ':VerificarToken');
    $app->post('/foto', \funciones::class . ':FotoMesa');//->add(\MWparaAutentificar::class . ':VerificarToken');

    $app->post('/AltaEncuesta', \funciones::class . ':AltaEncuesta');
     
    /*$app->group('/logs', function()
    {
        $this->get('/operacionesPorSector', \funciones::class . ':OperacionesPorSector');
        $this->get('/ingresos', \funciones::class . ':Ingresos');
    })->add(\MWparaAutentificar::class . ':VerificarToken');*/


    $app->run();

?>