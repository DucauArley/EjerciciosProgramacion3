<?php

	include_once "AccesoDatos.php";

	class Usuario
	{
		public $nombre;
		public $clave;
		public $tipo;
		public $activo;

		public function __construct()
		{
		}

	    public static function Listar()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT nombre, clave, tipo, activo FROM usuarios");	        
	        $consulta->execute();
	        
	        $data = $consulta->fetchAll(PDO::FETCH_ASSOC);                                           
	        foreach ($data as $item) 
	        {
	        	if($item["activo"] == 1)
	        	{
	        		$activo = "si";
	        	}
	        	else
	        	{
	        		$activo = "no";
	        	}

	        	echo "Usuario: ".$item["nombre"]." Clave: ".$item["clave"]." Tipo: ".$item["tipo"]." Activo: ".$activo . "\r\n"; 
	        }
	    }

	    public function Buscar()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta=$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE nombre=:nombre");
	        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
	        
	        $consulta->execute();
	        $data = $consulta->fetch();
	        return $data; 
	    }
	    
	    public function AltaUsuario()
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO usuarios (nombre, clave, tipo, activo)"
	                                                    . "VALUES(:nombre, :clave, :tipo, :activo)");
	        
	        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
	        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
	        $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
	        $consulta->bindValue(':activo', $this->activo, PDO::PARAM_BOOL);
	        $consulta->execute();
	    }
	    
	    public function ModificarUsuario()
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE usuarios SET activo = :activo WHERE nombre = :nombre");
	        
	        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
	        $consulta->bindValue(':activo', $this->activo, PDO::PARAM_BOOL);
	        return $consulta->execute();
	    }

	    public function EliminarUsuario()
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM usuarios WHERE nombre = :nombre");
	        
	        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
	        return $consulta->execute();
	    }
	}

?>