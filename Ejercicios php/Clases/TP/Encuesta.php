<?php

	include_once "AccesoDatos.php";

	class Encuesta
	{
		public $mozo;
		public $meza;
		public $restaurant;
		public $cocinero;

		public function __construct()
		{
		}

	    public static function Listar()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT mozo, mesa, restaurant, cocinero FROM encuestas");	        
	        $consulta->execute();
	        
	        $data = $consulta->fetchAll(PDO::FETCH_ASSOC);                                           
	        foreach ($data as $item) 
	        {
	        	echo "Mozo: ".$item["mozo"]." Meza: ".$item["meza"]." Restaurant: ".$item["restaurant"]." Cocinero: ".$item["cocinero"];
	        }
	    }
	    
	    public function AltaCliente()
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO encuestas (mozo, mesa, restaurant, cocinero)"
	                                                    . "VALUES(:mozo, :mesa, :restaurant, :cocinero)");
	        
	        $consulta->bindValue(':mozo', $this->mozo, PDO::PARAM_INT);
	        $consulta->bindValue(':mesa', $this->mesa, PDO::PARAM_INT);
	        $consulta->bindValue(':restaurant', $this->restaurant, PDO::PARAM_INT);
	        $consulta->bindValue(':cocinero', $this->cocinero, PDO::PARAM_INT);
	        $consulta->execute();
	    }
	}

?>