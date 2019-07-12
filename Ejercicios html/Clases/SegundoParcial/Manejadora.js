var Vehiculo;
(function (Vehiculo) {
    $("#document").ready(function () {
        $("#btnAlta").click(function () {
            limpiarFormulario();
            $("#containerMult").modal("show");
        });
        $("#btnAgregar").click(agregarVehiculo);
        $("#chkId").click(mostrarVehiculos);
        $("#chkMarca").click(mostrarVehiculos);
        $("#chkModelo").click(mostrarVehiculos);
        $("#chkPrecio").click(mostrarVehiculos);
        $("#btnPromedio").click(calcularPromedio);
        $("#selectTipo").change(mostrarVehiculos);
        if (localStorage.getItem("lista")) {
            var listaString = localStorage.getItem("lista");
            lista = JSON.parse(listaString);
            console.log(lista);
        }
        mostrarVehiculos();
    });
    var lista = new Array();
    function agregarVehiculo() {
        var id = buscarId();
        var marca = String($("#txtMarca").val());
        var modelo = String($("#txtModelo").val());
        var precio = Number($("#txtPrecio").val());
        var tipo = String($("#tipo").val());
        var vehiculo;
        if (tipo == "Auto") {
            vehiculo = new Vehiculo.Auto(id, marca, modelo, precio, 2);
        }
        else {
            vehiculo = new Vehiculo.Camioneta(id, marca, modelo, precio, true);
        }
        LocalStorage(vehiculo);
        mostrarVehiculos();
    }
    function buscarId() {
        if (lista.length === 0) {
            return 1;
        }
        var ultimo = lista.reduce(function (prev, act) { return (prev.id > act.id) ? prev : act; });
        return ultimo.id + 1;
    }
    /*function filtrar():Array<Vehiculo>
    {
        let tipo:string = $("#selectTipo").val();
        let listaFilt:any;

        if(tipo == "Auto")
        {
            listaFilt = lista.filter(function(vehiculo)
            {
                return !(vehiculo instanceof Auto);
            });
        }
        else
        {
            listaFilt = lista.filter(function(vehiculo)
            {
                return !(vehiculo instanceof Camioneta);
            });
        }

        return listaFilt;
    }*/
    function calcularPromedio() {
        var numVehiculos = lista.length;
        var promedio = lista.reduce(function (total, vehiculo) {
            return total += vehiculo.precio;
        }, 0);
        $("#Promedio").val(promedio / numVehiculos);
    }
    function mostrarVehiculos() {
        $("#tBody").empty();
        //let listaFilt = filtrar(); 
        var nodoTrTh = document.createElement("tr");
        var nodoTh1 = document.createElement("th");
        var nodoTh2 = document.createElement("th");
        var nodoTh3 = document.createElement("th");
        var nodoTh4 = document.createElement("th");
        var nodoTh5 = document.createElement("th");
        var nodoThId = document.createTextNode("Id");
        var nodoThMarca = document.createTextNode("Marca");
        var nodoThModelo = document.createTextNode("Modelo");
        var nodoThPrecio = document.createTextNode("Precio");
        var nodoThAccion = document.createTextNode("Accion");
        nodoTh1.appendChild(nodoThId);
        nodoTh2.appendChild(nodoThMarca);
        nodoTh3.appendChild(nodoThModelo);
        nodoTh4.appendChild(nodoThPrecio);
        nodoTh5.appendChild(nodoThAccion);
        if ($('#chkId').prop('checked')) {
            nodoTrTh.appendChild(nodoTh1);
        }
        if ($('#chkMarca').prop('checked')) {
            nodoTrTh.appendChild(nodoTh2);
        }
        if ($('#chkModelo').prop('checked')) {
            nodoTrTh.appendChild(nodoTh3);
        }
        if ($('#chkPrecio').prop('checked')) {
            nodoTrTh.appendChild(nodoTh4);
        }
        nodoTrTh.appendChild(nodoTh5);
        $("#tBody").append(nodoTrTh);
        for (var i = 0; i < lista.length; i++) {
            $("#filaNueva" + i).remove();
            var vehiculo = lista[i];
            var nodoTr = document.createElement("tr");
            var nodoTd1 = document.createElement("td");
            var nodoTd2 = document.createElement("td");
            var nodoTd3 = document.createElement("td");
            var nodoTd4 = document.createElement("td");
            var nodoTd5 = document.createElement("td");
            var nodoId = document.createTextNode(String(vehiculo.id));
            var nodoMarca = document.createTextNode(vehiculo.marca);
            var nodoModelo = document.createTextNode(vehiculo.modelo);
            var nodoPrecio = document.createTextNode(String(vehiculo.precio));
            nodoTd1.appendChild(nodoId);
            nodoTd2.appendChild(nodoMarca);
            nodoTd3.appendChild(nodoModelo);
            nodoTd4.appendChild(nodoPrecio);
            if ($('#chkId').prop('checked')) {
                nodoTr.appendChild(nodoTd1);
            }
            if ($('#chkMarca').prop('checked')) {
                nodoTr.appendChild(nodoTd2);
            }
            if ($('#chkModelo').prop('checked')) {
                nodoTr.appendChild(nodoTd3);
            }
            if ($('#chkPrecio').prop('checked')) {
                nodoTr.appendChild(nodoTd4);
            }
            var btnModificar = document.createElement("button");
            btnModificar.addEventListener("click", openModificar);
            btnModificar.innerHTML = "Modificar";
            btnModificar.setAttribute("class", "btn btn-primary");
            nodoTd5.appendChild(btnModificar);
            var btnEliminar = document.createElement("button");
            btnEliminar.addEventListener("click", borrar);
            btnEliminar.innerHTML = "Borrar";
            btnEliminar.setAttribute("class", "btn btn-primary");
            nodoTd5.appendChild(btnEliminar);
            nodoTr.setAttribute("id", "filaNueva" + i);
            nodoTr.appendChild(nodoTd5);
            $("#tBody").append(nodoTr);
        }
    }
    function openModificar(event) {
        var tagTd = event.target;
        var tagButton = tagTd.parentNode;
        var tag = tagButton.parentNode;
        var id = tag.firstElementChild;
        var marca = id.nextElementSibling;
        var modelo = marca.nextElementSibling;
        var precio = modelo.nextElementSibling;
        $("#txtId").val(id.innerHTML);
        $("#txtMarca").val(marca.innerHTML);
        $("#txtModelo").val(modelo.innerHTML);
        $("#txtPrecio").val(precio.innerHTML);
        $("#btnAgregar").text("Modificar");
        $("#btnAgregar").unbind("click");
        $("#btnAgregar").click(function () { Modificar(Number(id.innerHTML)); });
        $("#header2").html("Modificar vehiculo");
        $("#containerMult").modal("show");
    }
    function Modificar(i) {
        var marca = String($("#txtMarca").val());
        var modelo = String($("#txtModelo").val());
        var precio = Number($("#txtPrecio").val());
        var tipo = String($("#tipo").val());
        var indice = 0;
        for (var j = 0; j < lista.length; j++) {
            if (lista[j].id == i) {
                indice = j;
                break;
            }
        }
        if (tipo == "Auto") {
            var auto = new Vehiculo.Auto(i, marca, modelo, precio, 2);
            lista[indice] = auto;
        }
        else {
            var camioneta = new Vehiculo.Camioneta(i, marca, modelo, precio, true);
            lista[indice] = camioneta;
        }
        localStorage.setItem("lista", JSON.stringify(lista));
        mostrarVehiculos();
        limpiarFormulario();
    }
    function limpiarFormulario() {
        $("#txtId").val("");
        $("#txtMarca").val("");
        $("#txtModelo").val("");
        $("#txtPrecio").val("");
        $("#btnAgregar").text("Agregar");
        $("#btnAgregar").unbind("click");
        $("#btnAgregar").click(agregarVehiculo);
        $("#header2").html("Alta Vehiculo");
    }
    function borrar(event) {
        var tagTd = event.target;
        var tagButton = tagTd.parentNode;
        var tag = tagButton.parentNode;
        var id = tag.firstElementChild;
        tag.remove();
        console.log(id);
        lista = lista.filter(function (vehiculo) {
            return vehiculo.id != id.innerHTML;
        });
        localStorage.setItem("lista", JSON.stringify(lista));
    }
    function LocalStorage(vehiculo) {
        if (localStorage.getItem("lista") === null) {
            lista.push(vehiculo);
            localStorage.setItem('lista', JSON.stringify(lista));
        }
        else {
            var toParse = localStorage.getItem('lista');
            lista = JSON.parse(toParse);
            lista.push(vehiculo);
            localStorage.setItem('lista', JSON.stringify(lista));
        }
    }
})(Vehiculo || (Vehiculo = {}));
