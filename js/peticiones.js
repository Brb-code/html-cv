const apiPrincipal = "http://localhost/mascotas/api/controllers/"

function obtener(url) {
    // Obtenemos de un servicios los usuarios autenticados
    return fetch(url)
}

function insertar(url, datos) {
    // Obtenemos de un servicios los usuarios autenticados
    console.log(url)
    console.log(datos)
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
}