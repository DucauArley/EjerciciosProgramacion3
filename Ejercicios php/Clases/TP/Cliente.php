<?php

	include_once "AccesoDatos.php";

	class Cliente
	{
		public $nombre;
		public $apellido;
		public $mesa;

		public function __construct()
		{
		}

	    public function Listar()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT nombre, apellido, mesa FROM clientes");	        
	        $consulta->execute();
	        
	        $data = $consulta->fetchAll(PDO::FETCH_ASSOC);                                           
	        foreach ($data as $item) 
	        {
	        	echo "Nombre: " . $item["nombre"] . " Apellido: " . $item["apellido"] . " Mesa: " . $item["mesa"];
	        }
	    }

	    public function Buscar()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta=$objetoAccesoDato->RetornarConsulta("SELECT * FROM clientes WHERE mesa=:mesa");

	        $consulta->bindValue(':mesa', $this->mesa, PDO::PARAM_STR);
	        $consulta->execute();
	        $data = $consulta->fetch(PDO::FETCH_ASSOC);
	        return $data; 
	    }
	    
	    public function AltaCliente()
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO clientes (nombre, apellido, mesa)"
	                                                    . "VALUES(:nombre, :apellido, :mesa)");
	        
	        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
	        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
	        $consulta->bindValue(':mesa', $this->mesa, PDO::PARAM_STR);
	        $consulta->execute();
	    }

	    public function ModificarCliente($id)
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE clientes SET nombre = :nombre, apellido = :apellido, mesa = :mesa WHERE id = :id");
	        
	        $consulta->bindValue(':id', $id, PDO::PARAM_STR);
	        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
	        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_BOOL);
	        $consulta->bindValue(':mesa', $this->mesa, PDO::PARAM_STR);

	        return $consulta->execute();
	    }
	}

?>