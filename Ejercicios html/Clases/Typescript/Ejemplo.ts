namespace Animal
{
	$("#document").ready(function()
		{
			$("#btnAgregar").click(agregar);
			$("#btnModificar").click(modificarOpen);
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

	function modificarOpen()
	{
		$("#contModificar").show();

		$("#btnMod").click(modificar);
	}


	function modificar()
	{
		var nombre:string = String($("#nombre").val());
		var nombreNuevo:string = String($("#nombreMod").val());
		var animalMod:string = String($("#animalMod").val());
		var i:number = 0;

		if(animalMod == "Perro")
		{
			var animal:Animal = new Perro(nombreNuevo);
		}
		else
		{
			var animal:Animal = new Gato(nombreNuevo);
		}


		lista.forEach(function(value)
		{
			if(value.nombre == nombre)
			{
				lista.splice(i, 1, animal);
			}
			i++;
		});

		$("#contModificar").hide();
	}

	function eliminar()
	{
		var nombre:string = String($("#nombre").val());
		var i:number = 0;

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