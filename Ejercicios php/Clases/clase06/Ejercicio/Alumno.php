<?php

	include_once "AccesoDato.php";

		class Alumno
		{
			public $nombre;
			public $apellido;
			public $legajo;
			public $id;

			function __construct($nombre, $apellido, $legajo, $id)
			{
				$this->nombre = $nombre;
				$this->apellido = $apellido;
				$this->legajo = $legajo;
				$this->id = $id;
			}

			function ToCSV()
			{
				$retorno = $nombre . ";" . $apellido . ";" . $legajo . ";" . $id;

				return $retorno;
			}

			function ToJson()
			{
				return json_encode($this);
			}

			public function MostrarDatos()
   			{
            	return $this->id ." - ". $this->nombre ." - ". $this->apellido ." - ". $this->legajo;
    		}

    		public function InsertarAlumno()
		    {
		        $accesoDato = AccesoDato::dameUnObjetoAcceso();
		        
		        $consulta =$accesoDato->RetornarConsulta("INSERT INTO alumno (id, nombre, apellido, legajo)"
		                                                    . "VALUES(:id, :nombre, :apellido, :legajo)");
		        
		        $consulta->bindValue(':id', $this->id, PDO::PARAM_INT);
		        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
		        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
		        $consulta->bindValue(':legajo', $this->legajo, PDO::PARAM_INT);

		        $consulta->execute();   

		    }

		    public static function EliminarAlumno($num)
		    {

		        $accesoDato = AccesoDato::dameUnObjetoAcceso();
		        
		        $consulta =$accesoDato->RetornarConsulta("DELETE FROM alumno WHERE id = :id");
		        
		        $consulta->bindValue(':id', $num, PDO::PARAM_INT);

		        return $consulta->execute();

		    }

		    public static function ModificarAlumno($id, $nombre, $apellido, $legajo)
		    {

		        $accesoDato = AccesoDato::dameUnObjetoAcceso();
		        
		        $consulta =$accesoDato->RetornarConsulta("UPDATE alumno SET nombre = :nombre, apellido = :apellido, 
		                                                        legajo = :legajo WHERE id = :id");
		        
		        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
		        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
		        $consulta->bindValue(':apellido', $apellido, PDO::PARAM_STR);
		        $consulta->bindValue(':legajo', $legajo, PDO::PARAM_INT);

		        return $consulta->execute();

		    }

		    public static function TraerAlumnos()
		    {    
		        $accesoDato = AccesoDato::dameUnObjetoAcceso();
		        
		        $consulta = $accesoDato->RetornarConsulta("SELECT id, nombre, apellido, legajo FROM alumno");        
		        
		        $consulta->execute();
		        
		        $consulta->setFetchMode(PDO::FETCH_INTO, new Alumno("Roberto", "Gomez", 34234, 4));                                                

		        return $consulta; 
		    }

		}
?>