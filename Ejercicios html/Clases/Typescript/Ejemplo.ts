namespace Animal
{
	$("#document").ready(function()
		{
			$("#btnAgregar").click(agregar);
			$("#btnModificar").click(modificar);
			$("#btnEliminar").click(eliminar);
			$("#btnListar").click(listar);
		});

	let lista:Array<Animal> = new Array<Animal>();

	function saludar(mi:Animal)
	{
		console.log(mi.hacerRuido());
	}

	function agregar()
	{
		var nombre:string = String($("#nombre").val()); //Lo mismo con los demas, ej Number()	
		var animal:string = $("#animal").val() + "";//Es lo mismo que el de arriba pero mas hardcodeado

		if(animal == "Perro")
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
		var nombre:string = String($("#nombre").val());

		lista.forEach(function(value)
		{
			if(value.nombre == nombre)
			{
				value.nombre = "Roberto";
			}
		});

	}

	function eliminar()
	{
		var nombre:string = String($("#nombre").val());
		var i = 0;

		lista.forEach(function(value)
		{
			if(value.nombre == nombre)
			{
				lista.splice(i, 1);
			}

			i++;
		});
	}

	function listar()
	{
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