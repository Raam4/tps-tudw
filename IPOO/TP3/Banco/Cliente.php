<?php
include "../TP2/Persona.php";
    class Cliente extends Persona{
        private $nroCliente;

        public function __construct($nroCliente, $nombre, $apellido, $tipoDoc, $numeroDoc){
            $this -> nroCliente = $nroCliente;
            parent::__construct($nombre, $apellido, $tipoDoc, $numeroDoc);
        }
        public function setNroCliente($nroCliente){
            $this->nroCliente = $nroCliente;
        }
        public function getNroCliente(){
            return $this->nroCliente;
        }

        public function __toString(){
            $str = parent::__toString();
            return "\n-------------------------".
                   "\nNro Cliente: ".$this->nroCliente.$str;
        }
    }
?>