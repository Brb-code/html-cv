<?php
    require_once('./../utils/conexion.php');
    class veterinario {
        private $id_veterinario="";
        private $nombre="";
        private $especialidad="";
        private $direccion="";
        private $usuario_id="";

        function veterinario(){
            $cnx = conexion();
            $consulta = "CREATE table if not exists veterinario (".
                "nombre varchar(100) not null auto_increment,". 
                "especialidad varchar(100),".
                "direccion varchar(100),".
                "usuario_id varchar(100),".
                "apellidos int(11),".

            $resultado = $cnx->query($consulta);
            if(!$resultado) return null;
        
        }
        function obtenerIdVeterinario(){
            return $this->id_veterinario;
        }
        function cambiarIdVeterinario($id){
            $this->id_veterinario = $id;
        }
        function obtenerNombre(){
            return $this->nombre;
        }
        function cambiarNombre($nombre){
            $this->nombre = $nombre;
        }
        
        function obtenerUsuarioId(){
            return $this->usuario_id;
        }
        function cambiarUsuarioId($id){
            $this->usuario_id = $id;
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
    $u1->cambiarCorreo("ijhm@gmail.com");
    $u1->iniciarSesion();
