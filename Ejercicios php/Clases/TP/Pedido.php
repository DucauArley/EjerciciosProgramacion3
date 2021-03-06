<?php

	include_once "AccesoDatos.php";

	class Pedido
	{
		public $tipo;
		public $idMesa;	
		public $estado;
		public $tiempo;
		public $cantidad;
		public $precio;
		public $codigo;
		public $inicio;


		public function __construct()
		{
			date_default_timezone_set("America/Argentina/Buenos_Aires");
			$this->estado = "En espera";
			$this->tiempo = "Calculando";
			$this->inicio = date("d.m.y H:i:s");
		}

	    public static function Listar()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT tipo, idMesa, estado, tiempo, cantidad, precio, codigo, inicio FROM pedidos");	        
	        $consulta->execute();
	        
	        $data = $consulta->fetchAll(PDO::FETCH_ASSOC);                                           
	        foreach ($data as $item) 
	        {
	        	echo "Tipo: " . $item["tipo"] . " Id Mesa: " . $item["idMesa"] . " Estado: " . $item["estado"] . " Tiempo: " . $item["tiempo"] . " Cantidad: " . $item["cantidad"] . " Precio: " . $item["precio"] . " Codigo: " . $item["codigo"] . " Inicio: " .$item["inicio"];
	        }
	    }

	    public static function TraerTodos()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT tipo, idMesa, estado, tiempo, cantidad, precio, codigo, inicio FROM pedidos");	        
	        $consulta->execute();
	        
	        $data = $consulta->fetchAll(PDO::FETCH_ASSOC);                                           
	        

	        return $data;
	    }

	    public function setEstado($estado)
	    {
	    	if($estado == "en preparacion" || $estado == "listo para servir")
	    	{
	    		$this->estado = $estado;
	    	}
	    	else
	    	{
	    		echo "No existe ese estado";
	    	}
	    }


	    public static function ListarPorMesa()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT tipo, idMesa, estado, tiempo, cantidad, precio, codigo, inicio FROM pedidos WHERE idMesa = :idMesa");	 

	        $consulta->bindValue(':idMesa', $this->idMesa, PDO::PARAM_STR);       
	        $consulta->execute();
	        
	        $data = $consulta->fetchAll(PDO::FETCH_ASSOC);                                           
	        foreach ($data as $item) 
	        {
	        	echo "Tipo: " . $item["tipo"] . " Id Mesa: " . $item["idMesa"] . " Estado: " . $item["estado"] . " Tiempo: " . $item["tiempo"] . " Cantidad: " . $item["cantidad"] . " Precio: " . $item["precio"] . " Codigo: " . $item["codigo"] . " Inicio: " . $item["inicio"];
	        }
	    }

	    public function Esta()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta=$objetoAccesoDato->RetornarConsulta("SELECT * FROM pedidos WHERE codigo=:codigo");

	        $consulta->bindValue(':codigo', $this->codigo, PDO::PARAM_STR);
	        $consulta->execute();
	        $data = $consulta->fetch();

	        if($data == false)
	        {
	        	return false;
	        }
	        else
	        {
	        	return true;
	        }

	    }
	    
	     public function Buscar()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta=$objetoAccesoDato->RetornarConsulta("SELECT * FROM pedidos WHERE codigo=:codigo");

	        $consulta->bindValue(':codigo', $this->codigo, PDO::PARAM_STR);
	        $consulta->execute();
	        $data = $consulta->fetch(PDO::FETCH_ASSOC);

	        return $data;
	    }

	    public function AltaPedido()
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO pedidos (tipo, idMesa, estado, tiempo, cantidad, precio, codigo, inicio)" . "VALUES(:tipo, :idMesa, :estado, :tiempo, :cantidad, :precio, :codigo, :inicio)");
	        
	        $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
	        $consulta->bindValue(':idMesa', $this->idMesa, PDO::PARAM_STR);
	        $consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
	        $consulta->bindValue(':tiempo', $this->tiempo, PDO::PARAM_STR);
	        $consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
	        $consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);
	        $consulta->bindValue(':codigo', $this->codigo, PDO::PARAM_STR);
	        $consulta->bindValue(':inicio', $this->inicio, PDO::PARAM_STR);

	        $consulta->execute();
	    }
	    
	    public function ModificarPedido()
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE pedidos SET tipo = :tipo, idMesa = :idMesa, 
	           	estado = :estado, tiempo = :tiempo, cantidad = :cantidad, precio = :precio, inicio = :inicio WHERE codigo = :codigo");
	        
	        $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
	        $consulta->bindValue(':idMesa', $this->idMesa, PDO::PARAM_STR);
	        $consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
	        $consulta->bindValue(':tiempo', $this->tiempo, PDO::PARAM_STR);
	        $consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
	        $consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);
	        $consulta->bindValue(':codigo', $this->codigo, PDO::PARAM_STR);
	        $consulta->bindValue(':inicio', $this->inicio, PDO::PARAM_STR);


	        return $consulta->execute();
	    }
	}

?>