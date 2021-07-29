function loginGoogle(){
    alert("ok")
}
function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
    let tmpUsuario = {
        id: profile.getId(),
        nombre: profile.getName(),
        foto: profile.getImageUrl(),
        correo: profile.getEmail()
    }
    localStorage.setItem('token', JSON.stringify(tmpUsuario))
    fetch('https://micv-b2537-default-rtdb.firebaseio.com/usuario.json')
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
  }

  function insertar(url, datos){
      fetch()
  }
  function obtener(url){
    
  }