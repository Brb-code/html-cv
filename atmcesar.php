<?php
$monto = 850;
$cortes= array(200,100,50,20,10);
$cantidad_billetes= array(200=>10,100=>10,50=>10, 20=>10,10=>10);
//print_r($cantidad_billetes);
/* validacion1 monto acorde cortes */
$ind=count($cortes);
if(($monto%$cortes[$ind-1])==0){
	$aux_total = 0;
	/* totalizamos el saldo del cajero automatico */
	foreach ($cantidad_billetes as $clave => $valor){
		$aux_total+=$clave*$valor;
	}
	/* verificamos que el monto solicitado sea menor al saldo del cajero */
	if($aux_total>=$monto){
		$auxmonto=$monto;
		$i=0;
		echo "<p>Cantidad Solicitada: $auxmonto</p>";
		$monto_calculado = 0;
		while($auxmonto>0){
			$billetes = cantidad($auxmonto,$cortes[$i]);
			/*verificamos que la cantidad de billetes sea menos a la cantidad existente en el cajero */
			if ($billetes >=$cantidad_billetes[$cortes[$i]]){
				$billetes=$cantidad_billetes[$cortes[$i]];
			}
			$auxmonto=$auxmonto - $cortes[$i]*$billetes;
			$monto_calculado += $cortes[$i]*$billetes;
			echo "<p>Numero de billetes de ".$cortes[$i].": $billetes</p>";
			
			$i++;
		}
	}
}else{
	echo "Monto errado";
}

function cantidad($monto,$corte){
    $cantidad = intval($monto/$corte);
    return $cantidad;
}
?>