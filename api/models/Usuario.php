<?php
    require_once('./../utils/conexion.php');
    class Usuario {
        private $id_usuario="";
        private $correo="";
        private $nombres="";
        private $aplicacion="";
        private $ci="";
        private $apellidos="";
        private $celular=0;

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
                "CONSTRAINT usuario_pk PRIMARY KEY (id_usuario), correo_uk UNIQUE (correo)".
            ")";
            $resultado = $cnx->query($consulta);
            if(!$resultado) return null;
        }
        function iniciarSesion(){
            //Insertar el registro
            $consultaInsert ='insert into usuarioI (correo, nombres, aplicacion) values (:correo, :nombres, :aplicacion);';
            $cnx = conexion();
            $consulta = $cnx->prepare($consultaInsert);
            $consulta->bindParam(':correo', $this->correo, PDO::PARAM_STR);
            $consulta->bindParam(':nombres', $this->nombres, PDO::PARAM_STR);
            $consulta->bindParam(':aplicacion', $this->aplicacion, PDO::PARAM_STR);
            $consulta->execute();
            //Seleccionar el registro
            $consultaLee = 'SELECT * FROM usuarioI WHERE correo = :correo LIMIT 1 ;';
            $consulta = $cnx->prepare($consultaLee);
            $consulta->bindParam(':correo', $this->correo, PDO::PARAM_STR);
            $consulta->execute();
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            var_dump($resultados[0]);
        }
    }
    $u1 = new Usuario();
    $u1->iniciarSesion();
