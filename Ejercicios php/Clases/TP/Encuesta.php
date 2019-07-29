<?php

	include_once "AccesoDatos.php";

	class Encuesta
	{
		public $idMesa;
		public $mozo;
		public $meza;
		public $restaurant;
		public $cocinero;
		public $comentario;

		public function __construct()
		{
			$this->mozo = -1;
			$this->mesa = -1;
			$this->restaurant = -1;
			$this->cocinero = -1;
			$this->comentario = "-";
		}

		public function setComentario($coment)
		{
			if(strlen($coment) <= 66 && strlen($coment) != 0)
			{
				$this->comentario = $coment;
				return true;
			}
			else
			{
				return false;
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
	    
	    public function AltaEncuesta()
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO encuestas (idMesa, mozo, mesa, restaurant, cocinero, comentario)" . "VALUES(:idMesa, :mozo, :mesa, :restaurant, :cocinero, :comentario)");
	        
	        $consulta->bindValue(':idMesa', $this->idMesa, PDO::PARAM_STR);
	        $consulta->bindValue(':mozo', $this->mozo, PDO::PARAM_INT);
	        $consulta->bindValue(':mesa', $this->mesa, PDO::PARAM_INT);
	        $consulta->bindValue(':restaurant', $this->restaurant, PDO::PARAM_INT);
	        $consulta->bindValue(':cocinero', $this->cocinero, PDO::PARAM_INT);
	        $consulta->bindValue(':comentario', $this->comentario, PDO::PARAM_STR);
	        $consulta->execute();
	    }
	}

?>