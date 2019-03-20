<?php
class Alumno extends Persona
{
	public $legajo;

	public function __construct($nombre, $apellido, $dni, $legajo)
	{
		Parent::__construct($nombre, $apellido, $dni);
		$this->legajo = $legajo;
	}

	public function to_json()
	{
		json_encode($this);
	}

}
?>