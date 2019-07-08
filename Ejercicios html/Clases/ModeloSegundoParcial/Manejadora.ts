namespace Personas
{
	$("#document").ready(function()
		{
			$("#btnAgregar").click(agregarEmpleado);
			$("#btnCancelar").click(limpiarFormulario);
			$("#btnMostrar").click(mostrarEmpleados);
			$("#btnPromedio").click(function()
			{
					limpiarModal();
			});
			$("#btnFiltrar").click(filtrarPorHorario);
			$("#btnNomYAp").click();
			$("#btnCancelar2").click(cerrar);

			if(localStorage.getItem("lista")) 
		    {
		    	let listaString:any = localStorage.getItem("lista"); 

		    	lista = JSON.parse(listaString);
		    }
		});

	var lista:Array<Empleado> = new Array<Empleado>();

	function agregarEmpleado()
	{
		let nombre:string = String($("#nombre").val());
    	let apellido:string = String($("#apellido").val());
    	let edad:number = Number($("#edad").val());
    	let legajo:number = Number($("#legajo").val());
   	 	let horario:string = String($("#horario").val());

   	 	let empleado:Empleado = new Empleado(nombre,apellido,edad,horario,legajo);

   	 	LocalStorage(empleado);
	}


	function limpiarFormulario()
	{
		$("#nombre").val("");
    	$("#apellido").val("");
    	$("#edad").val("");
   	 	$("#horario").val("Maniana");
    	$("#legajo").val("");

    	$("#btnAgregar").text("Agregar");
    	$("#btnAgregar").unbind( "click" );
    	$("#btnAgregar").click(agregarEmpleado);

    	$("#header").html("Alta Empleado");
	}

	function mostrarEmpleados()
	{
		
	    for (var i:number = 0; i < lista.length; i++) 
	    {
	    	$("#filaNueva" + i).remove();

	    	let empleado:Empleado = lista[i];

	        let nodoTr:any = document.createElement("tr");
			let nodoTd1:any = document.createElement("td");
			let nodoTd2:any = document.createElement("td");
			let nodoTd3:any = document.createElement("td");
			let nodoTd4:any = document.createElement("td");
			let nodoTd5:any = document.createElement("td");
			let nodoTd6:any = document.createElement("td");
			let nodoNombre:any = document.createTextNode(empleado.nombre);
			let nodoApellido:any = document.createTextNode(empleado.apellido);
			let nodoEdad:any = document.createTextNode(String(empleado.edad));
			let nodoLegajo:any = document.createTextNode(String(empleado.legajo));
			let nodoHorario:any = document.createTextNode(empleado.horario);

			nodoTd1.appendChild(nodoNombre);
			nodoTd2.appendChild(nodoApellido);
			nodoTd3.appendChild(nodoEdad);
			nodoTd4.appendChild(nodoLegajo);
			nodoTd5.appendChild(nodoHorario);

			nodoTr.appendChild(nodoTd1);
			nodoTr.appendChild(nodoTd2);
			nodoTr.appendChild(nodoTd3);
			nodoTr.appendChild(nodoTd4);
			nodoTr.appendChild(nodoTd5);

			let btnModificar = document.createElement("button");
	       	btnModificar.addEventListener("click", openModificar);
	       	btnModificar.innerHTML = "Modificar";
	       	btnModificar.setAttribute("class", "btn btn-primary");
	       	nodoTd6.appendChild(btnModificar);

	       	let btnEliminar = document.createElement("button");
	       	btnEliminar.addEventListener("click", borrar);
	       	btnEliminar.innerHTML = "Borrar";
	       	btnEliminar.setAttribute("class", "btn btn-primary");
	       	nodoTd6.appendChild(btnEliminar);

	       	nodoTr.appendChild(nodoTd6);

	       	nodoTr.setAttribute("id", "filaNueva" + i);

	       	console.log(nodoTr);

	        $("#tBody").append(nodoTr);
	    }
	}



	function openModificar(event:Event) 
	{
	    let tagTd:any = event.target as HTMLElement;
	    let tagButton:any = tagTd.parentNode as HTMLElement;
	    let tag:any = tagButton.parentNode as HTMLElement;
	    let nombre:any = tag.firstElementChild as HTMLElement;
	    let apellido:any = nombre.nextElementSibling as HTMLElement;
	    let edad:any = apellido.nextElementSibling as HTMLElement;
	    let legajo:any = edad.nextElementSibling as HTMLElement;
	    let horario:any = legajo.nextElementSibling as HTMLElement;

	    ($("#nombre").val(nombre.innerHTML));
	    ($("#apellido").val(apellido.innerHTML));
	    ($("#edad").val(edad.innerHTML));
	    ($("#horario").val(horario.innerHTML));
	    ($("#legajo").val(legajo.innerHTML));

	    let id:string = tag.id;

	    let array:Array<string> = id.split("a", 3);

	    id = array[2];

	    console.log(array);

	    $("#btnAgregar").text("Modificar");
	    $("#btnAgregar").unbind( "click" );
	    $("#btnAgregar").click(function(){Modificar(id)});

	    $("#headerForm").html("Modificar empleado");
	}

	function Modificar(i:string)
	{
		let nombre:string = String($("#nombre").val());
    	let apellido:string = String($("#apellido").val());
    	let edad:number = Number($("#edad").val());
    	let legajo:number = Number($("#legajo").val());
   	 	let horario:string = String($("#horario").val());

	    let empleado:Empleado = new Empleado(nombre, apellido, edad, horario, legajo);

	    lista[Number(i)] = empleado;

	    localStorage.setItem("lista", JSON.stringify(lista));

	    mostrarEmpleados();

	    limpiarFormulario();
	}


	function borrar(event:Event)
	{
		let tagTd:any = event.target as HTMLElement;
	    let tagButton:any = tagTd.parentNode as HTMLElement;
	    let tag:any = tagButton.parentNode as HTMLElement;

	    tag.remove();

	    let id:string = tag.id;

	    let array:Array<string> = id.split("a", 3);

	    let i:number = Number(array[2]);

	    lista.splice(i, 1);

	    localStorage.setItem("lista", JSON.stringify(lista));
	}


	function promedioPorHorario()
	{
		let horario:string = String($("#horario2").val());
		let contador:number = 0;
		let numEmpleados:number = lista.length;
    	/*let promedio = lista.reduce(function(empleado)//No entiendo el problema
    	{
    		if(empleado.horario == horario)
    		{
    			contador ++;
    			return contador;
    		}

    	});*/


    	//alert("El promedio de empleados que cursan a la " + horario + " es: " + promedio/numEmpleados);//Aca iria el resultado del promedio
	}

	function filtrarPorHorario()
	{
		let horario:string = String($("#horario2").val());
    	lista = lista.filter(empleado => empleado.horario == horario);

    	//Tendria que hacer un mostrar para cada uno de los empleados pero alta paja

	}

	function limpiarModal()
	{
		$("#horario2").val("Maniana");

    	$("#btnFiltrar2").text("Promedio");
    	$("#btnFiltrar2").unbind( "click" );
    	$("#btnFiltrar2").click(promedioPorHorario);

    	$("#header2").html("Promedio por horario");
	}

	function abrirFiltrar()
	{
		$("#btnFiltrar2").text("Filtrar");
    	$("#btnFiltrar2").unbind( "click" );
    	$("#btnFiltrar2").click(filtrarPorHorario);

    	$("#header2").html("Filtrar por horario");

		$("#containerMult").show();
	}

	function cerrar()
	{
		$("#containerMult").hide();

		limpiarModal();
	}

	function LocalStorage(empleado:Empleado) 
	{
        if (localStorage.getItem("lista") === null) 
        {
            lista.push(empleado);
            localStorage.setItem('lista', JSON.stringify(lista));
        }
        else
        {
            let toParse:any = localStorage.getItem('lista');
            lista = JSON.parse(toParse);
            lista.push(empleado);
            localStorage.setItem('lista', JSON.stringify(lista));
        }
    }

}