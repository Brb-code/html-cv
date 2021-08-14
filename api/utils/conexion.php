<?php
    function conexion(){
        $host="sql176.main-hosting.eu";
        $bd="u868164586_pruebaUBI";
        $usuario="u868164586_ubi";
        $contrasenia='XlIT0=oy1$N';
        $cadenaConexion = "mysql:host=$host;dbname=$bd";
        try {
            $cnx = new PDO($cadenaConexion, $usuario, $contrasenia);
            if($cnx) return $cnx;
            else return null;
        } catch (PDOException $e) {
            var_dump($e);
            return null;
        }
    }
