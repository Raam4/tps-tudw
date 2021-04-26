<?php
class Venta{
    //Atributos
    private $fecha;
    private $objPaqueteTuristico;
    private $cantPersonas;
    private $cliente;
    //Constructor
    public function __construct($fecha, $objPaqueteTuristico, $cantPersonas, $cliente){
        $this->fecha = $fecha;
        $this->objPaqueteTuristico = $objPaqueteTuristico;
        $this->cantPersonas = $cantPersonas;
        $this->cliente = $cliente;
    }
    //Observadores y Modificadores
    public function getFecha(){
        return $this->fecha;
    }
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }
    public function getObjPaqueteTuristico(){
        return $this->objPaqueteTuristico;
    }
    public function setObjPaqueteTuristico($objPaqueteTuristico){
        $this->objPaqueteTuristico = $objPaqueteTuristico;
    }
    public function getCantPersonas(){
        return $this->cantPersonas;
    }
    public function setCantPersonas($cantPersonas){
        $this->cantPersonas = $cantPersonas;
    }
    public function getCliente(){
        return $this->cliente;
    }
    public function setCliente($cliente){
        $this->cliente = $cliente;
    }
    //Metodos
    public function __toString(){
        return "\nFecha: ".$this->fecha.
               "\nPaquete Turistico: ".$this->objPaqueteTuristico.
               "\nCantidad de Personas: ".$this->cantPersonas.
               "\nCliente: ".$this->cliente;
    }
}
?>