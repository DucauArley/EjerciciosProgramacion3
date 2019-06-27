namespace Personas
{
	$("#document").ready(function()
		{
			$("#btnAgregar").click(agregarEmpleado);
			$("#btnCancelar").click(limpiarFormulario);
			$("#btnMostrar").click(mostrarEmpleados);
			$("#btnListar").click(listar);
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
   	 	$("#horario").val("Mañana");
    	$("#legajo").val("");

    	$("#btnAgregar").text("Agregar");
    	$("#btnAgregar").click(agregarEmpleado);

    	$("#header").html("Alta empleado");
	}

	function mostrarEmpleados()
	{
		console.log(lista);
	    $("#tBody").empty();

	    for (var i = 0; i < lista.length; i++) 
	    {
	    	let empleado:Empleado = JSON.parse(lista[i].toString());

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
			nodoTr.appendChild(nodoTd6);

			let btnModificar = document.createElement("button");
	       	btnModificar.addEventListener("click", openModificar);
	       	btnModificar.innerHTML = "Modificar";
	       	nodoTr.appendChild(btnModificar);

	       	let btnEliminar = document.createElement("button");
	       	btnEliminar.addEventListener("click", wrapEliminar);
	       	btnEliminar.innerHTML = "Borrar";
	       	nodoTr.appendChild(btnEliminar);

	        $("#tBody").append(nodoTr);
	    }
	}



	function openModificar(event:Event) 
	{
	    let trigger = event.target as HTMLElement;
	    let horario = trigger.previousSibling;
	    let legajo = horario.previousSibling;
	    let edad = legajo.previousSibling;
	    let apellido = edad.previousSibling;
	    let nombre = apellido.previousSibling;

	    ($("#nombre").val(nombre.innerHTML));
	    ($("#apellido").val(apellido.innerHTML));
	    ($("#edad").val(edad.innerHTML));
	    ($("#horario").val(horario.innerHTML));
	    ($("#legajo").val(legajo.innerHTML));

	    $("#btnAgregar").text("Modificar");
	    $("#btnAgregar").unbind( "click" );
	    $("#btnAgregar").click(wrapModificar);

	    $("#headerForm").html("Modificar empleado");
	}//Tengo que arreglarlo y agregar los modificar y demas casos






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
            localStorage.setItem('storage', JSON.stringify(lista));
        }
    }

}