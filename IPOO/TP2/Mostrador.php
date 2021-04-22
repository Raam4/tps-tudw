<?php
    class Mostrador{
        private $tramites;
        private $colaMax;
        private $colaActual;

        public function __construct($tramites, $colaMax, $colaActual, $inicio, $fin){
            $this->tramites = $tramites;        //array
            $this->colaMax = $colaMax;          //int
            $this->colaActual = $colaActual;    //int
            $this->inicio = $inicio;            //time
            $this->fin = $fin;                  //time
        }
        public function setTramites($tramites){
            $this->tramites = $tramites;
        }
        public function setColaMax($colaMax){
            $this->colaMax = $colaMax;
        }
        public function setColaActual($colaActual){
            $this->colaActual = $colaActual;
        }
        public function getTramites(){
            return $this->tramites;
        }
        public function getColaMax(){
            return $this->colaMax;
        }
        public function getColaActual(){
            return $this->colaActual;
        }

        public function atiende($unTramite){
            $trams = $this->getTramites();
            $dev = false;
            $i = 0;
            do{
                if($trams[$i] == $unTramite){
                    $dev = true;
                }
                $i++;
            }while(!$dev and $i != count($trams));
            return $dev;
        }

        public function full(){
            return ($this->getColaActual() < $this->getColaMax());
        }
    }
?>