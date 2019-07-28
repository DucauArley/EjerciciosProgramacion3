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
	        
	        $consulta=$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE nombre=:nombre AND clave=:clave AND tipo=:tipo");
	        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
	        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
	        $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
	        $consulta->execute();
	        $data = $consulta->fetch();
	        return $data; 
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
	    
	    public static function ModificarMesa($id, $estado, $codigo)
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE mesas SET estado = :estado, codigo = :codigo WHERE id = :id");
	        
	        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
	        $consulta->bindValue(':estado', $estado, PDO::PARAM_STR);
	        $consulta->bindValue(':codigo', $codigo, PDO::PARAM_STR);
	  
	        return $consulta->execute();
	    }

	}

?>