<?php
class Persona extends Humano
{
	public $dni;

	public function __construct($nombre, $apellido, $dni)
	{
		Parent::__construct($nombre, $apellido);
		$this->dni = $dni;
	}

	public function to_json()
	{
		json_encode($this);
	}
}
?>