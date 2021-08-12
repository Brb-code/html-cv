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
