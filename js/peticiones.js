const apiPrincipal = "http://localhost/mascotas/api/controllers/"

function obtener(url) {
    // Obtenemos de un servicios los usuarios autenticados
    return fetch(url)
}

async function insertar(url, datos) {
    // Obtenemos de un servicios los usuarios autenticados
    respuesta = await fetch(url, {
        method: "POST",
        body: JSON.stringify(datos)
    })
    console.log("resp",
        respuesta)
    json = await respuesta
    console.log(json.tk)
    return json
}
/*function insertar(url, datos) {
    // Obtenemos de un servicios los usuarios autenticados
    return fetch(url, {
        method: "POST",
        body: JSON.stringify(datos)
    })
}*/

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
}