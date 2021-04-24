<?php
include "Producto.php";
class Importado extends Producto{
    //Constructor
    public function __construct($codBarra, $descripcion, $stock, $iva, $costo, $objRubro){
        parent :: __construct($codBarra, $descripcion, $stock, $iva, $costo, $objRubro);
    }
    //Metodos
    public function __toString(){
        return parent::__toString();
    }

    public function darPrecioVenta(){
        $rubro = $this->getObjRubro();
        $porcGanancia = ($rubro->getPorcGanancia() / 100) + 1;
        $costo = $this->getCosto();
        $iva = ($this->getIva() / 100) + 1;
        $precioVenta = $costo * $porcGanancia * $iva;
        $precioVenta = ($precioVenta * 1.50) * 1.10;
        return $precioVenta;
    }
}
?>