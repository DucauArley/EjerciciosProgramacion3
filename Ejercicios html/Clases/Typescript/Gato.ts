namespace Animal
{
	export class Gato implements Animal
	{
		private nombre:string;

		constructor(nombre:string)
		{
			if(nombre)
			{
				this.nombre = nombre;
			}
		}

		hacerRuido():string
		{
			return "Miau!!";
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

