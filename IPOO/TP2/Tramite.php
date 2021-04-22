<?php
    class Tramite{
        private $tipo;
        private $cliente;
        private $fechaHoraIn;
        private $fechaHoraOut;

        public function __construct($tipo, $cliente, $fechaHoraIn, $fechaHoraOut){
            $this->tipo = $tipo;
            $this->cliente = $cliente;
            $this->fechaHoraIn = $fechaHoraIn;
            $this->fechaHoraOut = $fechaHoraOut;
        }
        public function getTipo(){
            return $this->tipo;
        }
        public function getCliente(){
            return $this->cliente;
        }
        public function getFechaHoraIn(){
            return $this->fechaHoraIn;
        }
        public function getFechaHoraOut(){
            return $this->fechaHoraOut;
        }
        public function setTipo($tipo){
            $this->tipo = $tipo;
        }
        public function setCliente($cliente){
            $this->cliente = $cliente;
        }
        public function setFechaHoraIn($fechaIn){
            $this->fechaHoraIn = $fechaHoraIn;
        }
        public function setFechaHoraOut($fechaHoraOut){
            $this->fechaHoraOut = $fechaHoraOut;
        }

    }
?>