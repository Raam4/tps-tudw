<?php
include "Venta.php";
class VentaOnline extends Venta{
    //Atributos
    private $porcentajeDescuento;
    //Constructor
    public function __construct($fecha, $objPaqueteTuristico, $cantPersonas, $cliente){
        parent::__construct($fecha, $objPaqueteTuristico, $cantPersonas, $cliente);
        $this->porcentajeDescuento = 20;
    }
    //Modificadores y Observadores
    public function getPorcentajeDescuento(){
        return $this->porcentajeDescuento;
    }
    public function setPorcentajeDescuento($porcentajeDescuento){
        $this->porcentajeDescuento = $porcentajeDescuento;
    }
    //Metodos
    public function __toString(){
        $str = parent::__toString();
        return $str."\nPorcentaje de Descuento: ".$this->porcentajeDescuento;
    }

    public function darImporteVenta(){
        $importe = parent::darImporteVenta();
        $importe -= ($importe * ($porcentajeDescuento / 100));
        return $importe;
    }
}
?>