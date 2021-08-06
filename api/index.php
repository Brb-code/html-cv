<?php
//echo "<p>PAGINA PRINCIPAL</p>";
    require_once("./utils.php");
    header("Content-Type: application/json; charset=UTF-8");
    
    switch($_SERVER["REQUEST_METHOD"]){
        case 'GET':
            $respueta = array("mensaje"=>"Solicitado por GET");
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
    