<?php
include "Rubro.php";
class Producto{
    //Atributos
    private $codBarra;
    private $descripcion;
    private $stock;
    private $iva;
    private $costo;
    private $objRubro;
    //Constructor
    public function __construct($codBarra, $descripcion, $stock, $iva, $costo, $objRubro){
        $this->codBarra = $codBarra;
        $this->descripcion = $descripcion;
        $this->stock = $stock;
        $this->iva = $iva;
        $this->costo = $costo;
        $this->objRubro = $objRubro;
    }
    //Observadores y Modificadores
    public function getCodBarra(){
        return $this->codBarra;
    }
    public function setCodBarra($codBarra){
        $this->codBarra = $codBarra;
    }
    public function getDescripcion(){
        return $this->descripcion;
    }
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    public function getStock(){
        return $this->stock;
    }
    public function setStock($stock){
        $this->stock = $stock;
    }
    public function getIva(){
        return $this->iva;
    }
    public function setIva($iva){
        $this->iva = $iva;
    }
    public function getCosto(){
        return $this->costo;
    }
    public function setCosto($costo){
        $this->costo = $costo;
    }
    public function getObjRubro(){
        return $this->objRubro;
    }
    public function setObjRubro($objRubro){
        $this->objRubro = $objRubro;
    }
    //Metodos
    public function __toString(){
        return "\nCodigo de Barra:".$this->codBarra.
               "\nDescripcion: ".$this->descripcion.
               "\nStock: ".$this->stock.
               "\nIVA: ".$this->iva.
               "\nCosto: ".$this->costo.
               "\nRubro: ".$this->objRubro;
    }

    public function darPrecioVenta(){
        $rubro = $this->getObjRubro();
        $porcGanancia = ($rubro->getPorcGanancia() / 100) + 1;
        $costo = $this->getCosto();
        $iva = ($this->getIva() / 100) + 1;
        $precioVenta = $costo * $porcGanancia * $iva;
        return $precioVenta;
    }
}
?>