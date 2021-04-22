<?php
include "Venta.php";
    class Empresa{
        private $denominacion;
        private $direccion;
        private $colCliente;
        private $colProducto;
        private $colVenta;
        //Constructor
        public function __construct($denominacion, $direccion, $colCliente, $colProducto, $colVenta){
            $this->denominacion = $denominacion;
            $this->direccion = $direccion;
            $this->colCliente = $colCliente;
            $this->colProducto = $colProducto;
            $this->colVenta = $colVenta;
        }
        //Modificadoras
        public function setDenominacion($denominacion){
            $this->denominacion = $denominacion;
        }
        public function setDireccion($direccion){
            $this->direccion = $direccion;
        }
        public function setColCliente($colCliente){
            $this->colCliente = $colCliente;
        }
        public function setColProducto($colProducto){
            $this->colProducto = $colProducto;
        }
        public function setColVenta($colVenta){
            $this->colVenta = $colVenta;
        }
        //Observadoras
        public function getDenominacion(){
            return $this->denominacion;
        }
        public function getDireccion(){
            return $this->direccion;
        }
        public function getColCliente(){
            return $this->colCliente;
        }
        public function getColProducto(){
            return $this->colProducto;
        }
        public function getColVenta(){
            return $this->colVenta;
        }
        //Metodos
        public function __toString(){
            $clientes = "";
            $productos = "";
            $ventas = "";
            foreach($this->colCliente as $key){
                $clientes .= $key;
            }
            foreach($this->colProducto as $key){
                $productos .= $key;
            }
            foreach($this->colVenta as $key){
                $ventas .= $key;
            }
            return "\nDenominacion: ".$this->denominacion.
                   "\nDireccion: ".$this->direccion.
                   "\nClientes: ".$clientes.
                   "\nProductos: ".$productos.
                   "\nVentas: ".$ventas;
        }

        public function retornarProducto($codigoProducto){
            $i = count($this->colProducto);
            $producto = null;
            foreach($this->colProducto as $key){
                if($key->getCodigo() == $codigoProducto){
                    $producto = $key;
                    break;
                }
            }
            return $producto;
        }

        public function registrarVenta($colCodigosProductos, $objCliente){
            $objVenta = null;
            if(!($objCliente->getEstado())){
                echo "El cliente está dado de baja";
            }else{
                $nroVta = random_int(0, 99999);
                $colProducto = array();
                $objVenta = new Venta($nroVta, date('d-m-Y'), $objCliente, $colProducto, 0);
                foreach($colCodigosProductos as $key){
                    $producto = $this->retornarProducto($key);
                    if(is_null($producto)){
                        echo "El producto ".$key." no existe.";
                        break;
                    }else{
                        $objVenta->incorporarProducto($producto);
                    }
                }
            }
            return $objVenta->getPrecioFinal();
        }

        public function retornarVentasXCliente($tipo, $numDoc){
            $objCliente = null;
            for($i=0; $i<count($this->colCliente); $i++){
                $comp = $this->colCliente[$i];
                if($tipo == $comp->getTipoDoc() and $numDoc == $comp->getNroDoc()){
                    $objCliente = $comp;
                    break;
                }
            }
            if(is_null($objCliente)){
                echo "El cliente no existe";
            }else{
                $j=0;
                $vtasXCliente = array();
                for($i=0; $i<count($this->colVenta); $i++){
                    $objVenta = $this->colVenta[$i];
                    if($objCliente == $objVenta->getCliente()){
                        $vtasXCliente[$j] = $objVenta;
                        $j++;
                    }
                }
            }
            return $vtasXCliente;
        }
    }
?>