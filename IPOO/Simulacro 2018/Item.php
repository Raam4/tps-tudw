<?php
include "Producto.php";
class Item{
    //Atributos
    private $cantVendida;
    private $objProducto;
    //Constructor
    public function __construct($cantVendida, $objProducto){
        $this->cantVendida = $cantVendida;
        $this->objProducto = $objProducto;
    }
    //Modificadores
    public function setCantVendida($cantVendida){
        $this->cantVendida = $cantVendida;
    }
    public function setObjProducto($objProducto){
        $this->objProducto = $objProducto;
    }
    //Observadores
    public function getCantVendida(){
        return $this->cantVendida;
    }
    public function getObjProducto(){
        return $this->objProducto;
    }
    //Metodos
    public function __toString(){
        return "\nProducto: ".$this->objProducto.
               "\nCantidad Vendida: ".$this->cantVendida; 
    }
}
?>