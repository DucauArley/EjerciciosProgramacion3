namespace Personas
{
	$("#document").ready(function()
		{
			$("#btnAgregar").click(agregarEmpleado);
			$("#btnCancelar").click(limpiarFormulario);
			$("#btnMostrar").click(mostrarEmpleados);
			//$("#btnListar").click(listar);

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
    	$("#btnAgregar").click(agregarEmpleado);

    	$("#header").html("Alta Empleado");
	}

	function mostrarEmpleados()
	{
		
	    for (var i:number = 0; i < lista.length; i++) 
	    {
	    	$("#filaNueva." + i).remove();//No me borra no se porque

	    	console.log(lista[i]);
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
	       	nodoTd6.appendChild(btnModificar);

	       	let btnEliminar = document.createElement("button");
	       	btnEliminar.addEventListener("click", borrar);
	       	btnEliminar.innerHTML = "Borrar";
	       	nodoTd6.appendChild(btnEliminar);

	       	nodoTr.appendChild(nodoTd6);

	       	nodoTr.setAttribute("id", "filaNueva." + i);

	        $("#tBody").append(nodoTr);
	    }
	}



	function openModificar(event:Event) 
	{
	    let tagTd = event.target as HTMLElement;
	    let tagButton = tagTd.parentNode as HTMLElement;
	    let tag = tagButton.parentNode as HTMLElement;
	    let nombre = tag.firstElementChild as HTMLElement;
	    let apellido = nombre.nextElementSibling as HTMLElement;
	    let edad = apellido.nextElementSibling as HTMLElement;
	    let legajo = edad.nextElementSibling as HTMLElement;
	    let horario = legajo.nextElementSibling as HTMLElement;

	    ($("#nombre").val(nombre.innerHTML));
	    ($("#apellido").val(apellido.innerHTML));
	    ($("#edad").val(edad.innerHTML));
	    ($("#horario").val(horario.innerHTML));
	    ($("#legajo").val(legajo.innerHTML));

	    let id:string = tag.id;

	    let array:Array<string> = id.split(".", 2);

	    id = array[1];

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
	}


	function borrar(event:Event)
	{

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