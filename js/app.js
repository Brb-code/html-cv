function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
    // Información del usuario loggeado desde google
    let tmpUsuario = {
        id: profile.getId(),
        nombre: profile.getName(),
        foto: profile.getImageUrl(),
        correo: profile.getEmail()
    }
    crearSesion(tmpUsuario)
        //Obteniendo usuario
    let datos = {
        "aplicacion": 'GOOGLE',
        "correo": tmpUsuario.correo,
        "nombres": tmpUsuario.nombre
    }
    insertar(apiPrincipal + "usuario.php", datos)
        .then(respuesta => {
            /*    insertar(apiPrincipal + "usuario.php", datos)
                .then(datos => { datos.json() })
                .then(respuesta => {
                    console.log(respuesta)*/
            console.log("RESP", respuesta)
            crearSesion(respuesta)
                //verificamos que el id se haya grabado en el local storage
            var id_sesion = JSON.parse(localStorage.getItem("token"))
            console.log(id_sesion.tk)
                //direccionamos a la pantalla panel
            location.href = "panel.html";
        }).catch(error => {
            console.warn(error)
        })
}

function veterinarios() {
    document.getElementById("mensaje").style.display = "none"
    document.getElementById("lista").style.display = "none"
    leer(apiPrincipal + "veterinario.php")
        //.then(datos => datos.json())
        .then(respuesta => {

            console.log(Object.entries(respuesta))
            if (respuesta == null) {
                document.getElementById("mensaje").style.display = "block"
            } else {
                document.getElementById("lista").innerHTML = ""
                Object.entries(respuesta).forEach(element => {
                    console.log(element, "OK", document.getElementById("lista"))
                    var elemento = '<li class="mdc-list-item" tabindex="0">' +
                        '<span class="mdc-list-item__ripple"></span>' +
                        '<span class="mdc-list-item__text">' +
                        '<span class="mdc-list-item__primary-text">' + element[1].nombre + ' ' + element[1].apellido + '</span>' +
                        '<span class="mdc-list-item__secondary-text">Especialidad:' + element[1].especialidad + '</span>' +
                        '</span>' +
                        '</li>' +
                        '<br>'
                    document.getElementById("lista").innerHTML = document.getElementById("lista").innerHTML + elemento
                });
                document.getElementById("lista").style.display = "block"
            }
            //recorriendo los usuarios obtenidos



        }).catch(error => {
            console.warn(error)
        })
}

function guardarveterinario(event) {
    event.preventDefault()
    var nombre = document.getElementById("Nombre").value
    var apellido = document.getElementById("Apellido").value
    var especialidad = document.getElementById("Especialidad").value
    var direccion = document.getElementById("Direccion").value
    var telefono = document.getElementById("Telefono").value
    var id_sesion = JSON.parse(localStorage.getItem("token"))
    console.log(id_sesion.tk)

    var datos = {
        nombre: nombre,
        apellido: apellido,
        especialidad: especialidad,
        direccion: direccion,
        telefono: telefono,
        id_usuario: id_sesion.tk
    }
    insertar(apiPrincipal + "veterinario.php", datos)
        .then(respuesta => {
            console.log("RESP", respuesta)
            location.href = "veterinario.html";
        }).catch(error => {
            console.warn(error)
        })
}

function salir() {
    cerrarSesion()
    insertar('https://admin.googleapis.com/admin/directory/v1/users/500286237657-lje9bh6d0hum672p49o9hu243ifbvevn.apps.googleusercontent.com/signOut', {})
    location.href = "index.html"
}

function mascotas() {
    //document.getElementById("tabladatos").style.display = "none"
    var id_sesion = JSON.parse(localStorage.getItem("token"))
    console.log(id_sesion.tk)

    var datos = {
        id_usuario: id_sesion.tk,
        id: 0
    }
    leer(apiPrincipal + "mascota.php", datos)
        .then(respuesta => {
            console.log("RESP", respuesta)
            document.getElementById("tabladatos").innerHTML = ""
            if (respuesta == null) {
                document.getElementById("mensaje").style.display = "block"
            } else {
                document.getElementById("lista").innerHTML = ""
                Object.entries(respuesta).forEach(element => {
                    console.log(element, "OK", document.getElementById("lista"))
                    var elemento = '<li class="mdc-list-item" tabindex="0">' +
                        '<span class="mdc-list-item__ripple"></span>' +
                        '<span class="mdc-list-item__text">' +
                        '<span class="mdc-list-item__primary-text">' + element[1].nombre + ' ' + element[1].apellido + '</span>' +
                        '<span class="mdc-list-item__secondary-text">Especialidad:' + element[1].especialidad + '</span>' +
                        '</span>' +
                        '</li>' +
                        '<br>'
                    document.getElementById("lista").innerHTML = document.getElementById("lista").innerHTML + elemento
                });
                document.getElementById("lista").style.display = "block"
            }

        }).catch(error => {
            console.warn(error)
        })

    /*

        leer(apiPrincipal + "mascota.php")
            //.then(datos => datos.json())
            .then(respuesta => {

                console.log(Object.entries(respuesta))
                if (respuesta == null) {
                    document.getElementById("mensaje").style.display = "block"
                } else {
                    document.getElementById("lista").innerHTML = ""
                    Object.entries(respuesta).forEach(element => {
                        console.log(element, "OK", document.getElementById("lista"))
                        var elemento = '<li class="mdc-list-item" tabindex="0">' +
                            '<span class="mdc-list-item__ripple"></span>' +
                            '<span class="mdc-list-item__text">' +
                            '<span class="mdc-list-item__primary-text">' + element[1].nombre + ' ' + element[1].apellido + '</span>' +
                            '<span class="mdc-list-item__secondary-text">Especialidad:' + element[1].especialidad + '</span>' +
                            '</span>' +
                            '</li>' +
                            '<br>'
                        document.getElementById("lista").innerHTML = document.getElementById("lista").innerHTML + elemento
                    });
                    document.getElementById("lista").style.display = "block"
                }
                //recorriendo los usuarios obtenidos



            }).catch(error => {
                console.warn(error)
            })
    */
}

function guardarMascota(event) {
    event.preventDefault()
    var nombre = document.getElementById("nombre").value
    var especie = document.getElementById("especie").value
    var raza = document.getElementById("raza").value
    var color = document.getElementById("color").value
    var fechaAdopcion = document.getElementById("fechaAdopcion").value
    var fechaNacimiento = document.getElementById("fechaNacimiento").value
    var fechaDeceso = document.getElementById("fechaDeceso").value
    var id_sesion = JSON.parse(localStorage.getItem("token"))
    console.log(id_sesion.tk)

    var datos = {
        id_usuario: id_sesion.tk,
        nombre: nombre,
        especie: especie,
        raza: raza,
        color: color,
        fechaAdopcion: fechaAdopcion,
        fechaNacimiento: fechaNacimiento,
        fechaDeceso: fechaDeceso
    }
    insertar(apiPrincipal + "mascota.php", datos)
        .then(respuesta => {
            console.log("RESP", respuesta)
                //direccionamos a la pantalla panel
            location.href = "mascotas.html";
        }).catch(error => {
            console.warn(error)
        })
}