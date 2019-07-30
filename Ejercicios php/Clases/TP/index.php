<?php

	use \Firebase\JWT\JWT;
    require "./vendor/autoload.php";
    include_once "funciones.php";
    include_once "Usuario.php";
    include_once "Pedido.php";
    include_once "MWAutentificador.php";

    $config["displayErrorDetails"] = true;
    $config["addContentLengthHeader"] = false;
    $app = new \Slim\App(["settings" => $config]);


    $app->get('/Ingresos', \funciones::class . ':Ingresos');
    $app->get('/OperacionesPorSector', \funciones::class . ':OperacionesPorSector');

    $app->post('/AltaUsuario', \funciones::class . ':AltaUsuario');
    $app->get('/ListarUsuario', \Usuario::class . ':Listar');//->add(\MWAutentificador::class . ':VerificarTokenMS');
    $app->post('/EliminarUsuario', \funciones::class . ':BorrarUsuario')->add(\MWAutentificador::class . ':VerificarTokenMS');

    $app->post('/login', \funciones::class . ':Login');

    $app->post('/AltaPedido', \funciones::class . ':AltaPedido');
    $app->get('/ListarPedido', \Pedido::class . ':Listar');
    $app->post('/ModificarPedido', \funciones::class . ':ModificarPedido');

    $app->post('/AltaCliente', \funciones::class . ':AltaCliente')->add(\MWAutentificador::class . ':VerificarTokenMS');
    $app->get('/{codigo}', \funciones::class . ':ListarClientes');

    
    $app->post('/AltaMesa', \funciones::class . ':AltaMesa')->add(\MWAutentificador::class . ':VerificarTokenMS');
    $app->post('/ModificarMesa', \funciones::class . ':ModificarMesa')->add(\MWAutentificador::class . ':VerificarTokenMS');

    $app->post('/foto', \funciones::class . ':FotoMesa');//->add(\MWparaAutentificador::class . ':VerificarTokenMS');

    $app->post('/AltaEncuesta', \funciones::class . ':AltaEncuesta');
    

    $app->run();

?>