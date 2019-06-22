var __extends = (this && this.__extends) || (function () {
    var extendStatics = Object.setPrototypeOf ||
        ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
        function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
var Personas;
(function (Personas) {
    var Empleado = /** @class */ (function (_super) {
        __extends(Empleado, _super);
        function Empleado(nombre, apellido, edad, horario, legajo) {
            var _this = _super.call(this, nombre, apellido, edad) || this;
            _this.horario = horario;
            _this.legajo = legajo;
            return _this;
        }
        Empleado.prototype.personaToJson = function () {
            var json = {
                "nombre": this.nombre,
                "apellido": this.apellido,
                "edad": this.edad,
                "horario": this.horario,
                "legajo": this.legajo
            };
            return JSON.stringify(json);
        };
        return Empleado;
    }(Personas.Persona));
    Personas.Empleado = Empleado;
})(Personas || (Personas = {}));
