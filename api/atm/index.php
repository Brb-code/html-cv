<?php

    //Controlador de atm
    require_once("./../utils.php");
    //Importando el modelo ATM
    require_once("./Atm.php");
    //Cambiando la cabecera de HTML a JSON
    header("Content-Type: application/json; charset=UTF-8");
    //Obteniendo datos del body
    $parametros = file_get_contents('php://input');
    $_POST = json_decode($parametros, TRUE);
    $_POST = json_decode($parametros, TRUE);
    $atmCamacho = new Atm(1,"Camacho");
    $atmPerez = new Atm(2,"Perez");
    $atmPrado = new Atm(3,"Prado");
    $atms = array($atmCamacho->id=>$atmCamacho, $atmPerez->id=>$atmPerez,$atmPrado->id=>$atmPrado);
    //print_r($atms); die();
    //print_r(http_response_code());
    //print_r($_GET);
    //print_r($_POST);die();

    switch($_SERVER["REQUEST_METHOD"]){
        case 'GET':
            //verificamos que se haya enviado un id con la peticion GET
            if(isset($_GET['id'])){
                $cajero=$_GET['id'];
                //verificamos que exista el cajero solicitado
                if(isset($atms[$cajero])){
                    $atmtemporal=
                    $respuesta = $atms[$cajero]->imprimir();
                }else{
                    http_response_code(204);
                    $respuesta = array("mensaje"=>"Cajero No existe");
                }
            }else{
                foreach($atms as $item){
                    $respuesta[]=$item->imprimir();
                }
            }
            echo vectorAJson($respuesta);
            break;
        case 'POST':
            //Variables o parametros
            $id=count($atms)+1;
            $descripcion=$_POST['descripcion'];
            $atmNuevo = new Atm($id,$descripcion);
            if($atms[$id]=$atmNuevo){
                $respuesta = array("id"=>$id);
            }else{
                $respuesta = array("mensaje"=>"Error al dar de Alta Cajero");
            }
            echo vectorAJson($respuesta);
            break;
        case 'PUT':
            if(isset($_GET['id'])){
                $cajero=$_GET['id'];
                //verificamos que exista el cajero solicitado
                if(isset($atms[$cajero])){
                    //print_r($_POST);die();
                    if(isset($_POST['descripcion'])){
                        $atms[$cajero]->descripcion=$_POST['descripcion'];
                    }
                    if(isset($_POST['cortes'])){
                        $atms[$cajero]->cortes=$_POST['cortes'];
                    }
                    if(isset($_POST['cantidades'])){
                        $atms[$cajero]->cantidades=$_POST['cantidades'];
                    }
                    $respuesta = $atms[$cajero]->imprimir();
                }else{
                    http_response_code(204);
                    $respuesta = array("mensaje"=>"Cajero No existe");
                }
            }else{
                $respuesta = array("mensaje"=>"Cajero No existe");
            }
            echo vectorAJson($respuesta);
            break;
        case 'DELETE':
            echo "Solicitado por DELETE";
            break;
        default:
            echo "Solicitud por otro método";
    }
    