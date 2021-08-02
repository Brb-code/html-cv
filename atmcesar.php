<?php
$monto = 750;
$cortes= array(200,100,50,20,10);
$auxmonto=$monto;
$i=0;
echo "<p>Cantidad Solicitada: $auxmonto</p>";
while($auxmonto>0){
	$billetes = cantidad($auxmonto,$cortes[$i]);
	$auxmonto=$auxmonto - $cortes[$i]*$billetes;
	echo "<p>Numero de billetes de ".$cortes[$i].": $billetes</p>";
	$i++;
}

function cantidad($monto,$corte){
    $cantidad = intval($monto/$corte);
    return $cantidad;
}
?>