namespace Personas
{
	export class Empleado extends Persona
	{
		public horario:string;
		public legajo:number;

		constructor(nombre:string, apellido:string, edad:number, horario:string, legajo:number)
		{
			super(nombre, apellido, edad);
			this.horario = horario;
			this.legajo = legajo;
		}

		personaToJson():string
		{
			var json =
			{
				"nombre": this.nombre, 
				"apellido": this.apellido,
				"edad": this.edad,
				"horario": this.horario,
				"legajo": this.legajo
			};

			return JSON.stringify(json);
		}
	}
}