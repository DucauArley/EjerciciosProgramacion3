<?php

	include_once "AccesoDatos.php";

	class Pedido
	{
		public $tipo;
		public $idMesa;
		public $estado;
		public $tiempo;
		public $precio;
		public $token;
		public $inicio;


		public function __construct()
		{
			$this->estado = "En espera";
			$this->tiempo = "Calculando";
			$this->inicio = new DateTime('NOW');
		}

	    public static function Listar()
	    {    
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT tipo, idMesa, estado, tiempo, precio, token, inicio FROM pedidos");	        
	        $consulta->execute();
	        
	        $data = $consulta->fetchAll(PDO::FETCH_ASSOC);                                           
	        foreach ($data as $item) 
	        {
	        	echo "Tipo: " . $item["tipo"] . " Id Mesa: " . $item["idMesa"] . " Estado: " . $item["estado"] . " Tiempo: " . $item["tiempo"] . " Precio: " . $item["precio"] . " Token: " . $item["token"] . " Inicio: " . $item["inicio"];
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
	    
	    public function AltaPedido()
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO pedidos (tipo, idMesa, estado, tiempo, precio, token, inicio)"
	                                                    . "VALUES(:tipo, :idMesa, :estado, :tiempo, :precio, :token, :inicio)");
	        
	        $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
	        $consulta->bindValue(':idMesa', $this->idMesa, PDO::PARAM_INT);
	        $consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);
	        $consulta->bindValue(':tiempo', $this->tiempo, PDO::PARAM_STR);
	        $consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);
	        $consulta->bindValue(':token', $this->token, PDO::PARAM_STR);
	        $consulta->bindValue(':inicio', $this->inicio, PDO::PARAM_STR);

	        $consulta->execute();
	    }
	    
	    public static function ModificarPedido($id, $tipo, $idMesa, $estado, $tiempo, $precio, $token, $inicio)
	    {
	        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	        
	        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE pedidos SET tipo = :tipo, idMesa = :idMesa, 
	           	estado = :estado, tiempo = :tiempo, precio = :precio, token = :token, inicio = :inicio WHERE id = :id");
	        
	        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
	        $consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
	        $consulta->bindValue(':idMesa', $idMesa, PDO::PARAM_INT);
	        $consulta->bindValue(':estado', $estado, PDO::PARAM_STR);
	        $consulta->bindValue(':tiempo', $tiempo, PDO::PARAM_STR);
	        $consulta->bindValue(':precio', $precio, PDO::PARAM_INT);
	        $consulta->bindValue(':token', $token, PDO::PARAM_STR);
	        $consulta->bindValue(':inicio', $inicio, PDO::PARAM_STR);


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