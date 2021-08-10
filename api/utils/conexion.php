<?php
    $host="sql176.main-hosting.eu";
    $bd="u868164586_pruebaUBI";
    $usuario="u868164586_ubi";
    $contraseña="XlIT0=oy1$N";

    function conexion($host, $bd, $usuario, $contraseña){
        $cadenaConexion = "mysql:host=$host;dbname=$bd";
        try {
            $cnx = new PDO($cadenaConexion, $usuario, $contraseña);
            if($cnx) {
                echo "Conectado!!!!";
            } else {
                echo "Error al conectarse";
            }
        } catch (PDOException $e) {
            var_dump($e);
        }
    }
    
    conexion($host, $bd, $usuario, $contraseña);
