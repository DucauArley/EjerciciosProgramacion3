<?php

	include_once "AccesoDatos.php";

	class Cliente
	{
		public $nombre;
		public $apellido;

		public function __construct()
		{
		}

	    public static function Listar()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT nombre, apellido FROM clientes");	        
	        $consulta->execute();
	        
	        $data = $consulta->fetchAll(PDO::FETCH_ASSOC);                                           
	        foreach ($data as $item) 
	        {
	        	echo "Nombre: " . $item["nombre"] . " Apellido: " . $item["apellido"];
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
	    
	    public function AltaCliente()
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO clientes (nombre, apellido)"
	                                                    . "VALUES(:nombre, :apellido)");
	        
	        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
	        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
	        $consulta->execute();
	    }
	}

?>