// Tipos
var batman:string = "Bruce";
var superman:string = "Clark";

var existe:bool = false;

// Tuplas
var parejaHeroes = [batman,superman];
var villano = ["Lex Lutor",5,true];

// Arreglos
var aliados = ["Mujer Maravilla","Acuaman","San", "Flash"];

//Enumeraciones
var fuerzaFlash:number = 5;
var fuerzaSuperman:number = 100;
var fuerzaBatman:number = 1;
var fuerzaAcuaman:number = 0;

// Retorno de funciones
function activar_batiseñal(){
  return "activada";
}

function pedir_ayuda(){
  console.log("Auxilio!!!");
}

// Aserciones de Tipo
var poder = "100";
var largoDelPoder = poder.length;
console.log( largoDelPoder );
