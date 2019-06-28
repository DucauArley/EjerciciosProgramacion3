var Personas;
(function (Personas) {
    $("#document").ready(function () {
        $("#btnAgregar").click(agregarEmpleado);
        $("#btnCancelar").click(limpiarFormulario);
        $("#btnMostrar").click(mostrarEmpleados);
        //$("#btnListar").click(listar);
        if (localStorage.getItem("lista")) {
            lista = localStorage.getItem("lista"); //Creo que tendria que pasarle las cosas una por una 
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
        $("#horario").val("maniana");
        $("#legajo").val("");
        $("#btnAgregar").text("Agregar");
        $("#btnAgregar").click(agregarEmpleado);
        $("#header").html("Alta Empleado");
    }
    function mostrarEmpleados() {
        console.log(lista);
        $("#tBody").empty();
        for (var i = 0; i < lista.length; i++) {
            var empleado = JSON.parse(lista[i].toString()); //El error de la linea 33 esta aca
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
            nodoTr.appendChild(nodoTd6);
            var btnModificar = document.createElement("button");
            btnModificar.addEventListener("click", openModificar);
            btnModificar.innerHTML = "Modificar";
            nodoTr.appendChild(btnModificar);
            var btnEliminar = document.createElement("button");
            btnEliminar.addEventListener("click", borrar);
            btnEliminar.innerHTML = "Borrar";
            nodoTr.appendChild(btnEliminar);
            $("#tBody").append(nodoTr);
        }
    }
    function openModificar(event) {
        /*let trigger = event.target as HTMLElement;
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

        $("#headerForm").html("Modificar empleado");*/
    } //Tengo que arreglarlo y agregar los modificar y demas casos
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
