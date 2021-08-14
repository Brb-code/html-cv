<?php
    require_once('./../utils/conexion.php');
    class Veterinario {
        private $id_veterinario="";
        private $nombre="";
        private $apellido="";
        private $especialidad="";
        private $direccion="";
        private $telefono="";
        private $id_usuario="";
        private $eliminado=false;
        private $fechaCreacion="";
        private $fechaActualizacion="";
        
        function Veterinario(){
            $cnx = conexion();
            $consulta = "CREATE table if not exists veterinario (".
                "id_veterinario integer(11) not null auto_increment,". 
                "nombre varchar(50) not null,". 
                "apellido varchar(50) not null,". 
                "especialidad varchar(50),".
                "direccion varchar(100),".
                "telefono varchar(12),".
                "id_usuario integer(11),".
                "eliminado bool,"
                "fechaCreacion datetime,"
                "fechaActualizacion datetime,"
                "CONSTRAINT veterinario_pk PRIMARY KEY (id_veterinario),".
                "CONSTRAINT id_user_veterinario FOREIGN KEY (id_usuario)".
                "REFERENCES usuarioI (id_usuario)".
                "ON UPDATE NO ACTION".
                "ON DELETE NO ACTION"

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
        function obtenerApellido(){
            return $this->apellido;
        }
        function cambiarApellido($apellido){
            $this->apellido = $apellido;
        }
        function obtenerEspecialidad(){
            return $this->especialidad;
        }
        function cambiarEspecialidad($nombre){
            $this->especialidad = $especialidad;
        }
        function obtenerDireccion(){
            return $this->direccion;
        }
        function cambiarDireccion($direccion){
            $this->direccion = $direccion;
        }
        function obtenerTelefono(){
            return $this->telefono;
        }
        function cambiarTelefono($telefono){
            $this->telefono = $telefono;
        }
        function obtenerIdUsuario(){
            return $this->id_usuario;
        }
        function cambiarIdUsuario($id){
            $this->id_usuario = $id;
        }
        function obtenerEliminado(){
            return $this->eliminado;
        }
        function cambiarEliminado($eliminado){
            $this->eliminado = $eliminado;
        }
        function obtenerFechaCreacion(){
            return $this->fechaCreacion;
        }
        function cambiarFechaCreacion($fechaCreacion){
            $this->fechaCreacion = $fechaCreacion;
        }
        function obtenerFechaActualizacion(){
            return $this->fechaActualizacion;
        }
        function cambiarFechaActualizacion($fechaActualizacion){
            $this->fechaActualizacion = $fechaActualizacion;
        }

        function leerDatUsr(){
            $consultaLee = "SELECT * from veterinario as e WHERE e.id_usuario= :id_usuario AND e.eliminado=true";
            $cnx = conexion();
            $consulta = $cnx->prepare($consultaLee);
            $consulta->bindParam(':id_usuario', $this->id_usuario, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            if(!$resultado) return null; else return $resultado;
        }

        function leerDatos(){
            $consultaLee = "SELECT * from veterinario as e WHERE e.id_veterinario= :id_veterinario AND e.eliminado=true";
            $cnx = conexion();
            $consulta = $cnx->prepare($consultaLee);
            $consulta->bindParam(':id_veterinario', $this->id_veterinario, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            if(!$resultado) return null; else return $resultado;
        }
 
        function insertar(){
            //Insertar el registro
            $consultaInsert ='insert into veterinario (nombre, apellido, especialidad, direccion, telefono, id_usuario, eliminado, fechaCreacion, fechaActualizacion) values (:nombre, :apellido, :especialidad, :direccion, :telefono, :id_usuario, false, now(), now());';
            $cnx = conexion();
            $consulta = $cnx->prepare($consultaInsert);
            $consulta->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
            $consulta->bindParam(':apellido', $this->apellido, PDO::PARAM_STR);
            $consulta->bindParam(':especialidad', $this->especialidad, PDO::PARAM_STR);
            $consulta->bindParam(':direccion', $this->direccion, PDO::PARAM_STR);
            $consulta->bindParam(':telefono', $this->telefono, PDO::PARAM_STR);
            $consulta->bindParam(':id_usuario', $this->id_usuario, PDO::PARAM_INT);
            $consulta->execute();
            //Seleccionar el registro
            $consultaLee = 'SELECT * FROM veterinario WHERE id_usuario = :id_usuario and  telefono = :telefono LIMIT 1 ;';
            $consulta = $cnx->prepare($consultaLee);
            $consulta->bindParam(':id_usuario', $this->id_usuario, PDO::PARAM_INT);
            $consulta->bindParam(':telefono', $this->telefono, PDO::PARAM_STR);
            $consulta->execute();
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            //var_dump($resultados);
            $this->id_veterinario = $resultados[0]["id_veterinario"];   
        }

        function actualizar(){
            $consultaActualizar = 'UPDATE veterinario set nombre=:nombre, apellido=:apellido, especialidad=:especialidad, direccion=:direccion, telefono =:telefono, id_usuario=:id_usuario, fechaActualizacion = now() WHERE id_veterinario = :id_veterinario;';
            $cnx = conexion();
            $consulta = $cnx->prepare($consultaActualizar);
            $consulta->bindParam(':id_veterinario', $this->id_veterinario, PDO::PARAM_INT);
            $consulta->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
            $consulta->bindParam(':apellido', $this->apellido, PDO::PARAM_STR);
            $consulta->bindParam(':especialidad', $this->especialidad, PDO::PARAM_STR);
            $consulta->bindParam(':direccion', $this->direccion, PDO::PARAM_STR);
            $consulta->bindParam(':telefono', $this->telefono, PDO::PARAM_STR);
            $consulta->bindParam(':id_usuario', $this->id_usuario, PDO::PARAM_INT);
            $resultado = $consulta->execute();
            return $resultado;
        }

        function eliminar(){
            $consultaActualizar = 'UPDATE veterinario set eliminado=true, fechaActualizacion = now() WHERE id_veterinario = :id_veterinario;';
            $cnx = conexion();
            $consulta = $cnx->prepare($consultaActualizar);
            $consulta->bindParam(':id_veterinario', $this->id_veterinario, PDO::PARAM_INT);
            $resultado = $consulta->execute();
            return $resultado;
        }

    }
?>