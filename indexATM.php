<?php
require_once('./Atm.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATM</title>
</head>
<body>
    <?php
        $atmCamacho = new Atm();
    ?>
    <h1>Bienvenid@ al ATM</h1>
    <h2>Saldo disponible: <?php echo $atmCamacho->saldoTotal(); ?></h2>
    <h2>Saldo por billetes:</h2>
    <table>
        <thead>
            <tr>
                <th>Corte</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>        
        <?php            
            foreach ($atmCamacho->saldoTotalxBillete() as $corte => $cantidad) {
                echo "<tr><td>$corte</td><td>$cantidad</td></tr>";   
            }
        ?>
        </tbody>
    </table>
    <?php
        //Métodos de envio
        //GET por defecto
        //var_dump($_GET);
        //POST
        var_dump($_POST["monto"]*1);
        if($atmCamacho->validaMontoSaldo($_POST["monto"]*1))
            echo "Se tiene el saldo";
        else echo "No se tiene el saldo";
        
    ?>

    <!-- Formulario donde se solicite un monto para retirar -->
  
    <form action="" method="POST">
        <input type="number" name="monto" placeholder="Monto a retirar">
        <button type="submit">Retirar</button>
    </form>
    
    <h3>Se le entregará</h3>
    <table>
        <thead>
            <tr>
                <th>Corte</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>        
        <?php            
            foreach ($atmCamacho->retiro($_POST["monto"]*1) as $corte => $cantidad) {
                echo "<tr><td>$corte</td><td>$cantidad</td></tr>";   
            }
        ?>
        </tbody>
    </table>

</body>
</html>