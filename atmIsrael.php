<?php
    $monto = 750;    
    // Validar que el monto esté acorde a los cortes
    if($monto/10 == (int)($monto/10)){

        //Para billetes de 200
        $cnt200 = (int)($monto/200);
        $monto=$monto-($cnt200*200);

        // Cantidad de cortes suficientes para el retiro
        // Control en el monto de retiro
        

    } else {
        echo "El monto solicitado debe ser multiplo de 10.";
    }

    

    







    echo "Billetes de 200: ".$cnt200;
    echo "Billetes de 100: ";
    echo "Billetes de 50: ";
    echo "Billetes de 20: ";
    echo "Billetes de 10: ";