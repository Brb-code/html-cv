<?php
    require_once('./../utils/conexion.php');
    class Mascota {
        private $id_mascota="";
        private $nombre="";
        private $especie="";
        private $raza="";
        private $color="";
        private $fec_nacimiento="";
        private $fec_deceso="";
        private $eliminado=false;
        private $fechaCreacion="";
        private $fechaActualizacion="";

        function Mascota(){
            $cnx = conexion();
            $consulta = "CREATE table if not exists mascota (
                id_mascota int(11) not null auto_increment,
                nombre varchar(20) not null,
                especie varchar(20),
                raza varchar(20),
                color varchar(20),
                fec_nacimiento date,
                fec_deceso date,
                eliminado bool,
                fechaCreacion datetime,
                fechaActualizacion datetime,
                CONSTRAINT mascota_pk PRIMARY KEY (id_mascota))";
            $resultado = $cnx->query($consulta);
            //echo $consulta;
            if(!$resultado) return null;
        }
        function obtenerIdMascota(){
            return $this->id_mascota;
        }
        function cambiarIdMascota($id){
            $this->id_mascota = $id;
        }
        function obtenerNombre(){
            return $this->nombre;
        }
        function cambiarNombre($nombre){
            $this->nombre = $nombre;
        }
        function obtenerEspecie(){
            return $this->especie;
        }
        function cambiarEspecie($especie){
            $this->especie = $especie;
        }
        function obtenerRaza(){
            return $this->raza;
        }
        function cambiarRaza($raza){
            $this->raza = $raza;
        }
        function obtenerColor(){
            return $this->color;
        }
        function cambiarColor($color){
            $this->color = $color;
        }
        function obtenerFecNacimiento(){
            return $this->fec_nacimiento;
        }
        function cambiarFecNacimiento($fec_nacimiento){
            $this->fec_nacimiento = $fec_nacimiento;
        }
        function obtenerFecDeceso(){
            return $this->fec_deceso;
        }
        function cambiarFecDeceso($fec_deceso){
            $this->fec_deceso = $fec_deceso;
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
        

        function insertarMascota(){
            //Insertar el registro
            $consultaInsert ='insert into mascota (nombre, especie, raza, color, fec_nacimiento, fec_deceso, eliminado, fechaCreacion, fechaActualizacion) values (:nombre, :especie, :raza, :color, :fec_nacimiento, :fec_deceso,:eliminado, :fechaCreacion, :fechaActualizacion);';
            $cnx = conexion();
            $consulta = $cnx->prepare($consultaInsert);
            $consulta->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
            $consulta->bindParam(':especie', $this->especie, PDO::PARAM_STR);
            $consulta->bindParam(':raza', $this->raza, PDO::PARAM_STR);
            $consulta->bindParam(':color', $this->color, PDO::PARAM_STR);
            $consulta->bindParam(':fec_nacimiento', $this->fec_nacimiento, PDO::PARAM_STR);
            $consulta->bindParam(':fec_deceso', $this->fec_deceso, PDO::PARAM_STR);
            $consulta->bindParam(':eliminado', $this->eliminado, PDO::PARAM_BOOL);
            $consulta->bindParam(':fechaCreacion', $this->fechaCreacion, PDO::PARAM_STR);
            $consulta->bindParam(':fechaActualizacion', $this->fechaActualizacion, PDO::PARAM_STR);
            $consulta->execute();
            //Seleccionar el registro
            $consultaLee = 'SELECT * FROM mascota WHERE nombre = :nombre LIMIT 1 ;';
            $consulta = $cnx->prepare($consultaLee);
            $consulta->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
            $consulta->execute();
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            //var_dump($resultados[0]);
            $this->id_mascota = $resultados[0]["id_mascota"];   
        }
        function actualizar(){
            $consultaActualizar = 'UPDATE mascota set nombre=:nombre, especie=:especie, raza=:raza, color=:color, fec_nacimiento=:fec_nacimiento, fec_deceso=:fec_deceso,eliminado=:eliminado,fechaCreacion=:fechaCreacion, fechaActualizacion=now() WHERE id_mascota = :id_mascota;';
            $cnx = conexion();
            $consulta = $cnx->prepare($consultaActualizar);
            $consulta->bindParam(':id_mascota', $this->id_mascota, PDO::PARAM_INT);
            $consulta->bindParam(':nombre', $this->nombre, PDO::PARAM_STR);
            $consulta->bindParam(':especie', $this->especie, PDO::PARAM_STR);
            $consulta->bindParam(':raza', $this->raza, PDO::PARAM_STR);
            $consulta->bindParam(':color', $this->color, PDO::PARAM_STR);
            $consulta->bindParam(':fec_nacimiento', $this->fec_nacimiento, PDO::PARAM_STR);
            $consulta->bindParam(':fec_deceso', $this->fec_deceso, PDO::PARAM_STR);
            $consulta->bindParam(':eliminado', $this->eliminado, PDO::PARAM_BOOL);
            $consulta->bindParam(':fechaCreacion', $this->fechaCreacion, PDO::PARAM_STR);
            $consulta->bindParam(':fechaActualizacion', $this->fechaActualizacion, PDO::PARAM_STR);
            $resultado = $consulta->execute();
            return $resultado;
        }

    }//fin clase Mascota

    $mascota1 = new Mascota();
    $mascota1->cambiarIdMascota(1);
    $mascota1->cambiarNombre("Choco");
    $mascota1->cambiarEspecie("perro");
    $mascota1->cambiarRaza("Terrier");
    $mascota1->cambiarColor("chocolate");
    $mascota1->cambiarFecNacimiento("2015-03-15");
    $mascota1->cambiarFecDeceso("");
    //$mascota1->insertarMascota();
    echo $mascota1->actualizar();
?>