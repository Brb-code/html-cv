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
    let datos= {
        aplicacion:'GOOGLE',
        correo:tmpUsuario.correo,
        nombres:tmpUsuario.nombre
    }
    insertar(apiPrincipal+"usuario.php",datos)
    .then(datos => {
        datos.json()
    })
    .then(respuesta => {
        console.log("RESP", respuesta)
        crearSesion(respuesta)
        location.href="panel.html"
        /*if(respuesta == null){
            //Insertando datos de manera asincrona
            insertar(apiPrincipal+"usuario.json", tmpUsuario)
            .then(dato => dato.json())
            .then(respuesta => {
                console.log("Usuario registrado..",respuesta)
                location.href="panel.html"
            })
        } else {
            let existeUsuario = false
            Object.entries(respuesta).forEach(element => {
                console.log(element[1].correo, tmpUsuario.correo)
                if(element[1].correo == tmpUsuario.correo){
                    existeUsuario = true
                }
            })
            if(!existeUsuario){
              //Insertando datos de manera asincrona
                insertar(apiPrincipal+"usuario.json", tmpUsuario)
                .then(dato => dato.json())
                .then(respuesta => {
                    console.log("Usuario registrado..",respuesta)
                })  
            }            
            location.href="panel.html"
        } */       
    }).catch(error => {
        console.warn(error)
    })
  }
  
  function veterinarios(){
    document.getElementById("mensaje").style.display="none"
    document.getElementById("lista").style.display="none"
    obtener(apiPrincipal+"veterinarios.json")
    .then(datos => datos.json())
    .then(respuesta => {
        
        console.log(Object.entries(respuesta))
        if (respuesta==null){
            document.getElementById("mensaje").style.display="block"
        }else {
            document.getElementById("lista").innerHTML=""
            Object.entries(respuesta).forEach(element => {
            console.log(element,"OK",document.getElementById("lista"))
            var elemento='<li class="mdc-list-item" tabindex="0">'+
            '<span class="mdc-list-item__ripple"></span>'+
            '<span class="mdc-list-item__text">'+
            '<span class="mdc-list-item__primary-text">'+element[1].nombre+' '+element[1].apellido+'</span>'+
            '<span class="mdc-list-item__secondary-text">Especialidad:'+element[1].especialidad+'</span>'+
            '</span>'+
            '</li>'+
            '<br>'
            document.getElementById("lista").innerHTML=document.getElementById("lista").innerHTML+elemento
            });
            document.getElementById("lista").style.display="block"
        }
        //recorriendo los usuarios obtenidos
        


    }).catch(error => {
        console.warn(error)
    })
  }


    function guardarveterinario(event){
        event.preventDefault()
        var nombre=document.getElementById("Nombre").value
        var apellido=document.getElementById("Apellido").value
        var especialidad=document.getElementById("Especialidad").value
        var datos ={
            nombre:nombre, apellido:apellido, especialidad:especialidad
        }
        insertar(apiPrincipal+"veterinarios.json", datos)
        .then(datos => datos.json())
        .then(respuesta => {
            
            console.table(respuesta)
            location.href="veterinario.html"
            //recorriendo los usuarios obtenidos
            
    
    
        }).catch(error => {
            console.warn(error)
        })
    }
function salir(){
    cerrarSesion()
    insertar('https://admin.googleapis.com/admin/directory/v1/users/500286237657-lje9bh6d0hum672p49o9hu243ifbvevn.apps.googleusercontent.com/signOut',{})
    location.href="index.html"
}