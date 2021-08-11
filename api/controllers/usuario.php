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
        case 'PUT':
            //Validando parámetros de ingreso
            if(!isset($_GET['id'])){
                $mensaje = array("mensaje"=>"Falta el código del Usuario.");
                echo vectorAJson($mensaje);
            } else if(!isset($_POST['correo']) || !isset($_POST['nombres']) || !isset($_POST['aplicacion']) || !isset($_POST['ci']) || !isset($_POST['apellidos']) || !isset($_POST['celular'])){
                $mensaje = array("mensaje"=>"Faltan parámetros para actualizar al usuario.");
                echo vectorAJson($mensaje);
            } else {
                $modelo->cambiarIdUsuario($_GET['id']);
                $modelo->cambiarCorreo($_POST['correo']);
                $modelo->cambiarNombres($_POST['nombres']);
                $modelo->cambiarAplicacion($_POST['aplicacion']);
                $modelo->cambiarCi($_POST['ci']);
                $modelo->cambiarApellidos($_POST['apellidos']);
                $modelo->cambiarCelular($_POST['celular']);

                $respuesta = $modelo->actualizar();
                $mensaje = array("respuesta"=> $respuesta);
                echo vectorAJson($mensaje);
            }
            break;        
        default:
            # code...
            break;
    }