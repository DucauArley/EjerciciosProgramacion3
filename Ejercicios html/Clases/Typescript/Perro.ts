namespace Animal //Asi se hace un namespace
{
	export class Perro implements Animal
	{
		private nombre:string;

		constructor(nombre?:string)
		{
			if(nombre)
			{
				this.nombre = nombre;
			}
		}

		hacerRuido():string
		{
			return "Guau!!";
		}

		getNombre():string
		{
			return this.nombre;
		}

		setNombre(nombre:string)
		{
			if(nombre)
			{
				this.nombre = nombre;
			}
		}

	}
}