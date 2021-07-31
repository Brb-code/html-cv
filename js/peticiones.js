const apiPrincipal = "https://micv-b2537-default-rtdb.firebaseio.com/"
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

