//const apiPrincipal = "https://micv-b2537-default-rtdb.firebaseio.com/"
const apiPrincipal = "https://pru3ba.faastechnology.tech/api/controllers/"
function obtener(url){
    // Obtenemos de un servicios los usuarios autenticados
    return fetch(url)
}

function insertar(url,datos){
    // Obtenemos de un servicios los usuarios autenticados
    return fetch(url,{
      method :"POST",
      body   : JSON.stringify(datos)  
    })
}

