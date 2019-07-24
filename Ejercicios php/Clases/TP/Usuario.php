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
	        	if($item["activo"] == true)
	        	{
	        		$activo = "si";
	        	}
	        	else
	        	{
	        		$activo = "no";
	        	}

	        	echo "Usuario: ".$item["nombre"]." Clave: ".$item["clave"]." Tipo: ".$item["tipo"]." Activo: ".$item["activo"];
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
	    
	    public function AltaUsuario()
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO usuarios (nombre, clave, tipo, activo)"
	                                                    . "VALUES(:nombre, :clave, :sexo, :perfil)");
	        
	        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
	        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
	        $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
	        $consulta->bindValue(':activo', $this->activo, PDO::PARAM_BOOL);
	        $consulta->execute();
	    }
	    
	    public static function ModificarCD($nombre, $clave, $sexo, $perfil)
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE usuarios SET nombre = :nombre, sexo = :sexo, 
	                                                        perfil = :perfil WHERE id = :id");
	        
	        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
	        $consulta->bindValue(':titulo', $titulo, PDO::PARAM_INT);
	        $consulta->bindValue(':anio', $anio, PDO::PARAM_INT);
	        $consulta->bindValue(':cantante', $cantante, PDO::PARAM_STR);
	        return $consulta->execute();
	    }

	    public static function EliminarUsuario($id)
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM usuarios WHERE id = :id");
	        
	        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
	        return $consulta->execute();
	    }
	}

?>