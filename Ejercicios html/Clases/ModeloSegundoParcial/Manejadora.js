var Personas;
(function (Personas) {
    $("#document").ready(function () {
        $("#btnAgregar").click(agregarEmpleado);
        $("#btnCancelar").click(limpiarFormulario);
        $("#btnMostrar").click(mostrarEmpleados);
        //$("#btnListar").click(listar);
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
        $("#btnAgregar").click(agregarEmpleado);
        $("#header").html("Alta Empleado");
    }
    function mostrarEmpleados() {
        for (var i = 0; i < lista.length; i++) {
            $("#filaNueva." + i).remove(); //No me borra no se porque
            console.log(lista[i]);
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
            nodoTd6.appendChild(btnModificar);
            var btnEliminar = document.createElement("button");
            btnEliminar.addEventListener("click", borrar);
            btnEliminar.innerHTML = "Borrar";
            nodoTd6.appendChild(btnEliminar);
            nodoTr.appendChild(nodoTd6);
            nodoTr.setAttribute("id", "filaNueva." + i);
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
        var array = id.split(".", 2);
        id = array[1];
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
    }
    function borrar(event) {
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
