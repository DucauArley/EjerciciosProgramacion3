namespace Vehiculo
{
	declare var $:any;

	$("#document").ready(function()
		{
			$("#btnAlta").click(function()
			{
				$("#containerMult").modal("show");
			})

			$("#btnAgregar").click(agregarVehiculo);

			$("#chkId").click(mostrarVehiculos);
			$("#chkMarca").click(mostrarVehiculos);
			$("#chkModelo").click(mostrarVehiculos);
			$("#chkPrecio").click(mostrarVehiculos);
			$("#btnPromedio").click(calcularPromedio);

			if(localStorage.getItem("lista")) 
		    {
		    	let listaString:any = localStorage.getItem("lista"); 

		    	lista = JSON.parse(listaString);
		    }

		    mostrarVehiculos();
		});



	var lista:Array<Vehiculo> = new Array<Vehiculo>();

	function agregarVehiculo()
	{
		let id = buscarId();
    	let marca:string = String($("#txtMarca").val());
    	let modelo:string = String($("#txtModelo").val());
    	let precio:number = Number($("#txtPrecio").val());
   	 	let tipo:string = String($("#tipo").val());

   	 	let vehiculo:Vehiculo;

   	 	console.log(id);

   	 	if(tipo == "Auto")
   	 	{
   	 		vehiculo = new Auto(id, marca, modelo, precio, 2);
   	 	}
   	 	else
   	 	{
   	 		vehiculo = new Camioneta(id, marca, modelo, precio, true);
   	 	}


   	 	LocalStorage(vehiculo);

   	 	mostrarVehiculos();
	}

	function buscarId():number
	{
		if (lista.length === 0)
		{
			return 1;
		}

	    let ultimo:Vehiculo = lista.reduce((prev, act) => (prev.id > act.id) ? prev : act)

	    return ultimo.id + 1;
	}

	function filtrar():Array<Vehiculo>
	{
		let tipo:string = $("#selectTipo").val(); 
		let listaFilt:any;

		if(tipo == "Auto")
		{
			listaFilt = lista.filter(function(vehiculo)
			{
				console.log(vehiculo instanceof Vehiculo);//Hasta esto me tira falso
				return vehiculo instanceof Auto;//No se porque pero me tira falso supongo que tiene que ver con cuando devuelve
				//los elementos de la lista los devuelve como object pero no se que decir
			});
		}
		else//Por lo que parece el codigo esta bien pero no se porque no me devuelve los vehiculos que son auto/camioneta
		{
			listaFilt = lista.filter(function(vehiculo)
			{
				return vehiculo instanceof Camioneta;//No se porque pero me tira falso
			});
		}

		return listaFilt;
	}

	function calcularPromedio()
	{
		let numVehiculos:number = lista.length;
		let promedio:number = lista.reduce(function(total:number, vehiculo):any
    	{
    		return total += vehiculo.precio;
    	},0);

    	console.log(promedio/numVehiculos);

    	$("#Promedio").val(promedio/numVehiculos);
	}

	function mostrarVehiculos()
	{
		$("#tBody").empty();
		let listaFilt = filtrar(); 

		let nodoTrTh:any = document.createElement("tr");
		let nodoTh1:any = document.createElement("th");
		let nodoTh2:any = document.createElement("th");
		let nodoTh3:any = document.createElement("th");
		let nodoTh4:any = document.createElement("th");
		let nodoTh5:any = document.createElement("th");
		let nodoThId:any = document.createTextNode("Id");
		let nodoThMarca:any = document.createTextNode("Marca");
		let nodoThModelo:any = document.createTextNode("Id");
		let nodoThPrecio:any = document.createTextNode("Precio");
		let nodoThAccion:any = document.createTextNode("Accion");
		nodoTh1.appendChild(nodoThId);
		nodoTh2.appendChild(nodoThMarca);
		nodoTh3.appendChild(nodoThModelo);
		nodoTh4.appendChild(nodoThPrecio);
		nodoTh5.appendChild(nodoThAccion);

		if($('#chkId').prop('checked'))
		{
			nodoTrTh.appendChild(nodoTh1);
		}

		if($('#chkMarca').prop('checked'))
		{
			nodoTrTh.appendChild(nodoTh2);
		}

		if($('#chkModelo').prop('checked'))
		{
			nodoTrTh.appendChild(nodoTh3);
		}

		if($('#chkPrecio').prop('checked'))
		{
			nodoTrTh.appendChild(nodoTh4);
		}

		nodoTrTh.appendChild(nodoTh5);

		$("#tBody").append(nodoTrTh);

	    for (var i:number = 0; i < listaFilt.length; i++) 
	    {
	    	let vehiculo:Vehiculo = listaFilt[i];

	        let nodoTr:any = document.createElement("tr");
			let nodoTd1:any = document.createElement("td");
			let nodoTd2:any = document.createElement("td");
			let nodoTd3:any = document.createElement("td");
			let nodoTd4:any = document.createElement("td");
			let nodoTd5:any = document.createElement("td");
			let nodoId:any = document.createTextNode(String(vehiculo.id));
			let nodoMarca:any = document.createTextNode(vehiculo.marca);
			let nodoModelo:any = document.createTextNode(vehiculo.modelo);
			let nodoPrecio:any = document.createTextNode(String(vehiculo.precio));

			nodoTd1.appendChild(nodoId);
			nodoTd2.appendChild(nodoMarca);
			nodoTd3.appendChild(nodoModelo);
			nodoTd4.appendChild(nodoPrecio);


			if($('#chkId').prop('checked'))
			{
				nodoTr.appendChild(nodoTd1);
			}

			if ($('#chkMarca').prop('checked')) 
			{
				nodoTr.appendChild(nodoTd2);
			}

			if($('#chkModelo').prop('checked'))
			{
				nodoTr.appendChild(nodoTd3);
			}

			if($('#chkPrecio').prop('checked'))
			{
				nodoTr.appendChild(nodoTd4);
			}

	       	let btnEliminar = document.createElement("button");
	       	btnEliminar.addEventListener("click", borrar);
	       	btnEliminar.innerHTML = "Borrar";
	       	btnEliminar.setAttribute("class", "btn btn-primary");
	       	nodoTd5.appendChild(btnEliminar);

	       	nodoTr.appendChild(nodoTd5);

	        $("#tBody").append(nodoTr);
	    }
	}

	function borrar(event:Event)
	{
		let tagTd:any = event.target as HTMLElement;
	    let tagButton:any = tagTd.parentNode as HTMLElement;
	    let tag:any = tagButton.parentNode as HTMLElement;
	    let id:any = tag.firstElementChild;

	    tag.remove();
	   
	   	lista = lista.filter(function(vehiculo)
	   	{
	   		return vehiculo.id != id.innerHTML;
	   	});

	    localStorage.setItem("lista", JSON.stringify(lista));
	}


	function LocalStorage(vehiculo:Vehiculo) 
	{
        if (localStorage.getItem("lista") === null) 
        {
            lista.push(vehiculo);
            localStorage.setItem('lista', JSON.stringify(lista));
        }
        else
        {
            let toParse:any = localStorage.getItem('lista');
            lista = JSON.parse(toParse);
            lista.push(vehiculo);
            localStorage.setItem('lista', JSON.stringify(lista));
        }
    }
}