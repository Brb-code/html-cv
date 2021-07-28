document.getElementById("login").classList.remove("oculto")
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
        let sw = true
        for (let i = 0; i < lista.length; i++) {
            if(lista[i].usuario == usuario){
                sw = false
                if(lista[i].contraseña == clave){
                    document.getElementById("login").classList.add("oculto")
                    document.getElementById("tareas").classList.remove("oculto")                    
                    document.getElementById("nombreUsuario").innerHTML = usuario
                } else {
                    alert("Contraseña equivocada.")
                }
            }            
        }
        if(sw){
            lista.push(user)
            localStorage.setItem("usuarios", JSON.stringify(lista))    
            document.getElementById("login").classList.add("oculto")
            document.getElementById("tareas").classList.remove("oculto")        
            document.getElementById("nombreUsuario").innerHTML = usuario            
        }
        // Reto: Caso Usuario autenticado: redireccionen al archivo tareas.html
        // Contraseña equivocada: no hacer nada
        // usuario no existe: agregarlo en el registro de localstorage "usuarios" y posteriormente
        // redireccionarlo a tareas.html
    } else {        
        localStorage.setItem("usuarios", JSON.stringify([user]))
        document.getElementById("login").classList.add("oculto")
        document.getElementById("tareas").classList.remove("oculto")    
        document.getElementById("nombreUsuario").innerHTML = usuario                
    }
}