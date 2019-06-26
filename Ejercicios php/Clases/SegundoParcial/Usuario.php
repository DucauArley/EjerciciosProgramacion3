<?php

	include_once "./AccesoDatos.php";

	class Usuario
	{
		public $nombre;
		public $clave;
		public $tipo;
		public $legajo;

		public function __construct()
		{
		}
	    
	    public static function Listar()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT nombre, clave, sexo, perfil FROM usuarios");	        
	        $consulta->execute();
	        
	        $data = $consulta->fetchAll(PDO::FETCH_ASSOC);                                           

	        foreach ($data as $item) 
	        {
	        	echo "Nombre: ".$item["nombre"]." Clave: ".$item["clave"]." Sexo: ".$item["sexo"]." Perfil: ".$item["perfil"];
	        }
	    }

	    public function Buscar()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta=$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE clave=:clave AND legajo=:legajo");

	        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
	        $consulta->bindValue(':legajo',$this->legajo, PDO::PARAM_INT);

	        $consulta->execute();

	        $data = $consulta->fetch();

	        return $data; 
	    }
	    
	    public function BuscarLegajo()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta=$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE legajo=:legajo");

	        $consulta->bindValue(':legajo',$this->legajo, PDO::PARAM_INT);

	        $consulta->execute();

	        $data = $consulta->fetch();

	        return $data; 
	    }


	    public function AltaUsuario()
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO usuarios (nombre, clave, tipo)"
	                                                    . "VALUES(:nombre, :clave, :tipo)");
	        
	        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
	        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
	        $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);

	        $consulta->execute();

	    }

	    public function ModificarUsuario($email, $datos)
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE usuarios SET email = :email, datos = :datos 
	                                                         WHERE legajo = :legajo");
	        
	        $consulta->bindValue(':email', $email, PDO::PARAM_STR);
	        $consulta->bindValue(':datos', $datos, PDO::PARAM_STR);
	        $consulta->bindValue(':legajo', $this->legajo, PDO::PARAM_INT);

	        return $consulta->execute();
	    }


	}



?>