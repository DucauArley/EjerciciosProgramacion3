var Animal;
(function (Animal) {
    var lista = new Array();
    lista.push(new Animal.Perro("Pepe"));
    lista.push(new Animal.Gato("Jorge"));
    lista.forEach(saludar);
    function saludar(mi) {
        console.log(mi.hacerRuido());
    }
})(Animal || (Animal = {}));
