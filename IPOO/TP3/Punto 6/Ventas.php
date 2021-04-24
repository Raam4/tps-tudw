<?php
class Ventas{
    //Atributos
    private $fecha;
    private $colObjProducto;
    private $cliente;
    private $importeFinal;
    //Constructor
    public function __construct($fecha, $colObjProducto, $cliente){
        $this->fecha = $fecha;
        $this->colObjProducto = $colObjProducto;
        $this->cliente = $cliente;
        $this->importeFinal = self::calcImporteFinal($colObjProducto);
    }
    //Observadores y Modificadores
    public function getFecha(){
        return $this->fecha;
    }
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }
    public function getColObjProducto(){
        return $this->colObjProducto;
    }
    public function setColObjProducto($colObjProducto){
        $this->colObjProducto = $colObjProducto;
    }
    public function getCliente(){
        return $this->cliente;
    }
    public function setCliente($cliente){
        $this->cliente = $cliente;
    }
    public function getImporteFinal(){
        return $this->importeFinal;
    }
    public function setImporteFinal($importeFinal){
        $this->importeFinal = $importeFinal;
    }
    //Metodos
    public function __toString(){
        return "";
    }

    private static function calcImporteFinal($colObjProducto){
        $venta = 0;
        foreach($colObjProducto as $key){
            $venta += $key->darPrecioVenta();
        }
        return $venta;
    }
}
?>