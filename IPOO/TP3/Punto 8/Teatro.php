<?php
include 'Funcion.php';
    class Teatro{
        /**
        * Atributos
        * string $nombre, $direccion
        * array de obj Funcion $colObjFuncion
        */
        private $nombre;
        private $direccion;
        private $colObjFuncion;

        //Constructor
        public function __construct($nombre, $direccion, $colObjFuncion){
            $this->nombre = $nombre;
            $this->direccion = $direccion;
            $this->colObjFuncion = $colObjFuncion;
        }
        //Observadoras
        public function getNombre(){
            return $this->nombre;
        }
        public function getDireccion(){
            return $this->direccion;
        }
        public function getColObjFuncion(){
            return $this->colObjFuncion;
        }
        //Modificadoras
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function setDireccion($direccion){
            $this->direccion = $direccion;
        }
        public function setColObjFuncion($colObjFuncion){
            $this->colObjFuncion = $colObjFuncion;
        }
        //Metodos
        
        /**
         * Formatea cada elemento de la colección en un String
         * @param array $colFunc
         * @return String
         */
        public function strColFun(){
            $colFunc = $this->getColObjFuncion();
            $str = "";
            for($i=0; $i<count($colFunc); $i++){
                $str .= "Función ".($i+1)."\n".$colFunc[$i]."\n";
            }
            return "\nFunciones\n".$str;
        }

        public function darCostos(){
            $fns = $this->getColObjFuncion();
            $total = 0;
            foreach($fns as $key){
                $total += ($key.getPrecio() * $key.getIncremento());
            }
            return $total;
        }


        public function __toString(){
            $arrayToString = $this->strColFun();
            return "Nombre del Teatro: ".$this->nombre.
                   "\nDirección: ".$this->direccion.$arrayToString;
        }
    }
?>