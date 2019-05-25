$(document).ready(listar);

		var xml = new XMLHttpRequest();
		var tbody = document.querySelector('tbody');
		var tag;

		function listar()
		{
			$.get("http://localhost:3000/personajes",
			function(data, status)
			{
				for (var i=0;i<data.length;i++)
			   	{
			   		var nodoTr = document.createElement("tr");
			     	var nodoTd1 = document.createElement("td");
			     	var nodoTd2 = document.createElement("td");
			     	var nodoTd3 = document.createElement("td");
			     	var nodoTd4 = document.createElement("td");
			     	var nodoFoto = document.createElement("img")
			     	var nodoNombre;
			     	var nodoApellido;
			     	var file = document.createElement("INPUT");
			     	var nodoEstado = document.createElement("select");
			     	var option = document.createElement("option");
			     	var option2 = document.createElement("option");
			     	var textOption = document.createTextNode(data[i].estado);

			     	nodoTr.setAttribute("idFila", i);

			     	//nodoTr.setAttribute('href', "#");
			     	file.addEventListener("click", Base64);
			     	option.setAttribute('href', "#");
			     	option2.setAttribute('href', "#");
			     	option.addEventListener("click", EditarEstado);
			     	option2.addEventListener("click", EditarEstado);
			     	nodoEstado.addEventListener("change", EditarEstado);

			     	nodoFoto.setAttribute("src", data[i].foto);
			     	nodoFoto.setAttribute("id", "avatar[" + i + "]");
			     	nodoFoto.setAttribute("class", "avatar");
			     	nodoFoto.setAttribute("name", i + 1);
			   		nodoNombre = document.createTextNode(data[i].nombre);
			     	nodoApellido = document.createTextNode(data[i].apellido);
			     	option.setAttribute("value", data[i].estado);
			     	option.appendChild(textOption);

			     	if(option.innerHTML == "Vivo")
			     	{
			     		option2.setAttribute("value", "Muerto");
			     		option2.innerHTML = "Muerto";
			     	}
			     	else
			     	{
			     		option2.setAttribute("value", "Vivo");
			     		option2.innerHTML = "Vivo";
			     	}

			     	nodoEstado.appendChild(option);
			     	nodoEstado.appendChild(option2);

			     	file.setAttribute("type","file");
			     	file.setAttribute("id","avatarE");
			     	file.setAttribute("name","avatarE");

			     	nodoTd1.appendChild(nodoFoto);
			     	nodoTd1.appendChild(file);
			     	nodoTd2.appendChild(nodoNombre);
			     	nodoTd3.appendChild(nodoApellido);
			     	nodoTd4.appendChild(nodoEstado);

			     	nodoTr.appendChild(nodoTd1);
			     	nodoTr.appendChild(nodoTd2);
			     	nodoTr.appendChild(nodoTd3);
			     	nodoTr.appendChild(nodoTd4);

			     	$("#tbody").append(nodoTr);
	  			}
	  		});
			
		}


		function Base64(event)
		{
			tag = event.target;
			var tagTd = tag.parentNode;

			var foto = tagTd.firstElementChild;

			$("input").change(function(){
                
                if (this.files && this.files[0]) 
                {
                    var fReader = new FileReader();
                    console.log(fReader);
                    
                    fReader.addEventListener("load", function(e) 
                    {
                      console.log(e.target.result);
                      foto.src = e.target.result;
                      EditarFoto(e.target.result, foto.name);
                    }); 
                    
                    fReader.readAsDataURL( this.files[0] );
                   	
                }
            })
		}

		function EditarFoto(event, id)
		{
			$("#fondo").show();
			
			var parametros;

			console.log(id);
			parametros = {"id": id, "foto": event}

			$.post("http://localhost:3000/editarFoto", parametros,
			function(data, status)
			{
				console.log(data);
		       
		        $("#fondo").hide();
			});

		}

		function EditarEstado(event)
		{
			$("#fondo").show();
			tag = event.target;
			var tagTd = tag.parentNode;
			var tagTr = tagTd.parentNode;
			var td1 = tagTr.firstElementChild;
			var foto = td1.firstElementChild;
			var nombre = td1.nextElementSibling;
			var apellido = nombre.nextElementSibling;
			var estado = apellido.nextElementSibling;
			var estado2 = estado.firstElementChild;
			var opcion = estado2.firstElementChild;
			var opcion2 = "Vivo";
			var num = 1;

			if(estado2.selectedIndex != "Vivo")
			{
				opcion2 = "Muerto"
			    num = 2
			}

			console.log(estado2);

			$.post("http://localhost:3000/editarEstado", 
				{
					"id": foto.name, "estado": opcion2
				},
				function(data, status)
				{
					console.log(data);
                    
                    if(num == 1)
                    {
						estado2.selectedIndex = "Vivo";
					}
					else
					{
						estado2.selectedIndex = "Muerto";
					}

                    $("#fondo").hide();
				});
		}

		function Abrir(event)
		{
			event.preventDefault();
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
