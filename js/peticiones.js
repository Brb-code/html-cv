const apiPrincipal = "http://localhost/mascotas/api/controllers/"

function obtener(url) {
    // Obtenemos de un servicios los usuarios autenticados
    return fetch(url)
}

async function insertar(url, datos) {
    console.log(datos)
    respuesta = await fetch(url, {
        method: "POST",
        body: JSON.stringify(datos)
    })
    json = await respuesta.json()
    console.log(json)
    return json
}
async function leer(url, datos) {
    console.log(datos)
    console.log(url)
    link = url + "?id=" + datos['id'] + "&id_usuario=" + datos['id_usuario']
    console.log(link)
    respuesta = await fetch(link, {
        method: "GET"
    })
    json = await respuesta.json()
    console.log("json:", json)
    return json
}
/*function insertar(url, datos) {
    // Obtenemos de un servicios los usuarios autenticados
    return fetch(url, {
        method: "POST",
        body: JSON.stringify(datos)
    })
}

function leer(url, datos = {}) {
    console.log(datos)
    if (datos) {
        return fetch(url, {
            method: "GET"
        })
    } else {
        return fetch(url + "?id=" + datos['id'], {
            method: "GET"
        })
    }
}*/