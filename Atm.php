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
                    
                    //Validar que el monto entregado sea igual al monto solicitado
            
                } else {
                    echo "No se cuenta con el monto solicitado.";
                }
            } else {
                echo "El monto solicitado no está acorde a los cortes disponibles."
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

    $atmCamacho = new Atm();
    echo "El ATM de la Av. Camacho tiene un saldo de: ".$atmCamacho->saldoTotal();
    echo "El ATM de la Av. Camacho en billetes de bs.- 100 tiene un sado de: ".$atmCamacho->saldoxBillete(100);