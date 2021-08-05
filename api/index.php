<?php
    switch($_SERVER["REQUEST_METHOD"]){
        case 'GET':
            echo "Solicitado por GET";
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
    