<?php

	include_once "./AccesoDatos.php";

	class Inscripcion
	{
		public $materia;
		public $alumno;

		public function __construct()
		{
		}
	    
	    public static function Listar()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT materia FROM materias");	        
	        $consulta->execute();
	        
	        $data = $consulta->fetchAll(PDO::FETCH_ASSOC);     

	        echo "Materias: <br>";                                     

	        foreach ($data as $item) 
	        {
	        	echo "".$item["materia"] . "<br>";
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
	    
	    public function AltaInscripcion()
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO inscripciones (materia, alumno)"
	                                                    . "VALUES(:materia, :alumno)");
	        
	        $consulta->bindValue(':materia', $this->materia, PDO::PARAM_STR);
	        $consulta->bindValue(':alumno', $this->alumno, PDO::PARAM_STR);

	        $consulta->execute();

	    }

	}



?>