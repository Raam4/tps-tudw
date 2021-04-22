<?php
    class Producto{
        /** */
        private $codigo;
        private $costo;
        private $anioFabric;
        private $descripcion;
        private $porcIncAnual;
        private $activo;
        //Constructor
        public function __construct($codigo, $costo, $anioFabric, $descripcion, $porcIncAnual, $activo){
            $this->codigo = $codigo;
            $this->costo = $costo;
            $this->anioFabric = $anioFabric;
            $this->descripcion = $descripcion;
            $this->porcIncAnual = $porcIncAnual;
            $this->activo = $activo;
        }
        //Modificadoras
        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }
        public function setCosto($costo){
            $this->costo = $costo;
        }
        public function setAnioFabric($anioFabric){
            $this->anioFabric = $anioFabric;
        }
        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }
        public function setPorcIncAnual($porcIncAnual){
            $this->porcIncAnual = $porcIncAnual;
        }
        public function setActivo($activo){
            $this->activo = $activo;
        }
        //Observadoras
        public function getCodigo(){
            return $this->codigo;
        }
        public function getCosto(){
            return $this->costo;
        }
        public function getAnioFabric(){
            return $this->anioFabric;
        }
        public function getDescripcion(){
            return $this->descripcion;
        }
        public function getPorcIncAnual(){
            return $this->porcIncAnual;
        }
        public function getActivo(){
            return $this->activo;
        }
        //Metodos
        public function __toString(){
            return "\nCodigo: ".$this->codigo.
                   "\nCosto : $".$this->costo.
                   "\nAnio de Fab.: ".$this->anioFabric.
                   "\nDescripcion: ".$this->descripcion.
                   "\n% de Incremento Anual: ".$this->porcIncAnual.
                   "\nActivo: ".$this->activo;
        }

        public function darPrecioVenta(){
            $y = getdate();
            $anio = $y['year'] - $this->anioFabric;
            $porc = 1 + ($this->porcIncAnual / 100);
            if($this->activo){
                $venta = $this->costo + $this->costo * ($anio * $porc);
            }else{
                $venta = -1;
            }
            return $venta;
        }
    }
?>