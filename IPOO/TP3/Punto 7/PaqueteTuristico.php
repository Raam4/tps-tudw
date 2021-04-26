<?php
class PaqueteTuristico{
    //Atributos
    private $fechaDesde;
    private $cantDias;
    private $objDestino;
    private $totalPlazas;
    private $plazasDisp;
    //Constructor
    public function __construct($fechaDesde, $cantDias, $objDestino, $totalPlazas)
    {
        $this->fechaDesde = $fechaDesde;
        $this->cantDias = $cantDias;
        $this->objDestino = $objDestino;
        $this->totalPlazas = $totalPlazas;
        $this->plazasDisp = $totalPlazas;
    }
    //Observadores y Modificadores
    public function getFechaDesde(){
        return $this->fechaDesde;
    }
    public function setFechaDesde($fechaDesde){
        $this->fechaDesde = $fechaDesde;
    }
    public function getCantDias(){
        return $this->cantDias;
    }
    public function setCantDias($cantDias){
        $this->cantDias = $cantDias;
    }
    public function getObjDestino(){
        return $this->objDestino;
    }
    public function setObjDestino($objDestino){
        $this->objDestino = $objDestino;
    }
    public function getTotalPlazas(){
        return $this->totalPlazas;
    }
    public function setTotalPlazas($totalPlazas){
        $this->totalPlazas = $totalPlazas;
    }
    public function getPlazasDisp(){
        return $this->plazasDisp;
    }
    public function setPlazasDisp($plazasDisp){
        $this->plazasDisp = $plazasDisp;
    }
    //Metodos
    public function __toString(){
        return "\nFecha Desde:".$this->fechaDesde.
               "\nCantidad de días: ".$this->cantDias.
               "\nDestino: ".$this->objDestino.
               "\nTotal de Plazas: ".$this->totalPlazas.
               "\nPlazas Disponibles: ".$this->plazasDisp;
    }
}
?>