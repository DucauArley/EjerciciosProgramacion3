$(document).ready(listar);

		var xml = new XMLHttpRequest();
		var tbody = document.querySelector('tbody');
		var tag;

		function listar()
		{
			$.get("http://localhost:3000/materias",
			function(data, status)
			{
				for (var i=0;i<data.length;i++)
			   	{
			   		var fila=$("<tr>"); 
       				$(fila).attr('id','tr');
        			var obj = data[i];
					var columnas = Object.keys(obj);

					for (var j = 0; j < columnas.length; j++) 
					{
			            var cel= $('<td>');
			            $(fila).append(cel);
			            $(cel).text(obj[columnas[j]]);    
			        }
			        $(fila).dblclick(Abrir);
			        $('#tbody').append(fila); 
	  			}
	  		});
			
		}


		function Modificar()
		{
			$("#fondo").show();
			var id = tag.firstElementChild.innerHTML;
			var nombre = $("#nombre").val();
			var fecha = $("#fecha").val();
			var parametros;
			var fechaString = fecha.split("-");
			var fechaCambio = new Date(parseInt(fechaString[0]), parseInt(fechaString[1]) - 1, parseInt(fechaString[2]));

			if($("#turno").prop("checked"))
			{
				parametros = {"id": id, "nombre": nombre, "cuatrimestre": $("#cuatrimestre").val(), "fechaFinal": fecha, "turno": "Mañana"};
			}
			else
			{
				parametros = {"id": id, "nombre": nombre, "cuatrimestre": $("#cuatrimestre").val(), "fechaFinal": fecha, "turno": "Noche"};
			}

			if(nombre.length >= 6)
			{
				if(fechaCambio.getTime() >= Date.now())
				{
					$("#nombre").removeClass("error");
					$("#nombre").addClass("sinError");
					$("#fecha").removeClass("error");
					$("#fecha").addClass("sinError");

					$.post("http://localhost:3000/editar", parametros,
						function(data, status)
						{
		                    if(data.type == "ok")
		                    {
		                    	var idMod = tag.firstElementChild;
		                    	var nombreMod = idMod.nextElementSibling;
		                    	console.log(id);
		                    	var cuatrimestre = nombreMod.nextElementSibling;
								var fechaMod = cuatrimestre.nextElementSibling;
								var turno = fechaMod.nextElementSibling;
								var textTurno = document.getElementById("turno");
								var textTurno2 = document.getElementById("turno2");

								nombreMod.innerHTML = nombre;
								cuatrimestre.innerHTML = $("#cuatrimestre").val();
								fechaMod.innerHTML = fecha

								if($("#turno").prop("checked"))
								{
									turno.innerHTML = $("#turno").val();
								}
								else
								{
									turno.innerHTML = $("#turno2").val();
								}

		                    }
		                    else
		                    {
		                    	alert("Ocurrio un Error");
		                    }
						});
	  			}
	  			else
	  			{
	  				$("#fondo").hide();
	  				$("#fecha").removeClass("sinError");
					$("#fecha").addClass("error");
	  			}
	  		}
	  		else
	  		{
	  			$("#fondo").hide();
	  			$("#nombre").removeClass("sinError");
				$("#nombre").addClass("error");
	  		}

	  		$("#fondo").hide();
		}

		function Borrar()
		{
			$("#fondo").show();

			var id = tag.firstElementChild.innerHTML;
			var parametros = {id: id};

			parametros = JSON.stringify(parametros);

			$.post("http://localhost:3000/eliminar", 
				{
					id: id
				},
				function(data, status)
				{
                    if(data.type == "ok")
                    {
                    	tag.parentNode.removeChild(tag);
                    }
                    else
                    {
                   		alert("Ocurrio un Error");
                    }
				});

			$("#fondo").hide();
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
			var fechaNueva = fecha.innerHTML;
			$("#contAgregar").show();

			$("#nombre").removeClass("error");
			$("#nombre").addClass("sinError");
			$("#fecha").removeClass("error");
			$("#fecha").addClass("sinError");

			if(fechaNueva[2] == "/")
			{
				var fechaString = fecha.innerHTML.split("/");
				fechaNueva = fechaString[2] + "-" + fechaString[1] + "-" + fechaString[0];
			}

			$("#nombre").val(nombre.innerHTML);
			$("#cuatrimestre").val(cuatrimestre.innerHTML);
			$("#fecha").val(fechaNueva);


			if(turno.innerHTML == "Noche")
			{
				$("#turno2").prop("checked", true);
			}
			else
			{
				$("#turno").prop("checked", true);
			}

			$("#Modificar").click(Modificar);
			$("#Borrar").click(Borrar);
		}

		function Cerrar()
		{
			$("#contAgregar").hide();
		}
