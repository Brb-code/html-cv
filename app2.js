const meta = 1000

function generaNumero() {
    let numeroConDecimales = Math.random() * 200
    console.log(Math.round(numeroConDecimales))
}
let intervalo = setInterval(() => {
    avanzarVehiculo("car1")
    avanzarVehiculo("car2")
    avanzarVehiculo("car3")
}, 2000);

function avanzarVehiculo(carro) {

    let numeroConDecimales = Math.random() * 100
    let cantidad = Math.round(numeroConDecimales)
    let marginleft = document.getElementById(carro).style.marginLeft.substr(0, document.getElementById(carro).style.marginLeft.length - 2)
    let aincrementar = Number(marginleft) + cantidad
    document.getElementById(carro).style.marginLeft = aincrementar + "px"
    console.log(carro, aincrementar, meta)
    if(aincrementar>meta){
        clearInterval(intervalo)
        alert("Ganó el "+carro)
    }
}

// Identificando el vehículo
// Para administrar el documento = document 
// Para administrar la ventana = window

//document.getElementById("vehiculo").style.border = "2px black solid"
//document.getElementById("vehiculo").style.opacity = ".7"