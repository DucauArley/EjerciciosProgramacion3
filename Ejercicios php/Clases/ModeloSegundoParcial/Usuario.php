<?php
	//namespace Firebase\JWT;
	//include_once "./administracion.php";

	class Usuario
	{
		public $nombre;
		public $clave;
		public $sexo;
		public $perfil;

		public function __construct($nombre, $clave, $sexo, $perfil)
		{
			$this->nombre = $nombre;
			$this->clave = $clave;
			$this->sexo = $sexo;
			$this->perfil = $perfil;
		}

		public function MostrarDatos()
	    {
	            return $this->nombre." - ".$this->clave." - ".$this->sexo." - ".$this->perfil;
	    }
	    
	    public static function Listar()
	    {    
	        $objetoAccesoDato = administracion::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT nombre, clave, sexo, perfil FROM usuarios");	        
	        $consulta->execute();
	        
	        $consulta->setFetchMode(PDO::FETCH_INTO, new Usuario);                                                

	        return $consulta; 
	    }

	    public static function Buscar()
	    {    
	        $objetoAccesoDato = administracion::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE nombre=:nombre AND clave=:clave AND sexo=:sexo");	        
	        $consulta->execute();
	        
	        $consulta->setFetchMode(PDO::FETCH_INTO, new Usuario);                                                

	        return $consulta; 
	    }
	    
	    public function AltaUsuario()
	    {
	        $objetoAccesoDato = administracion::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO usuarios (nombre, clave, sexo, perfil)"
	                                                    . "VALUES(:nombre, :clave, :sexo, :perfil)");
	        
	        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
	        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
	        $consulta->bindValue(':sexo', $this->sexo, PDO::PARAM_STR);
	        $consulta->bindValue(':perfil', $this->perfil, PDO::PARAM_STR);

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

	    public static function EliminarCD($cd)
	    {

	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta =$objetoAccesoDato->RetornarConsulta("DELETE FROM usuarios WHERE id = :id");
	        
	        $consulta->bindValue(':id', $cd->id, PDO::PARAM_INT);

	        return $consulta->execute();

	    }

	}
?>