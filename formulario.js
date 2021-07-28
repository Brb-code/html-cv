function iniciarSesion(event){
    event.preventDefault()
    let usuario = document.getElementById("usuario").value
    let clave = document.getElementById("clave").value
    let user = {
        usuario: usuario,
        contraseña:clave
    }
    //Validando usuario y contraseña
    let usuariosTmp = localStorage.getItem("usuarios")
    if(usuariosTmp){
        let lista = JSON.parse(usuariosTmp)
        for (let i = 0; i < lista.length; i++) {
            if(lista[i].usuario == usuario){
                if(lista[i].contraseña == clave){
                    alert("Usuario Autenticado")
                } else {
                    alert("Contraseña equivocada.")
                }
            }            
        }
        // Reto: Caso Usuario autenticado: redireccionen al archivo tareas.html
        // Contraseña equivocada: no hacer nada
        // usuario no existe: agregarlo en el registro de localstorage "usuarios" y posteriormente
        // redireccionarlo a tareas.html
    } else {        
        localStorage.setItem("usuarios", JSON.stringify([user]))
    }
}