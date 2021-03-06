<?php

include "Persona.php";

    class CuentaBancaria{
        private $numCuenta;
        private $cliente;
        private $saldoActual;
        private $interesAnual;

        public function __construct($numCuenta, $cliente, $saldoActual, $interesAnual){
            $this->numCuenta = $numCuenta;
            $this->cliente = $cliente;
            $this->saldoActual = $saldoActual;
            $this->interesAnual = $interesAnual;
        }
        public function getNumCuenta(){
            return $this->numCuenta;
        }
        public function getCliente(){
            return $this->cliente = $cliente;
        }
        public function getSaldoActual(){
            return $this->saldoActual;
        }
        public function getInteresAnual(){
            return $this->interesAnual;
        }
        public function setNumCuenta($numCuenta){
            $this->numCuenta = $numCuenta;
        }
        public function setCliente($cliente){
            $this->cliente = $cliente;
        }
        public function setSaldoActual($saldoActual){
            $this->saldoActual = $saldoActual;
        }
        public function setInteresAnual($interesAnual){
            $this->interesAnual = $interesAnual;
        }

        public function __toString(){
            return "\nNumero de cuenta: ".$this->numCuenta."\n 
                    Cliente: ".$this->cliente."\n 
                    Saldo Actual: ".$this->saldoActual."\n 
                    Interes Anual: ".$this->interesAnual;
        }

        public function actualizarSaldo(){
            $this->saldoActual -= ($this->interesAnual / 365) * $this->saldoActual;
        }

        public function depositar($cant){
            $this->saldoActual += $cant;
        }

        public function retirar($cant){
            if($cant <= $this->saldoActual){
                $this->saldoActual -= $cant;
                return "Retira: $".$cant.".- Saldo restante: $".$this->saldoActual.".-";
            }else{
                return "El saldo es insuficiente.";
            }
        }
    }
?>