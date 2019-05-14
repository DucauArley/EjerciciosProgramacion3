<?php
	
	$tipo = $_SERVER['REQUEST_METHOD'];

    switch ($tipo)
    {
        case 'POST':
            if(isset($_POST["caso"]))
            {
                $caso = $_POST["caso"];

                switch($caso)
                {
                    case 'crearUsuario':
                        require_once "crearUsuario.php";
                        break;
                    case 'login':
                        require_once "login.php";
                        break;
                    
                    case 'cargarProducto':
                        require_once "cargarProducto.php";
                        break;
                    case 'modificarProducto':
                        require_once "modificarProducto.php";
                        break;
                }
            }
            break;
        case 'GET':
            if(isset($_GET["caso"]))
            {
                $caso = $_GET["caso"];

                switch($caso)
                {
                    case 'listarUsuarios':
                        require_once "listarUsuarios.php";
                        break;
                    
                    case 'listarProductos':
                        require_once "listarProductos.php";
                        break;
                    case 'listarProductos2':
                        require_once "listarProductos2.php";
                        break;
                }
            }
            break;
    }

?>