<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ejercicio 1</h1>
    <?php 
        $num1 = 1;
        $num2 = 2;
        //Suma
        $suma = $num1 + $num2;
        echo "<p>La suma entre $num1 y $num2 es igual a $suma.</p>";
    
        function resta($n1=1, $n2=2): int {
            return $resta = $n1 - $n2;
        }
        
        echo "<p>La resta entre $num1 y $num2 es igual a ".resta($num1, $num2).".</p>";
        echo "<p>La resta entre $num2 y $num1 es igual a ".resta($num2, $num1).".</p>";
    ?>

    <h1>Ejercicio 2</h1>
    <p>Realizar un programa que muestre en año, mes, día, horas, minutos y segundos un tiempo expresado en segundos.</p>
    <?php
        $tiempo = 600000000;
        echo calculaAnio($tiempo);
        $tiempo = reducirAnios($tiempo);


        function calculaAnio($num):int{
            $cntAnios = 0;
            while($num>=31536000){
                $num = $num - 31536000;
                $cntAnios = $cntAnios +1;
            }
            return $cntAnios;
        }
        function reducirAnios($num):int {
            while($num>=31536000){
                $num = $num - 31536000;                
            }
            return $num;
        }
        function calculaMes($num):int{
            $cntAnios = 0;
            while($num>=31536000){
                $num = $num - 31536000;
                $cntAnios = $cntAnios +1;
            }
            return $cntAnios;
        }
    ?>
</body>
</html>