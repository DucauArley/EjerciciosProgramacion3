<?php

	include 'FiguraGeometrica.php';
	include 'Rectangulo.php';
	include 'Triangulo.php';

	$rectangulo = new Rectangulo(4,5);
	$triangulo = new Triangulo(6,6);

	$rectangulo->Dibujar();


?>