<?php
    class Cliente{
        /**
         * String $nombre, $apellido, $tipoDoc
         * boolean $status
         * int $nroDoc
         */
        private $nombre;
        private $apellido;
        private $status;
        private $tipoDoc;
        private $nroDoc;
        //Constructor
        public function __construct($nombre, $apellido, $estado, $tipoDoc, $nroDoc){
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->estado = $estado;
            $this->tipoDoc = $tipoDoc;
            $this->nroDoc = $nroDoc;
        }
        //Modificadoras
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function setApellido($apellido){
            $this->apellido = $apellido;
        }
        public function setEstado($estado){
            $this->estado = $estado;
        }
        public function setTipoDoc($tipoDoc){
            $this->tipoDoc = $tipoDoc;
        }
        public function setNroDoc($nroDoc){
            $this->nroDoc = $nroDoc;
        }
        //Obvervadoras
        public function getNombre(){
            return $this->nombre;
        }
        public function getApellido(){
            return $this->apellido;
        }
        public function getEstado(){
            return $this->estado;
        }
        public function getTipoDoc(){
            return $this->tipoDoc;
        }
        public function getNroDoc(){
            return $this->nroDoc;
        }
        //Metodos
        public function __toString(){
            return "\nNombre y apellido: ".$this->nombre." ".$this->apellido.
                   "\nActivo: ".$this->estado.
                   "\nTipo y Nro de Documento: ".$this->tipoDoc." ".$this->nroDoc;
        }
    }
?>