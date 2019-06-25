<?php
	include_once "AccesoDatos.php";

	class Dato
	{
		public $usuario;
		public $metodo;
		public $ruta;
		public $hora;

		public function __construct($usuario, $metodo, $ruta)
		{
			$this->usuario = $usuario;
			$this->metodo = $metodo;
			$this->ruta = $ruta;
			$time = time() - (5 * 60 * 60);
			$this->hora = date('H:i:s',$time);
		}

	    public function AltaDato()
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO datos (usuario, metodo, ruta, hora)"
	                                                    . "VALUES(:usuario, :metodo, :ruta, :hora)");
	        
	        $consulta->bindValue(':usuario', $this->usuario, PDO::PARAM_STR);
	        $consulta->bindValue(':metodo', $this->metodo, PDO::PARAM_STR);
	        $consulta->bindValue(':ruta', $this->ruta, PDO::PARAM_STR);
	        $consulta->bindValue(':hora', $this->hora, PDO::PARAM_STR);

	        $consulta->execute();

	    }
	    
	}

?>