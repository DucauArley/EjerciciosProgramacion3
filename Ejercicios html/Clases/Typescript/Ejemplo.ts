namespace Animal
{
	$("#document").ready(function()
		{
			$("#btnAgregar").click(agregar);
			$("#btnListar").click(listar);
		});

	let lista:Array<Animal> = new Array<Animal>();

	function saludar(mi:Animal)
	{
		console.log(mi.hacerRuido());
	}

	function agregar()
	{
		let nombre:string = String($("#nombre").val()); //Lo mismo con los demas, ej Number()	
		let animal:string = $("#animal").val() + "";//Es lo mismo que el de arriba pero mas hardcodeado

		if(animal == "perro")
		{
			lista.push(new Perro(nombre));
		}
		else
		{
			lista.push(new Gato(nombre));
		}
	}

	function modificar()
	{

	}

	function eliminar()
	{

	}

	function listar()
	{
		var i = 0;
		lista.forEach(function(value)
		{
    		console.log(value);
    	});
	}


	//Se pueden llamar las cosas con el namespace: Animal.funcion por ejemplo
	/*Hacer formulario para dar de alta un perro o un gato
	funcion agregar, modificar, eliminar, listar todos sin parametros
	se puede guardar la lista en el local storage para asi seguir trabajando con ella

	*/
}