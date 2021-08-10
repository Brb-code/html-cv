<?php
    require_once('./../utils/conexion.php');
    class Usuario {
        /*$id_usuario;
        $correo;
        $nombres;
        $aplicacion;
        $ci;
        $apellidos;
        $celular;*/

        function Usuario(){
            $cnx = conexion();
            $consulta = "CREATE table if not exists usuarioI (".
                "id_usuario int(11) not null auto_increment,".
                "correo varchar(50),".
                "nombres varchar(100),".
                "aplicacion varchar(10),".
                "ci varchar(25),".
                "apellidos varchar(100),".
                "celular int(10),".
                "CONSTRAINT usuario_pk PRIMARY KEY (id_usuario)".
            ")";
            $resultado = $cnx->query($consulta);
            if(!$resultado) return null;
        }
    }
    $u1 = new Usuario();