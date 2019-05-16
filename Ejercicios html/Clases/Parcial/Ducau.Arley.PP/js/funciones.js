window.addEventListener('load',listar);

		var xml = new XMLHttpRequest();
		var tbody = document.querySelector('tbody');
		var tag;

		function callbackGet() 
		{
			if(xml.readyState === 4)
			{
				if (xml.status === 200) 
				{
	    		 	var res = xml.responseText;
	     		 	var materias = JSON.parse(res);

	     		 	var miTabla = document.getElementById('tbody');

					for (var i=0;i<materias.length;i++)
			   		{
			   			var nodoTr = document.createElement("tr");
			     		var nodoTd1 = document.createElement("td");
			     		var nodoTd2 = document.createElement("td");
			     		var nodoTd3 = document.createElement("td");
			     		var nodoTd4 = document.createElement("td");
			     		var nodoTd5 = document.createElement("td");
			     		var nodoId
			     		var nodoNombre;
			     		var nodoCuatrimestre;
			     		var nodoTurno;
			     		var nodoFecha;

			     		nodoTr.setAttribute('href', "#");
			     		nodoTr.addEventListener("click", Abrir);

			     		nodoId = document.createTextNode(materias[i].id);
			   			nodoNombre = document.createTextNode(materias[i].nombre);
			     		nodoCuatrimestre = document.createTextNode(materias[i].cuatrimestre);
			     		nodoFecha = document.createTextNode(materias[i].fechaFinal);
			     		nodoTurno = document.createTextNode(materias[i].turno);

			     		nodoTd1.appendChild(nodoId);
			     		nodoTd2.appendChild(nodoNombre);
			     		nodoTd3.appendChild(nodoCuatrimestre);
			     		nodoTd4.appendChild(nodoFecha);
			     		nodoTd5.appendChild(nodoTurno);

			     		nodoTr.appendChild(nodoTd1);
			     		nodoTr.appendChild(nodoTd2);
			     		nodoTr.appendChild(nodoTd3);
			     		nodoTr.appendChild(nodoTd4);
			     		nodoTr.appendChild(nodoTd5);

			     		miTabla.appendChild(nodoTr);

	  				}
	  			}
	  			else
	  			{
	  				alert("Error del servidor ", xml.status);
	  			}
  			}
		}

		function callbackPostMod()
		{
			if(xml.readyState === 4)
			{
				if (xml.status === 200) 
				{
	    		 	var respuesta = xml.responseText;
                    respuesta = JSON.parse(respuesta);
                    console.log(respuesta.type);

                    if(respuesta.type == "ok")
                    {
                    	console.log("entro");
                    	var id = tag.firstElementChild;
                    	var nombre = id.nextElementSibling;
                    	var cuatrimestre = nombre.nextElementSibling;
						var fecha = cuatrimestre.nextElementSibling;
						var turno = fecha.nextElementSibling;
						var textNombre = document.getElementById("nombre");
						var textCuatrimestre = document.getElementById("cuatrimestre");
						var textFecha = document.getElementById("fecha");
						var textTurno = document.getElementById("turno");
						var textTurno2 = document.getElementById("turno2");

						nombre.innerHTML = textNombre.value;
						cuatrimestre.innerHTML = textCuatrimestre.value;
						fecha.innerHTML = textFecha.value;

						if(textTurno.checked == true)
						{
							turno.innerHTML = textTurno.value;
						}
						else
						{
							turno.innerHTML = textTurno2.value;
						}

                    }
                    else
                    {
                    	alert("Ocurrio un Error");
                    }
	  			}
	  			else
	  			{
	  				alert("Error del servidor ", xml.status);
	  			}
  			}
		}

		function callbackPostBor()
		{
			if(xml.readyState === 4)
			{
				if (xml.status === 200) 
				{
	    		 	var respuesta = xml.responseText;
                    respuesta = JSON.parse(respuesta);
                    console.log(respuesta.type);

                   // if(respuesta.type == "ok")
                    //{
                    	tag.parentNode.removeChild(tag);
                   // }
                    //else
                   // {
                   // 	alert("Ocurrio un Error");
                    //}
	  			}
	  			else
	  			{
	  				alert("Error del servidor ", xml.status);
	  			}
  			}
		}

		function listar()
		{
			xml.open("GET", "http://localhost:3000/materias", true);
			xml.onreadystatechange = callbackGet;
	  		xml.send();
		}


		function Modificar()
		{
			var nombre = document.getElementById("nombre").value;
			var fecha = document.getElementById("fecha").value;
			var turno = document.getElementById("turno");
			var parametros;

			if(turno.checked == true)
			{
				parametros = {"nombre": nombre, "fecha": fecha, "turno": "mañana"};
			}
			else
			{
				parametros = {"nombre": nombre, "fecha": fecha, "turno": "noche"};
			}

			//if(nombre.value.length > 6 && fecha.value >)
			//{
				//parametros = JSON.stringify(parametros);
				xml.open("POST", "http://localhost:3000/editar", true);
				xml.setRequestHeader("Content-type", "application/json");
				xml.onreadystatechange = callbackPostMod
	  			xml.send(parametros);
	  		//}
	  		//else
	  		//{
	  		//	console.log("Error");
	  		//}
		}

		function Borrar()
		{
			var id = tag.firstElementChild.innerHTML;
			console.log(id);
			var parametros = {id: id.innerText};
			//var fondo = document.getElementById("fondo");
    		//fondo.hidden = false;

			parametros = JSON.stringify(parametros);
			xml.open("POST", "http://localhost:3000/eliminar", true);
			xml.onreadystatechange = callbackPostBor;
	  		xml.send(parametros);

		}

		function Abrir(event)
		{
			event.preventDefault();
			var tagTd = event.target
			tag = tagTd.parentNode;
			var id = tag.firstElementChild;
			var nombre = id.nextElementSibling;
			var cuatrimestre = nombre.nextElementSibling;
			var fecha = cuatrimestre.nextElementSibling;
			var turno = fecha.nextElementSibling;
			var contAgregar = document.getElementById("contAgregar");
			var btnMod = document.getElementById("Modificar");
			var btnBor = document.getElementById("Borrar");
			contAgregar.hidden = false;
			var textNombre = document.getElementById("nombre");
			var textCuatrimestre = document.getElementById("cuatrimestre");
			var turnoM = document.getElementById("turno");
			var turnoN = document.getElementById("turno2");
			var textFecha = document.getElementById("fecha");

			textNombre.value = nombre.innerHTML;
			textCuatrimestre.value = cuatrimestre.innerHTML;
			textFecha.value = fecha.innerHTML;

			console.log(fecha.innerHTML);

			if(turno.innerHTML == "Noche")
			{
				turnoN.checked = true;
			}
			else
			{
				turnoM.checked = true;
			}

			btnMod.addEventListener("click", Modificar);
			btnBor.addEventListener("click", Borrar);
		}

		function Cerrar()
		{
			var contAgregar = document.getElementById("contAgregar");
			var btn = document.getElementById("btnCerrar");
			btn.hidden = false;
			contAgregar.hidden = true;
		}


