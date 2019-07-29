<?php

	include_once "AccesoDatos.php";

	class Encuesta
	{
		public $mozo;
		public $meza;
		public $restaurant;
		public $cocinero;
		public $comentario;

		public function __construct()
		{
		}

		public function setComentario($coment)
		{
			if(strlen($coment) <=66 )
			{
				$this->comentario = $coment;
			}
			else
			{
				echo "El comentario excedio los caracteres permitidos";
			}
		}

	    public static function Listar()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT mozo, mesa, restaurant, cocinero, comentario FROM encuestas");	        
	        $consulta->execute();
	        
	        $data = $consulta->fetchAll(PDO::FETCH_ASSOC);                                           
	        foreach ($data as $item) 
	        {
	        	echo "Mozo: " . $item["mozo"] . " Meza: " . $item["meza"] . " Restaurant: " . $item["restaurant"] . " Cocinero: " . $item["cocinero"] . " Comentario: " . $item["comentario"];
	        }
	    }
	    
	    public function AltaCliente()
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO encuestas (mozo, mesa, restaurant, cocinero, comentario)"
	                                                    . "VALUES(:mozo, :mesa, :restaurant, :cocinero, :comentario)");
	        
	        $consulta->bindValue(':mozo', $this->mozo, PDO::PARAM_INT);
	        $consulta->bindValue(':mesa', $this->mesa, PDO::PARAM_INT);
	        $consulta->bindValue(':restaurant', $this->restaurant, PDO::PARAM_INT);
	        $consulta->bindValue(':cocinero', $this->cocinero, PDO::PARAM_INT);
	        $consulta->bindValue(':comentario', $this->comentario, PDO::PARAM_STR);
	        $consulta->execute();
	    }
	}

?>