<?php
class Rubro{
    //Atributos
    private $descripcion;
    private $porcGanancia;
    //Constructor
    public function __construct($descripcion, $porcGanancia){
        $this->descripcion = $descripcion;
        $this->porcGanancia = $porcGanancia;
    }
    //Modificadores y Observadores
    public function getDescripcion(){
        return $this->descripcion;
    }
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    public function getPorcGanancia(){
        return $this->porcGanancia;
    }
    public function setPorcGanancia($porcGanancia){
        $this->porcGanancia = $porcGanancia;
    }
    //Metodos
    public function __toString(){
        return "\nDescripcion: ".$this->descripcion.
               "\nPorcentaje de Ganancia: ".$this->porcGanancia;
    }
}
?>