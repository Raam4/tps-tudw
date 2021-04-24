<?php
class Regional extends Producto{
    //Atributos
    private $porcDescuento;
    //Constructor
    public function __construct($codBarra, $descripcion, $stock, $iva, $costo, $objRubro, $porcDescuento){
        parent :: __construct($codBarra, $descripcion, $stock, $iva, $costo, $objRubro);
        $this->porcDescuento = $porcDescuento;
    }
    //Observadores y Modificadores
    public function getPorcDescuento(){
        return $this->porcDescuento;
    }
    public function setPorcDescuento($porcDescuento){
        $this->porcDescuento = $porcDescuento;
    }
    //Metodos
    public function __toString(){
        $str = parent::__toString();
        return $str."\n Porcentaje de Descuento: ".$this->porcDescuento."%";
    }

    public function darPrecioVenta(){
        $rubro = $this->getObjRubro();
        $porcGanancia = ($rubro->getPorcGanancia() / 100) + 1;
        $costo = $this->getCosto();
        $iva = ($this->getIva() / 100) + 1;
        $precioVenta = $costo * $porcGanancia * $iva;
        $porcDescuento = $this->getPorcDescuento() / 100;
        $precioVenta -= $precioVenta * $porcDescuento;
        return $precioVenta;
    }
}
?>