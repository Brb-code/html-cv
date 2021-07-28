let token = sessionStorage.getItem("token")
let usuario
if (token) {
    usuario = token
    document.getElementById("nombreUsuario").innerHTML = usuario
    document.getElementById("tareas").classList.remove("oculto")

} else {
    document.getElementById("login").classList.remove("oculto")
}

function iniciarSesion(event) {
    event.preventDefault()
    usuario = document.getElementById("usuario").value
    let clave = document.getElementById("clave").value
    let user = {
            usuario: usuario,
            contraseña: clave
        }
        //Validando usuario y contraseña
    let usuariosTmp = localStorage.getItem("usuarios")
    if (usuariosTmp) {
        let lista = JSON.parse(usuariosTmp)
        let sw = true
        for (let i = 0; i < lista.length; i++) {
            if (lista[i].usuario == usuario) {
                sw = false
                if (lista[i].contraseña == clave) {
                    document.getElementById("login").classList.add("oculto")
                    document.getElementById("tareas").classList.remove("oculto")
                    document.getElementById("nombreUsuario").innerHTML = usuario
                    sessionStorage.setItem("token", usuario)
                } else {
                    alert("Contraseña equivocada.")
                }
            }
        }
        if (sw) {
            lista.push(user)
            localStorage.setItem("usuarios", JSON.stringify(lista))
            document.getElementById("login").classList.add("oculto")
            document.getElementById("tareas").classList.remove("oculto")
            document.getElementById("nombreUsuario").innerHTML = usuario
            sessionStorage.setItem("token", usuario)
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
        sessionStorage.setItem("token", usuario)
    }
}

function salir() {
    sessionStorage.removeItem("token")
    document.getElementById("login").classList.remove("oculto")
<<<<<<< HEAD
    document.getElementById("tareas").classList.add("oculto")
}

function guardar() {
    event.preventDefault();
    let tarea = document.getElementById("itarea").value

    document.getElementById("listaTareas").innerHTML = document.getElementById("listaTareas").innerHTML + "<li>" + tarea + "</li>"
    document.getElementById("itarea").value = ''
}
=======
        document.getElementById("tareas").classList.add("oculto")    
}
function guardar(event){
    //detener la acción actual
    event.preventDefault();
    let tarea = document.getElementById("itarea").value
    document.getElementById("listaTareas").innerHTML = document.getElementById("listaTareas").innerHTML + "<li>"+tarea+"</li>"
    document.getElementById("itarea").value = ""
}
//Reto: cuando se haga un click sobre la tarea, quitarla de la lista
>>>>>>> 76f8524a41b82e4b63ee3d677bcd6757e288340a
