	<?php
	
	include 'proveedor.php';
	include 'pedido.php';

	//$proveedor1 = new proveedor($_POST["id"], $_POST["nombre"], $_POST["email"], $_FILES["foto"]["tmp_name"]);
	//$pedido1 = new pedido($_POST["producto"], $_POST["cantidad"], $_POST["idproveedor"]);
	$proveedor = new proveedor(1, "Carlos", "ajeiowjerk", "erijewitjiewt");
	$pedido = new pedido("Golosinas", 32, 5);

	//var_dump($proveedor);

	//$proveedor->cargarProveedor();

	//$proveedor->consultarProveedor($_GET["nombre"]);

	//$proveedor->listar();

	//$pedido->hacerPedido();

	//$pedido->listarPedidos();

	$pedido->listarPedidoProveedor(5);
?>