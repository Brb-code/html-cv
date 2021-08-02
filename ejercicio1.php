<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    function convierteseg($segundos){ 
        //return date('dd/mm/yyyy hh:mm:ss', $segundos);
        returm date(r,$segundos);
    }
    $segundos = 987654310;
    $fecha = convierteseg($segundos);
    echo "Conversion segundos a fecha";
    echo "<p>segundos: $segundos</p>";
    echo "<p>fecha: $fecha</p>"
    ?>
    
</body>
</html>