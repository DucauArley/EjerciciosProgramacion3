var Animal;
(function (Animal) {
    var Gato = /** @class */ (function () {
        function Gato(nombre) {
            if (nombre) {
                this.nombre = nombre;
            }
        }
        Gato.prototype.hacerRuido = function () {
            return "Miau!!";
        };
        Gato.prototype.getNombre = function () {
            return this.nombre;
        };
        Gato.prototype.setNombre = function (nombre) {
            if (nombre) {
                this.nombre = nombre;
            }
        };
        return Gato;
    }());
    Animal.Gato = Gato;
})(Animal || (Animal = {}));
