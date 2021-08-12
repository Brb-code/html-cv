<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once('./../models/Mascota.php');
    require_once('./../utils/json.php');
    $modelo = new Mascota();
    //Obteniendo datos del body
    $parametros = file_get_contents('php://input');
    $_POST = json_decode($parametros, TRUE);

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            //Validando parámetros de ingreso
            if(!isset($_POST['nombre']) || !isset($_POST['especie']) || !isset($_POST['raza'] || !isset($_POST['color']) || !isset($_POST['fechaNacimiento'])){
                $mensaje = array("mensaje"=>"Faltan parámetros para dar alta a la Mascota");
                echo vectorAJson($mensaje);
            } else {
                //$modelo->cambiarIdMascota(1);
                $modelo->cambiarNombre($_POST['nombre']);
                $modelo->cambiarEspecie($_POST['especie']);
                $modelo->cambiarRaza($_POST['raza']);
                $modelo->cambiarColor($_POST['color']);
                $modelo->cambiarFechaNacimiento($_POST['fechaNacimiento']);
                if(isset($_POST['fechaDeceso'])) $modelo->cambiarFechaDeceso($_POST['fechaDeceso']); else $modelo->cambiarFechaDeceso('');
                $modelo->cambiarEliminado(false);
                $modelo->cambiarFechaCreacion(date('Y-m-d'));
                $modelo->cambiarFechaActualizacion(date('Y-m-d'));
                $modelo->insertarMascota();
                $mensaje = array("id"=> $modelo->obtenerIdMascota());
                echo vectorAJson($mensaje);
            }
            break;
        
        default:
            # code...
            break;
    }
?>