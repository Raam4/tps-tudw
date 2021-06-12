<?php
include "Funcion.php";
class Musical extends Funcion{
    //Atributos
    private $director;
    private $personas;
    //Constructor
    public function __construct($nombre, $horaInicio, $duracion, $precio, $director, $personas){
        parent::__construct($nombre, $horaInicio, $duracion, $precio);
        $this->incremento = 1.12;
        $this->director = $director;
        $this->personas = $personas;
    }
    //Observadores y Modificadores
    public function getDirector(){
        return $this->director;
    }
    public function setDirector($director){
        $this->director = $director;
    }
    public function getPersonas(){
        return $this->personas;
    }
    public function setPersonas($personas){
        $this->personas = $personas;
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
        return $str."\n Director: ".$this->director.
               "\n Personas en Escena: ".$this->personas;
    }
}
?>