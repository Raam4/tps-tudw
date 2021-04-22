<?php
    class Cliente{
        private $persona;
        private $tipoTramite;
        private $mostAsign;

        public function __construct($persona, $tramite, $mostAsign){
            $this->persona = $persona;
            $this->tipoTramite = $tipoTramite;
            $this->mostAsign = $mostAsign;
        }
        public function setPersona($persona){
            $this->persona = $persona;
        }
        public function setTipoTramite($tipotramite){
            $this->tipoTramite = $tipoTramite;
        }
        public function setMostAsign($mostAsign){
            $this->mostAsing = $mostAsign;
        }
        public function getPersona(){
            return $this->persona;
        }
        public function getTipoTramite(){
            return $this->tipoTramite;
        }
        public function getMostAsign(){
            return $this->mostAsign;
        }


    }
?>