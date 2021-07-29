function crearSesion(datos){
    //guarda en localstorage los datos del usuario como token de sesion
    localStorage.setItem('token', JSON.stringify(datos))
}