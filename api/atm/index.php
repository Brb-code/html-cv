<?php
    //Controlador de atm
    require_once("./../utils.php");
    //Importando el modelo ATM
    require("./Atm.php");
    //Cambiando la cabecera de HTML a JSON
    header("Content-Type: application/json; charset=UTF-8");
    $atmCamacho = new Atm();
    $atmPerez = new Atm();
    $atms = array($atmCamacho, $atmPerez);
    

    switch($_SERVER["REQUEST_METHOD"]){
        case 'GET':
            $respueta = $atmCamacho->imprimir();
            echo vectorAJson($respueta);
            break;
        case 'POST':
            echo "Solicitado por POST";
            break;
        case 'PUT':
            echo "Solicitado por PUT";
            break;
        case 'DELETE':
            echo "Solicitado por DELETE";
            break;
        default:
            echo "Solicitud por otro método";
    }
    