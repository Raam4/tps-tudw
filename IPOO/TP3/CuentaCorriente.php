<?php
include "Cuenta.php";
    class CuentaCorriente extends Cuenta{
        private $limiteGiro;

        public function __construct($numCuenta, $cliente, $saldoActual, $interesAnual, $limiteGiro){
            parent::__construct($numCuenta, $cliente, $saldoActual, $interesAnual);
            $this->limiteGiro = $limiteGiro;
        }
        public function setLimiteGiro($limiteGiro){
            $this->limiteGiro = $limiteGiro;
        }
        public function getLimiteGiro(){
            return $this->limiteGiro;
        }
        public function __toString(){
            $pstr = parent::__toString();
            return "\n------------------------------".
                   "\nTipo: Cuenta Corriente".$pstr."\nLimite de Giro: $".$this->limiteGiro;
        }
    }
?>