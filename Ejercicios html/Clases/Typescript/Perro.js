var Animal;
(function (Animal) {
    var Perro = /** @class */ (function () {
        function Perro(nombre) {
            if (nombre) {
                this.nombre = nombre;
            }
        }
        Perro.prototype.hacerRuido = function () {
            return "Guau!!";
        };
        Perro.prototype.getNombre = function () {
            return this.nombre;
        };
        Perro.prototype.setNombre = function (nombre) {
            if (nombre) {
                this.nombre = nombre;
            }
        };
        return Perro;
    }());
    Animal.Perro = Perro;
})(Animal || (Animal = {}));
