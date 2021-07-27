function generaNumero(){
    let numeroConDecimales = Math.random() * 10
    console.log(Math.round(numeroConDecimales))    
}
setInterval(() => {
    avanzarVehiculo()
}, 2000);

function avanzarVehiculo(){
    let numeroConDecimales = Math.random() * 10
    let cantidad = Math.round(numeroConDecimales)
    let marginleft = document.getElementById("vehiculo").style.marginLeft.substr(0, document.getElementById("vehiculo").style.marginLeft.length - 2)
    let aincrementar = Number(marginleft) + cantidad
    document.getElementById("vehiculo").style.marginLeft = aincrementar+"px"
    
}

// Identificando el vehículo
// Para administrar el documento = document 
// Para administrar la ventana = window

//document.getElementById("vehiculo").style.border = "2px black solid"
//document.getElementById("vehiculo").style.opacity = ".7"