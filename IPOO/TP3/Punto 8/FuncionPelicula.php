<?php
include "Funcion.php";
class Pelicula extends Funcion{
    //Atributos
    private $genero;
    private $paisOrigen;
    //Constructor
    public function __construct($nombre, $horaInicio, $duracion, $precio, $genero, $paisOrigen){
        parent::__construct($nombre, $horaInicio, $duracion, $precio);
        $this->incremento = 1.65;
        $this->genero = $genero;
        $this->paisOrigen = $paisOrigen;
    }
    //Observadores y Modificadores
    public function getGenero(){
        return $this->genero;
    }
    public function setGenero($genero){
        $this->genero = $genero;
    }
    public function getPaisOrigen(){
        return $this->paisOrigen;
    }
    public function setPaisOrigen($paisOrigen){
        $this->paisOrigen = $paisOrigen;
    }
    public function getIncremento(){
        return $this->incremento;
    }
    public function setIncremento($incremento){
        $this->incremento = $incremento;
    }
    //Metodos
    public function __toString(){
        $str = parent::__toString();
        return $str."\n Genero: ".$this->genero.
               "\n Pais de Origen: ".$this->paisOrigen;
    }
}
?>