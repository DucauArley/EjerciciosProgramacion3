<?php

	class Carta
	{

		public $item;
		public $precio;

		public function __construct()
		{
		}

	    public static function TraeTodos()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT item, precio FROM carta");	        
	        $consulta->execute();
	        
	        $data = $consulta->fetchAll(PDO::FETCH_ASSOC);                                           
	        
	        return $data;
	    }

	    public function Buscar()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta=$objetoAccesoDato->RetornarConsulta("SELECT * FROM carta WHERE item=:item");

	        $consulta->bindValue(':item', $this->item, PDO::PARAM_STR);
	        $consulta->execute();
	        $data = $consulta->fetch();

	        return $data; 
	    }

	}

?>