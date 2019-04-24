<?php
	
	include 'proveedor.php';

	//$proveedor1 = new proveedor($_POST["id"], $_POST["nombre"], $_POST["email"], $_FILES["foto"]["tmp_name"]);
	$proveedor = new proveedor(1, "Carlos", "ajeiowjerk", "erijewitjiewt");

	//var_dump($proveedor);

	//$proveedor->cargarProveedor();

	$proveedor->consultarProveedor($_GET["nombre"]);

	//$proveedor->listar();

?>