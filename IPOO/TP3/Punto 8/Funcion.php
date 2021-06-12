<?php
    class Funcion{
        /**
        * Atributos
        * String $nombre,
        * array int $horaInicio
        * int $duracion
        * int $precio
        */
        private $nombre;
        private $horaInicio;
        private $duracion;
        private $precio;
        private $incremento;

        //Metodo Constructor
        public function __construct($nombre, $horaInicio, $duracion, $precio){
            $this->nombre = $nombre;
            $this->horaInicio = $horaInicio;
            $this->duracion = $duracion;
            $this->precio = $precio;
            $this->incremento = 1.45;
        }
        //Modificadoras
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function setHoraInicio($horaInicio){
            $this->horaInicio = $horaInicio;
        }
        public function setDuracion($duracion){
            $this->duracion = $duracion;
        }
        public function setPrecio($precio){
            $this->precio = $precio;
        }
        public function setIncremento($incremento){
            $this->incremento = $incremento;
        }
        //Observadoras
        public function getNombre(){
            return $this->nombre;
        }
        public function getHoraInicio(){
            return $this->horaInicio;
        }
        public function getDuracion(){
            return $this->duracion;
        }
        public function getPrecio(){
            return $this->precio;
        }
        public function getIncremento(){
            return $this->incremento;
        }
        //Metodos

        /**
         * Formatea la hora de un array con dos elementos a un String tipo HH:mm
         * @param array $arrayHora
         * @return String
         */
        private function format($arrayHora){
            $mins = $arrayHora[1];
            if($mins<10){
                $mins .= "0";
            }
            return $arrayHora[0].":".$mins;
        }

        /**
         * Verifica que el horario de dos funciones no se solapen
         * @param array $horaFunDos
         * @param int $duracionFunDos
         * @return boolean
         */
        public function solap($horaFunDos, $duracionFunDos){
            $iniFunUno = $this->getHoraInicio()[0]*60 + $this->getHoraInicio()[1];
            $finFunUno = $this->getDuracion() + $iniFunUno;
            $iniFunDos = $horaFunDos[0]*60 + $horaFunDos[1];
            $finFunDos = $duracionFunDos + $iniFunDos;
            $var = true;
            if($iniFunUno<$iniFunDos){
                if($finFunUno<=$iniFunDos){
                    $var = false;
                }
            }else{
                if($finFunDos<=$iniFunUno){
                    $var = false;
                }
            }
            return $var;
        }

        public function __toString(){
            $hr = $this->format($this->horaInicio);
            return "\nNombre de la función: ".$this->nombre.
                   "\nHora de inicio: ".$hr." hs.".
                   "\nDuración: ".$this->duracion." minutos".
                   "\nPrecio: $".$this->precio;
                   "\n% de incremento: ".$incremento;
        }
    }
?>