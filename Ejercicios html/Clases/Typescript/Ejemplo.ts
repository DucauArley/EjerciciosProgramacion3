namespace Animal //Asi se hace un namespace
{
	let lista:Array<Animal> = new Array<Animal>();
	lista.push(new Perro("Pepe"));
	lista.push(new Gato("Jorge"));

	lista.forEach(saludar)

	function saludar(mi:Animal)
	{
		console.log(mi.hacerRuido());
	}
}