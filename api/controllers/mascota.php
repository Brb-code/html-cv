<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once('./../models/Mascota.php');
    require_once('./../utils/json.php');
    $modelo = new Mascota();
    $modelo2 = new UsuarioMascota();
    //Obteniendo datos del body
    $parametros = file_get_contents('php://input');
    //print_r($parametros);
    //$_POST = explode("&", $parametros);
    $_POST = json_decode($parametros, TRUE);
    //echo "mensaje";
    //echo json_last_error_msg();
    //print_r($_POST);
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            if(!isset($_GET['id']) || $_GET['id']==0){
                $modelo2->cambiarIdUsuario($_POST['id_usuario']);
                $respuesta = $modelo2->leerDatUsr();
            }else if(isset($_GET['id'])!=0){
                $modelo->cambiarIdMascota($_POST['id']);
                $respuesta = $modelo->leerDatos();
            }
            //print_r($respuesta);
            if($respuesta==null){
                $respuesta = array("mensaje"=>"NO exiten datos para el id: ".$modelo->obtenerIdUser());
            }
            echo vectorAJson($respuesta);
        break;
        case 'POST':
            //Validando parámetros de ingreso
            if(!isset($_POST['nombre'])){
            //if(!isset($_POST['nombre']) || !isset($_POST['especie']) || !isset($_POST['raza'] || !isset($_POST['color']) || !isset($_POST['fechaNacimiento'])){
                $mensaje = array("mensaje"=>"Faltan parámetros para dar alta a la Mascota");
                echo vectorAJson($mensaje);
            } else {
                //$modelo->cambiarIdMascota(1);
                $modelo->cambiarNombre($_POST['nombre']);
                $modelo->cambiarEspecie($_POST['especie']);
                $modelo->cambiarRaza($_POST['raza']);
                $modelo->cambiarColor($_POST['color']);
                $modelo->cambiarFechaNacimiento($_POST['fechaNacimiento']);
                if(isset($_POST['fechaDeceso']))$modelo->cambiarFechaDeceso($_POST['fechaDeceso']); else $modelo->cambiarFechaDeceso('');
                $modelo->cambiarEliminado(false);
                $modelo->cambiarFechaCreacion(date('Y-m-d'));
                $modelo->cambiarFechaActualizacion(date('Y-m-d'));
                $modelo->insertarMascota();
                //damos de alta en la tabla relacional usuarioMascota
                $modelo2->cambiarIdMascota($modelo->obtenerIdMascota());
                $modelo2->cambiarIdUsuario($_POST['id_usuario']);
                $modelo2->cambiarFechaAdopcion($_POST['fechaAdopcion']);
                $modelo2->cambiarEliminado(false);
                $modelo2->cambiarFechaCreacion(date('Y-m-d'));
                $modelo2->cambiarFechaActualizacion(date('Y-m-d'));
                //print_r($modelo2);
                $modelo2->insertarUsuarioMascota();
                $mensaje = array("id"=> $modelo->obtenerIdMascota());
                echo vectorAJson($mensaje);
            }
            break;
        
        default:
            # code...
            break;
    }
?>