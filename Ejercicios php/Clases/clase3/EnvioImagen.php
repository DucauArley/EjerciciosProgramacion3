<?php
	//Hacer marca de agua para las imagenes, hay una funcion en el git de octavio

	//$imagen = $_FILES["Koala"]["name"];
	//$destino;
    var_dump($_FILES);
    //$origen = $_FILES["Koala"]["tmp_name"];
    //var_dump($_POST);

    /*$apellido = $_POST["Apellido"];
    $legajo = $_POST["Legajo"];

    $imagen = explode(".", $imagen);
    var_dump($imagen);
    $destino = $apellido. "." . $legajo . "." . end($imagen);
    var_dump($destino); Para cambiarle el nombre a la imagen por el del apellido y el legajo que se le pase por el post*/

    foreach ($_FILES as $item) 
    {
    	if(file_exists($item["name"]))
    	{
    		move_uploaded_file($item["tmp_name"], "./Backup/" . $item["name"]);
    	}
    	else
    	{
    		move_uploaded_file($item["tmp_name"], $item["name"]);
    	}
    }

    
	
?>