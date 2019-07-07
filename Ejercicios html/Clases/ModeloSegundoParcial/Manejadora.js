var Personas;
(function (Personas) {
    $("#document").ready(function () {
        $("#btnAgregar").click(agregarEmpleado);
        $("#btnCancelar").click(limpiarFormulario);
        $("#btnMostrar").click(mostrarEmpleados);
        $("#btnPromedio").click(function () {
            limpiarModal();
            $("#containerMult").show();
        });
        $("#btnFiltrar").click(filtrarPorHorario);
        $("#btnNomYAp").click();
        $("#btnCancelar2").click(cerrar);
        if (localStorage.getItem("lista")) {
            var listaString = localStorage.getItem("lista");
            lista = JSON.parse(listaString);
        }
    });
    var lista = new Array();
    function agregarEmpleado() {
        var nombre = String($("#nombre").val());
        var apellido = String($("#apellido").val());
        var edad = Number($("#edad").val());
        var legajo = Number($("#legajo").val());
        var horario = String($("#horario").val());
        var empleado = new Personas.Empleado(nombre, apellido, edad, horario, legajo);
        LocalStorage(empleado);
    }
    function limpiarFormulario() {
        $("#nombre").val("");
        $("#apellido").val("");
        $("#edad").val("");
        $("#horario").val("Maniana");
        $("#legajo").val("");
        $("#btnAgregar").text("Agregar");
        $("#btnAgregar").unbind("click");
        $("#btnAgregar").click(agregarEmpleado);
        $("#header").html("Alta Empleado");
    }
    function mostrarEmpleados() {
        for (var i = 0; i < lista.length; i++) {
            $("#filaNueva" + i).remove();
            var empleado = lista[i];
            var nodoTr = document.createElement("tr");
            var nodoTd1 = document.createElement("td");
            var nodoTd2 = document.createElement("td");
            var nodoTd3 = document.createElement("td");
            var nodoTd4 = document.createElement("td");
            var nodoTd5 = document.createElement("td");
            var nodoTd6 = document.createElement("td");
            var nodoNombre = document.createTextNode(empleado.nombre);
            var nodoApellido = document.createTextNode(empleado.apellido);
            var nodoEdad = document.createTextNode(String(empleado.edad));
            var nodoLegajo = document.createTextNode(String(empleado.legajo));
            var nodoHorario = document.createTextNode(empleado.horario);
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
            var btnModificar = document.createElement("button");
            btnModificar.addEventListener("click", openModificar);
            btnModificar.innerHTML = "Modificar";
            btnModificar.setAttribute("class", "btn btn-primary");
            nodoTd6.appendChild(btnModificar);
            var btnEliminar = document.createElement("button");
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
    function openModificar(event) {
        var tagTd = event.target;
        var tagButton = tagTd.parentNode;
        var tag = tagButton.parentNode;
        var nombre = tag.firstElementChild;
        var apellido = nombre.nextElementSibling;
        var edad = apellido.nextElementSibling;
        var legajo = edad.nextElementSibling;
        var horario = legajo.nextElementSibling;
        ($("#nombre").val(nombre.innerHTML));
        ($("#apellido").val(apellido.innerHTML));
        ($("#edad").val(edad.innerHTML));
        ($("#horario").val(horario.innerHTML));
        ($("#legajo").val(legajo.innerHTML));
        var id = tag.id;
        var array = id.split("a", 3);
        id = array[2];
        console.log(array);
        $("#btnAgregar").text("Modificar");
        $("#btnAgregar").unbind("click");
        $("#btnAgregar").click(function () { Modificar(id); });
        $("#headerForm").html("Modificar empleado");
    }
    function Modificar(i) {
        var nombre = String($("#nombre").val());
        var apellido = String($("#apellido").val());
        var edad = Number($("#edad").val());
        var legajo = Number($("#legajo").val());
        var horario = String($("#horario").val());
        var empleado = new Personas.Empleado(nombre, apellido, edad, horario, legajo);
        lista[Number(i)] = empleado;
        localStorage.setItem("lista", JSON.stringify(lista));
        mostrarEmpleados();
        limpiarFormulario();
    }
    function borrar(event) {
        var tagTd = event.target;
        var tagButton = tagTd.parentNode;
        var tag = tagButton.parentNode;
        tag.remove();
        var id = tag.id;
        var array = id.split("a", 3);
        var i = Number(array[2]);
        lista.splice(i, 1);
        localStorage.setItem("lista", JSON.stringify(lista));
    }
    function promedioPorHorario() {
        var horario = String($("#horario2").val());
        var contador = 0;
        var numEmpleados = lista.length;
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
    function filtrarPorHorario() {
        var horario = String($("#horario2").val());
        lista = lista.filter(function (empleado) { return empleado.horario == horario; });
        //Tendria que hacer un mostrar para cada uno de los empleados pero alta paja
    }
    function limpiarModal() {
        $("#horario2").val("Maniana");
        $("#btnFiltrar2").text("Promedio");
        $("#btnFiltrar2").unbind("click");
        $("#btnFiltrar2").click(promedioPorHorario);
        $("#header2").html("Promedio por horario");
    }
    function abrirFiltrar() {
        $("#btnFiltrar2").text("Filtrar");
        $("#btnFiltrar2").unbind("click");
        $("#btnFiltrar2").click(filtrarPorHorario);
        $("#header2").html("Filtrar por horario");
        $("#containerMult").show();
    }
    function cerrar() {
        $("#containerMult").hide();
        limpiarModal();
    }
    function LocalStorage(empleado) {
        if (localStorage.getItem("lista") === null) {
            lista.push(empleado);
            localStorage.setItem('lista', JSON.stringify(lista));
        }
        else {
            var toParse = localStorage.getItem('lista');
            lista = JSON.parse(toParse);
            lista.push(empleado);
            localStorage.setItem('lista', JSON.stringify(lista));
        }
    }
})(Personas || (Personas = {}));
