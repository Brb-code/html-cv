// Comentario JS
//alert("Una alerta")

//Variables y tipos de datos
var el = 'cadenas'
let nro = 9.0
let array = ['cero', 1, 2.0, 'tres']
let sw = true

let documento = {
    nombre:'Israel',
    apellido: 'Huallpara'
}

//documento = 1

// operaciones
// +, -, %, * y %
let n1 = 1 + ""
let n2 = 4
let resultado = Number(n1) + n2

document.writeln(n1+" + "+n2+" = "+resultado)

// operaciones lógicas
// && , ||, !, ==, >, <, >=, <=

document.write("Fin")

console.log("Impresión por consola clasico")
console.info("Log de INFO", documento)
console.warn("Log de errores")

//funciones

function saludar(nombre){
    
    //alert("Hola, "+nombre+"!")
}

saludar("Israel")

//Flujos de decision o de control
if(1 == "1") {
    console.log("1 en numero es igual a '1' en caracter")
} else console.log("Los datos son distintos")

switch(1){
    case 0:
        console.log("nada")
        break;
    case 1:
        console.log("Ok")
        break;
    default:
        console.log("Error")
}

//Ciclos
let i =0;
while(i<array.length){
    i++;
}
for (let i = 0; i < array.length; i++) {
    const element = array[i];    
}
let k = 1
array.forEach(element => {
    k = k + 1
});
//document.write(">>>"+k+"<<<<")

setInterval(() => {
    console.log(new Date())
}, 3000);

setTimeout(() => {
    console.log("Por Tiempo", new Date())
}, 3000);


//Tarea 1
// Dado x generar la serie de fibonacci hasta x
let x = 0
document.write()


//Tarea 2
// dado x generar la su tabla de multiplicación
console.log()




