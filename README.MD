# API REST PARA UN ATM

## Servicios

### GET /atm

Lista a todas las atm registradas

##### Requisitos

**Ninguno**

##### Retorna

**200 OK**

```bash
[
    {
        cortes:[200, 100, 50],
        cantidades:[
            200:1,
            100:40,
            50:0
        ]
    }
]
```

**40X Error**

```bash
{
    mensaje:"Error al obtener los atms"
}
```

### POST /atm

Crea un nuevo ATM.

##### Requisitos

```bash
{
    cortes:[200, 100],
    cantidades:[200:1, 100:0]
}
```

##### Retorna

**201 Registro exitoso**

```bash
{
    id: 2
}
```

**40X Error**

```bash
{
    mensaje:"Error al registrar el ATM."
}
```

### GET /atm/saldo/:id

Obtener el saldo de un atm.

##### Requisitos

:id = Identificador del ATM

##### Retorna

**200 OK**

```bash
{
    saldo: 450,
    saldoxCorte:{
        bs200:1,
        bs100: 2,
        bs50: 1
    }
}
```

**40X Error**

```bash
{
    mensaje:"Error al obtener el saldo."
}
```

### POST /atm/retiro

Permite retirar un monto del cajero.

##### Requisitos

```bash
{
    id: 1,
    monto: 300
}
```

##### Retorna

**200 OK**

```bash
[
    {
        cortes:[200, 100, 50],
        cantidades:[
            200:1,
            100:40,
            50:0
        ]
    }
]
```

**400 Error**

```bash
{
    mensaje:"Error al generar el retiro"
}
```

**401 Error**

```bash
{
    mensaje:"No se cuenta con el monto solicitado"
}
```

### PUT /atm/saldo/:id

Agregar saldo en el cajero

##### Requisitos

:id = Identificador del ATM

```bash
{
    cortes:[200, 100, 50],
    cantidades:[200:2, 100:4, 50:4]
}
```

##### Retorna

**200 OK**

```bash
[
    mensaje:"ok"
]
```

**40X Error**

```bash
{
    mensaje:"Error al actualizar saldos del atm"
}
```
