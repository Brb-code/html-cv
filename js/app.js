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
    obtener(apiPrincipal+"usuario.json")
    .then(datos => datos.json())
    .then(respuesta => {
        console.table(respuesta)
        //recorriendo los usuarios obtenidos
        


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
        
        console.table(respuesta)
        if (respuesta==null){
            document.getElementById("mensaje").style.display="block"
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



  /*
  .then(datos => datos.json())
    .then(respuesta => {
        if(respuesta == null){
            //Insertando datos
            console.table(tmpUsuario)
            fetch('https://micv-b2537-default-rtdb.firebaseio.com/usuario.json',{
                method: 'POST',
                body: JSON.stringify(tmpUsuario)
            })
            .then(datos => datos.json())
            .then(respuesta2 => {
                console.table(respuesta2)
            }).catch(error2 => {
                console.log(error2)
            })
        } else {
            console.table(respuesta)
        }
    }).catch(error => {
        console.log(error)
    })
    */