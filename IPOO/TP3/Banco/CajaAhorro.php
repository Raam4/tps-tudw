<?php
include_once "Cuenta.php";

    class CajaAhorro extends Cuenta{
        
        public function __construct($numCuenta, $cliente, $interesAnual){
            parent::__construct($numCuenta, $cliente, $interesAnual);
        }
        public function __toString(){
            $pstr = parent::__toString();
            return "\n---------------------".
                   "\nTipo: Caja de Ahorro".$pstr;
        }
    }
?>