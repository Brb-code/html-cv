<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once('./../models/Usuario.php');
    require_once('./../utils/json.php');
    $modelo = new Usuario();
    //Obteniendo datos del body
    $parametros = file_get_contents('php://input');
    $_POST = json_decode($parametros, TRUE);

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            //Validando parámetros de ingreso
            if(!isset($_POST['correo']) || !isset($_POST['nombres']) || !isset($_POST['aplicacion'])){
                $mensaje = array("mensaje"=>"Faltan parámetros para el inicio ce sesión");
                echo vectorAJson($mensaje);
            } else {
                $modelo->cambiarCorreo($_POST['correo']);
                $modelo->cambiarNombres($_POST['nombres']);
                $modelo->cambiarAplicacion($_POST['aplicacion']);
                $modelo->iniciarSesion();
                $mensaje = array("tk"=> $modelo->obtenerIdUsuario());
                echo vectorAJson($mensaje);
            }
            break;
        
        default:
            # code...
            break;
    }