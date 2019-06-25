<?php
	include_once "AccesoDatos.php";

	class Compra
	{
		public $articulo;
		public $fecha;
		public $precio;
		public $usuario;

		public function __construct($articulo, $fecha, $precio, $usuario)
		{
			$this->articulo = $articulo;
			$this->fecha = $fecha;
			$this->precio = $precio;
			$this->usuario = $usuario;
		}

		public function MostrarDatos()
	    {
	            return $this->articulo." - ".$this->fecha." - ".$this->precio;
	    }
	    
	    public static function Listar()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT articulo, fecha, precio, usuario FROM compras");	        
	        $consulta->execute();
	        
	        $data = $consulta->fetchAll(PDO::FETCH_ASSOC);                                           

	        foreach ($data as $item) 
	        {
	        	echo "Articulo: ".$item["articulo"]." Fecha: ".$item["fecha"]." Precio: ".$item["precio"]." Usuario: ".$item["usuario"];
	        }
	    }

	    public function ComprasUsuarios()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta=$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE usuario = :usuario");

	        $consulta->bindValue(':usuario', $this->usuario, PDO::PARAM_STR);

	        $consulta->execute();

	        $data = $consulta->fetchAll(PDO::FETCH_ASSOC);                                           

	        foreach ($data as $item) 
	        {
	        	echo "Articulo: ".$item["articulo"]." Fecha: ".$item["fecha"]." Precio: ".$item["precio"];
	        }
	    }
	    
	    public function AltaCompra()
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO compras (articulo, fecha, precio, usuario)"
	                                                    . "VALUES(:articulo, :fecha, :precio, :usuario)");
	        
	        $consulta->bindValue(':articulo', $this->articulo, PDO::PARAM_STR);
	        $consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
	        $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);
	        $consulta->bindValue(':usuario', $this->usuario, PDO::PARAM_STR);

	        $consulta->execute();

	    }
	    
	}

?>