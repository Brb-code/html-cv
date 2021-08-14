<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once('./../models/Usuario.php');
    require_once('./../utils/json.php');
    $modelo = new Veterinario();
    //Obteniendo datos del body
    $parametros = file_get_contents('php://input');
    $_POST = json_decode($parametros, TRUE);

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            if(isset($_GET['id'])){
                $modelo->cambiarIdVeterinario($_POST['id']);
                $respuesta = $modelo->leerDatos();
            }else if(isset($_GET['idusr'])){
                $modelo->cambiarIdUsuario($_POST['idusr']);
                $respuesta = $modelo->leerDatUsr();
            }

            //print_r($respuesta);
            if($respuesta==null){
                $respuesta = array("mensaje"=>"NO exiten datos para el id: ".$modelo->obtenerIdUser());
            }
            echo vectorAJson($respuesta);
            break;
        case 'POST':
            //Validando parámetros de ingreso
            if(!isset($_POST['nombre']) || !isset($_POST['apellido']) || !isset($_POST['especialidad'] || !isset($_POST['direccion']) || !isset($_POST['telefono']) || !isset($_POST['id_usuario']) ){
                $mensaje = array("mensaje"=>"Faltan parámetros para dar alta a la Mascota");
                echo vectorAJson($mensaje);
            } else {
                //$modelo->cambiarIdMascota(1);
                $modelo->cambiarNombre($_POST['nombre']);
                $modelo->cambiarApellido($_POST['apellido']);
                $modelo->cambiarEspecialidad($_POST['especialidad']);
                $modelo->cambiarDireccion($_POST['direccion']);
                $modelo->cambiarTelefono($_POST['telefono']);
                $modelo->cambiarIdUsuario($_POST['id_usuario']); 
                $modelo->insertarMascota();
                $mensaje = array("id"=> $modelo->obtenerIdVeterinario());
                echo vectorAJson($mensaje);
            }
            break;
        case 'PUT':
            //Validando parámetros de ingreso
            if(!isset($_GET['id'])){
                $mensaje = array("mensaje"=>"Falta el código del Veterinario.");
                echo vectorAJson($mensaje);
            } else if(!isset($_POST['nombre']) || !isset($_POST['apellido']) || !isset($_POST['especialidad'] || !isset($_POST['direccion']) || !isset($_POST['telefono']) || !isset($_POST['id_usuario']) ){
                $mensaje = array("mensaje"=>"Faltan parámetros para actualizar al Veterinario.");
                echo vectorAJson($mensaje);
            } else {
                $modelo->cambiarIdUsuario($_GET['id']);
                $modelo->cambiarNombre($_POST['nombre']);
                $modelo->cambiarApellido($_POST['apellido']);
                $modelo->cambiarEspecialidad($_POST['especialidad']);
                $modelo->cambiarDireccion($_POST['direccion']);
                $modelo->cambiarTelefono($_POST['telefono']);
                $modelo->cambiarIdUsuario($_POST['id_usuario']); 
    
                $respuesta = $modelo->actualizar();
                $mensaje = array("respuesta"=> $respuesta);
                echo vectorAJson($mensaje);
            }
            break;        
        
        default:
            $mensaje = array("mensaje"=>"Servicio en linea");
            echo vectorAJson($mensaje);
            break;
    }//finswitch
?>