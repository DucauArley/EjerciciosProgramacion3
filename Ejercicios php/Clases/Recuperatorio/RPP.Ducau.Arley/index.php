<?php

	$tipo = $_SERVER['REQUEST_METHOD'];

    switch ($tipo)
    {
        case "POST":
            if(isset($_POST["caso"]))
            {
                $caso = $_POST["caso"];

                switch($caso)
                {
                    case 'PizzaCarga':
                        require_once "PizzaCarga.php";
                        break;
                    case 'AltaVenta':
                        require_once "AltaVenta.php";
                        break;
                    case 'BorrarItem':
                        require_once "BorrarItem.php";
                        break;
                }
            }
            break;

        case "GET":
            if(isset($_GET["caso"]))
            {
                $caso = $_GET["caso"];

                switch($caso)
                {
                    case 'PizzaConsultar':
                        require_once "PizzaConsultar.php";
                        break;
                    
                    case 'ListadoDeVentas':
                        require_once "ListadoDeVentas.php";
                        break;
                    case 'ListadoDeVentas2':
                        require_once "ListadoDeVentas2.php";
                        break;
                }
            }
            break;
    }

?>