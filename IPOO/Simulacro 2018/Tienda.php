<?php
include "Venta.php";
class Tienda{
    //Atributos
    private $nombre;
    private $direccion;
    private $telefono;
    private $colObjProducto;
    private $colObjVenta;
    //Constructor
    public function __construct($nombre, $direccion, $telefono, $colObjProducto, $colObjVenta){
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->colObjProducto = $colObjProducto;
        $this->colObjVenta = $colObjVenta;
    }
    //Modificadores
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }
    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }
    public function setColObjProducto($colObjProducto){
        $this->colObjProducto = $colObjProducto;
    }
    public function setColObjVenta($colObjVenta){
        $this->colObjVenta = $colObjVenta;
    }
    //Observadores
    public function getNombre(){
        return $this->nombre;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function getColObjProducto(){
        return $this->colObjProducto;
    }
    public function getColObjVenta(){
        return $this->colObjVenta;
    }
    //Metodos
    private function colToStr($col){
        $str = "";
        foreach($col as $key){
            $str .= $key;
        }
        return $str;
    }

    public function __toString(){
        $strProducto = $this->colToStr($this->colObjProducto);
        $strVenta = $this->colToStr($this->colObjVenta);
        return "\nNombre: ".$this->nombre.
               "\nDireccion: ".$this->direccion.
               "\nTelefono: ".$this->telefono.
               "\nProductos: ".$strProducto.
               "\nVentas: ".$strVenta;
    }

    public function buscarProducto($codBarra){
        $objProducto = null;
        foreach($this->getColObjProducto() as $key){
            if($key->getCodBarra() == $codBarra){
                $objProducto = $key;
                break;
            }
        }
        return $objProducto;
    }

    public function realizarVenta($array){
        $objVenta = null;
        $codBarra = $array["codigoBarra"];
        $cant = $array["cantidad"];
        $objProducto = $this->buscarProducto($codBarra);
        if(!(is_null($objProducto))){
            if($cant<$objProducto->getStock()){
                $array = array($objProducto, $cant);
                $objVenta = new Venta('19-04-21', 'Consumidor Final', random_int(000, 999), 'C', array());
                $objVenta->incorporarProducto($array);
            }
        }
        return $objVenta;
    }
}
?>