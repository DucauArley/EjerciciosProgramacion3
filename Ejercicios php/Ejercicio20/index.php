<?php
	include 'Rectangulo.php';
	include 'Punto.php';

	$punto1 = new Punto(2,3);
	$punto2 = new Punto(8,7);
	$rectangulo = new Rectangulo($punto1, $punto2);

	$rectangulo->dibujar();


?>