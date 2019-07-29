<?php

	include_once "AccesoDatos.php";

	class Mesa
	{
		public $estado;
		public $codigo;

		public function __construct()
		{
			$this->estado = "Cerrada";
		}

	    public static function Listar()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT estado, codigo FROM mesas");	        
	        $consulta->execute();
	        
	        $data = $consulta->fetchAll(PDO::FETCH_ASSOC);                                           
	        foreach ($data as $item) 
	        {
	        	echo "Estado: " . $item["estado"] . " Codigo: " . $item["codigo"];
	        }
	    }

	    public function Buscar()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta=$objetoAccesoDato->RetornarConsulta("SELECT * FROM mesas WHERE codigo=:codigo ");
	        $consulta->bindValue(':codigo', $this->codigo, PDO::PARAM_STR);

	        $consulta->execute();
	        $data = $consulta->fetch();
	        return $data; 
	    }

	     public function Esta()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta=$objetoAccesoDato->RetornarConsulta("SELECT * FROM mesas WHERE codigo=:codigo");

	        $consulta->bindValue(':codigo', $this->codigo, PDO::PARAM_STR);
	        $consulta->execute();
	        $data = $consulta->fetch();

	        if($data == false)
	        {
	        	return false;
	        }
	        else
	        {
	        	return true;
	        }

	    }
	    
	    public function AltaMesa()
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO mesas (estado, codigo)"
	                                                    . "VALUES(:estado, :codigo)");
	        
	        $consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
	        $consulta->bindValue(':codigo', $this->codigo, PDO::PARAM_STR);
	        $consulta->execute();
	    }
	    
	    public static function ModificarMesa()
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE mesas SET estado = :estado WHERE codigo = :codigo");
	        
	        $consulta->bindValue(':estado', $estado, PDO::PARAM_STR);
	        $consulta->bindValue(':codigo', $codigo, PDO::PARAM_STR);
	  
	        return $consulta->execute();
	    }

	}

?>