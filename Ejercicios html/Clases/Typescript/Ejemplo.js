var Animal;
(function (Animal) {
    $("#document").ready(function () {
        $("#btnAgregar").click(agregar);
        $("#btnModificar").click(modificar);
        $("#btnEliminar").click(eliminar);
        $("#btnListar").click(listar);
    });
    var lista = new Array();
    function saludar(mi) {
        console.log(mi.hacerRuido());
    }
    function agregar() {
        var nombre = String($("#nombre").val()); //Lo mismo con los demas, ej Number()	
        var animal = $("#animal").val() + ""; //Es lo mismo que el de arriba pero mas hardcodeado
        if (animal == "Perro") {
            lista.push(new Animal.Perro(nombre));
        }
        else {
            lista.push(new Animal.Gato(nombre));
        }
    }
    function modificar() {
        var nombre = String($("#nombre").val());
        lista.forEach(function (value) {
            if (value.nombre == nombre) {
                value.nombre = "Roberto";
            }
        });
    }
    function eliminar() {
        var nombre = String($("#nombre").val());
        var i = 0;
        lista.forEach(function (value) {
            if (value.nombre == nombre) {
                lista.splice(i, 1);
            }
            i++;
        });
    }
    function listar() {
        lista.forEach(function (value) {
            console.log(value);
        });
    }
    //Se pueden llamar las cosas con el namespace: Animal.funcion por ejemplo
    /*Hacer formulario para dar de alta un perro o un gato
    funcion agregar, modificar, eliminar, listar todos sin parametros
    se puede guardar la lista en el local storage para asi seguir trabajando con ella

    */
})(Animal || (Animal = {}));
