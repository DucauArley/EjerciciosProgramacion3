<?php

	include_once "./AccesoDatos.php";

	class Materia
	{
		public $nombre;
		public $cuatrimestre;
		public $cupos;

		public function __construct()
		{
		}
	    
	    public static function Listar()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT nombre, clave, sexo, perfil FROM materias");	        
	        $consulta->execute();
	        
	        $data = $consulta->fetchAll(PDO::FETCH_ASSOC);                                           

	        foreach ($data as $item) 
	        {
	        	echo "Nombre: ".$item["nombre"]." Cuatrimestre: ".$item["cuatrimestre"]." Sexo: ".$item["sexo"]." Perfil: ".$item["perfil"];
	        }
	    }

	    public static function ListarTodas()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT nombre, cuatrimestre, cupos FROM materias");	        
	        $consulta->execute();
	        
	        $data = $consulta->fetchAll(PDO::FETCH_ASSOC);                                           

	        foreach ($data as $item) 
	        {
	        	echo "Materia: ".$item["nombre"]."  Cuatrimestre: ".$item["cuatrimestre"]." Cupos: ".$item["cupos"] . "<br>";
	        }
	    }

	    public function Buscar()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta=$objetoAccesoDato->RetornarConsulta("SELECT * FROM materias WHERE nombre=nombre");

	        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);

	        $consulta->execute();

	        $data = $consulta->fetch();

	        return $data; 
	    }
	    
	    public function AltaMateria()
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO materias (nombre, cuatrimestre, cupos)"
	                                                    . "VALUES(:nombre, :cuatrimestre, :cupos)");
	        
	        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
	        $consulta->bindValue(':cuatrimestre', $this->cuatrimestre, PDO::PARAM_STR);
	        $consulta->bindValue(':cupos', $this->cupos, PDO::PARAM_INT);

	        $consulta->execute();

	    }

	    public function ModificarMateria()
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE materias SET cupos = :cupos 
	                                                         WHERE nombre = :nombre");
	        
	        $valor = $this->cupos;

	        $valor = (int) $valor - 1;

	        $consulta->bindValue(':cupos', $valor, PDO::PARAM_INT);
	        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);

	        return $consulta->execute();
	    }




	}


?>