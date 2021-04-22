<?php
include "Cliente.php";
include "Producto.php";
    class Venta{
        /**
         * 
         */
        private $numero;
        private $fecha;
        private $cliente;
        private $colProductos;
        private $precioFinal;
        //Constructor
        public function __construct($numero, $fecha, $cliente, $colProductos, $precioFinal){
            $this->numero = $numero;
            $this->fecha = $fecha;
            $this->cliente = $cliente;
            $this->colProductos = $colProductos;
            $this->precioFinal = $precioFinal;
        }
        //Modificadoras
        public function setNumero($numero){
            $this->numero = $numero;
        }
        public function setFecha($fecha){
            $this->fecha = $fecha;
        }
        public function setCliente($cliente){
            $this->cliente = $cliente;
        }
        public function setColProductos($colProductos){
            $this->colProductos = $colProductos;
        }
        public function setPrecioFinal($precioFinal){
            $this->precioFinal = $precioFinal;
        }
        //Observadoras
        public function getNumero(){
            return $this->numero;
        }
        public function getFecha(){
            return $this->fecha;
        }
        public function getCliente(){
            return $this->cliente;
        }
        public function getColProductos(){
            return $this->colProductos;
        }
        public function getPrecioFinal(){
            return $this->precioFinal;
        }
        //Metodos
        public function __toString(){
            return "\nNumero: ".$this->venta.
                   "\nFecha: ".$this->fecha.
                   "\nCliente: ".$this->cliente.
                   "\nProductos: ".$this->colProductos.
                   "\nPrecio Final: $".$this->precioFinal;
            ;
        }

        public function incorporarProducto($objProducto){
            $i = count($this->colProductos);
            $price = $objProducto->darPrecioVenta();
            if((0<=$price)){
                $this->colProductos[$i] = $objProducto;
                $this->precioFinal += $price;
                echo "Producto ".$objProducto->getCodigo()." y precio agregados. ";
            }else{
                echo "El producto ".$objProducto->getCodigo()." no está disponible. ";
            }
        }
    }
?>