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
                "eliminado bool,".
                "fechaCreacion datetime,".
                "fechaActualizacion datetime,".
                "CONSTRAINT usuario_pk PRIMARY KEY (id_usuario), CONSTRAINT correo_uk UNIQUE (correo)".
            ")";
            $resultado = $cnx->query($consulta);
            if(!$resultado) return null;
        }
        function obtenerIdUsuario(){
            return $this->id_usuario;
        }
        function cambiarIdUsuario($id){
            $this->id_usuario = $id;
        }
        function obtenerCorreo(){
            return $this->correo;
        }
        function cambiarCorreo($correo){
            $this->correo = $correo;
        }
        function obtenerNombres(){
            return $this->nombres;
        }
        function cambiarNombres($nombres){
            $this->nombres = $nombres;
        }
        function obtenerAplicacion(){
            return $this->aplicacion;
        }
        function cambiarAplicacion($aplicacion){
            $this->aplicacion = $aplicacion;
        }
        function obtenerCi(){
            return $this->ci;
        }
        function cambiarCi($ci){
            $this->ci = $ci;
        }
        function obtenerApellidos(){
            return $this->apellidos;
        }
        function cambiarApellidos($apellidos){
            $this->apellidos = $apellidos;
        }
        function obtenerCelular(){
            return $this->celular;
        }
        function cambiarCelular($celular){
            $this->celular = $celular;
        }
        function iniciarSesion(){
            //Insertar el registro
            $consultaInsert ='insert into usuarioI (correo, nombres, aplicacion, eliminado, fechaCreacion, fechaActualizacion) values (:correo, :nombres, :aplicacion, false, now(), now());';
            $cnx = conexion();
            $consulta = $cnx->prepare($consultaInsert);
            $consulta->bindParam(':correo', $this->correo, PDO::PARAM_STR);
            $consulta->bindParam(':nombres', $this->nombres, PDO::PARAM_STR);
            $consulta->bindParam(':aplicacion', $this->aplicacion, PDO::PARAM_STR);
            $consulta->execute();
            //Seleccionar el registro
            $consultaLee = 'SELECT * FROM usuarioI WHERE correo = :correo and eliminado=false LIMIT 1 ;';
            $consulta = $cnx->prepare($consultaLee);
            $consulta->bindParam(':correo', $this->correo, PDO::PARAM_STR);
            $consulta->execute();
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            $this->id_usuario = $resultados[0]["id_usuario"];
        }
        function actualizar(){
            $consultaActualizar = 'UPDATE usuarioI set correo=:correo, nombres=:nombres, aplicacion=:aplicacion, ci=:ci, apellidos =:apellidos, celular=:celular, fechaActualizacion = now() WHERE id_usuario = :id_usuario;';
            $cnx = conexion();
            $consulta = $cnx->prepare($consultaActualizar);
            $consulta->bindParam(':correo', $this->correo, PDO::PARAM_STR);
            $consulta->bindParam(':nombres', $this->nombres, PDO::PARAM_STR);
            $consulta->bindParam(':aplicacion', $this->aplicacion, PDO::PARAM_STR);
            $consulta->bindParam(':ci', $this->ci, PDO::PARAM_STR);
            $consulta->bindParam(':apellidos', $this->apellidos, PDO::PARAM_STR);
            $consulta->bindParam(':celular', $this->celular, PDO::PARAM_INT);
            $consulta->bindParam(':id_usuario', $this->id_usuario, PDO::PARAM_INT);
            $resultado = $consulta->execute();
            return $resultado;
        }
        function eliminar(){
            $consultaActualizar = 'UPDATE usuarioI set eliminado=true, fechaActualizacion = now() WHERE id_usuario = :id_usuario;';
            $cnx = conexion();
            $consulta = $cnx->prepare($consultaActualizar);
            $consulta->bindParam(':id_usuario', $this->id_usuario, PDO::PARAM_INT);
            $resultado = $consulta->execute();
            return $resultado;
        }
    }