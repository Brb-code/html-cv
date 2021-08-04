<?php
    class Atm {
        var $cortes;
        var $cantidades;
        function Atm(){
            $this->cortes = array(200, 100, 50, 20, 10);
            $this->cantidades = array(200=>0,100=>2,50=>1,20=>0,10=>0);            
        }
        function saldoTotal(){
            //Giussepe
            $saldo = 0;
            foreach ($this->cantidades as $key => $value) {
                $saldo = $saldo + ($value * $key);
            }
            return $saldo;
        }
        function saldoxBillete($corte){
            $saldo = $this->cantidades[$corte]*$corte;
            return $saldo;
        }
        function retiro($monto){
            //Validar que el monto esté acorde a los cortes
            if($this->validaMonto($monto)){
                if($this->validaMontoSaldo($monto)){
                    //Generando cortes a distribuir.
                    //Generar retiro
                    $entregaBilletes = array();
                    $indiceCortes = 0;
                    $montoTmp = $monto;
                    while($montoTmp>0 && $indiceCortes < count($this->cortes)){
                        $cntOptima = (int)($montoTmp/$this->cortes[$indiceCortes]);
                        // validar que cuento con la cntOptima de billetes
                        if($this->cantidades[$this->cortes[$indiceCortes]] < $cntOptima) {
                            $cntOptima = $this->cantidades[$this->cortes[$indiceCortes]];
                        }
                        
                        $montoTmp = $montoTmp - ($cntOptima * $this->cortes[$indiceCortes]);
                        //Insertando datos en vector con indice correlativo incremental 0, 1, 2, 3
                        //$entregaBilletes[] = $cntOptima;
                        //Resultado => (2, 1, 0, 0, 0)
                        //EJ. Insertando datos en vector con indice personalizado
                        $entregaBilletes[ $this->cortes[$indiceCortes] ] = $cntOptima;
                        //Resultado => (200=>2, 100=>1, 50=>0, 20=>0, 10=>0)
                        $indiceCortes = $indiceCortes + 1;
                    }
                    if($montoTmp==0){
                        // Reducir la cantidad de billetes en el ATM
                        // a entregar $entregaBilletes >>>>> (200=>1, 100=>2, 50=>0, 20=>1, 10=>0)
                        // en el ATM $cantidades >>>>> (200=>10, 100=>21, 50=>10, 20=>1, 10=>100)
                        foreach ($entregaBilletes as $corte => $cantidad) {
                            $this->cantidades[$corte] = $this->cantidades[$corte] - $cantidad;
                        }  
                        return $entregaBilletes;
                    } else {
                        return "No se cuenta con el monto solicitado en los cortes.";
                    }            
                } else {
                    return "No se cuenta con el monto solicitado.";
                }
            } else {
                return "El monto solicitado no está acorde a los cortes disponibles.";
            }
            //Validar que el monto sea menor o igual al saldo del ATM
        }
        function validaMonto($montoSolicitado){
            $corte_minimo=9999999999;
            foreach($this->cortes as $valor){
                if($corte_minimo>$valor) $corte_minimo=$valor;
            }
            if(($montoSolicitado%$corte_minimo)==0){
                return true;
            }else{
                return false;
            }
        }
        function validaMontoSaldo($montoSolicitado){
            //Giussepe
            if($this->saldoTotal()>=$montoSolicitado){
                $montoTmp = $montoSolicitado;
                $i = 0;
                while($montoTmp>=0 && $i<count($this->cortes)){
                    $cntBilletes = (int)($montoTmp/$this->cortes[$i]);
                    if($cntBilletes>$this->cantidades[$this->cortes[$i]]) {
                        $cntBilletes = $this->cantidades[$this->cortes[$i]];
                    }
                    $montoTmp = $montoTmp-($cntBilletes*$this->cortes[$i]);
                    $i = $i + 1;
                }
                return $montoTmp==0;
            } else return false;            
        }
    }
?>