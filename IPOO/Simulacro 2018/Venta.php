<?php
include "Item.php";
class Venta{
    //Atributos
    private $fecha;
    private $denomCliente;
    private $numFac;
    private $tipFac;
    private $colObjItem;
    //Constructor
    public function __construct($fecha, $denomCliente, $numFac, $tipFac, $colObjItem){
        $this->fecha = $fecha;
        $this->denomCliente = $denomCliente;
        $this->numFac = $numFac;
        $this->tipFac = $tipFac;
        $this->colObjItem = $colObjItem;
    }
    //Modificadores
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }
    public function setDenomCliente($denomCliente){
        $this->denomCliente = $denomCliente;
    }
    public function setNumFac($numFac){
        $this->numFac = $numFac;
    }
    public function setTipFac($tipFac){
        $this->tipFac = $tipFac;
    }
    public function setColObjItem($colObjItem){
        $this->colObjItem = $colObjItem;
    }
    //Observadores
    public function getFecha(){
        return $this->fecha;
    }
    public function getDenomCliente(){
        return $this->denomCliente;
    }
    public function getNumFac(){
        return $this->numFac;
    }
    public function getTipFac(){
        return $this->tipFac;
    }
    public function getColObjItem(){
        return $this->colObjItem;
    }
    //Metodos
    private function colToStr(){
        $str = "";
        foreach($this->getColObjItem() as $key){
            $str .= $key;
        }
    }

    public function __toString(){
        $str = $this->colToStr();
        return "\nFecha: ".$this->fecha.
               "\nCliente: ".$this->cliente.
               "\nTipo y nro. factura: ".$this->$tipFac." ".$this->numFac.
               "\nItems: ".$str;
    }

    public function incorporarProducto($objProducto, $cant){
        $venta = false;
        $stock = $objProducto->getStock();
        if($cant<$stock){
            $items = $this->getColObjItem();
            $i = count($items);
            $objItem = new Item($cant, $objProducto);
            $items[$i] = $objItem;
            $this->setColObjItem($items);
            $objProducto->actualizarStock($cant);
            $venta = true;
        }
        return $venta;
    }
}
?>