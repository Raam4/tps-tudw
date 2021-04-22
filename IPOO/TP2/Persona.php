<?php
class Persona{
    private $nombre;
    private $apellido;
    private $tipoDoc;
    private $numeroDoc;

    public function __construct($fn, $ln, $tDoc, $nDoc){
        $this -> nombre = $fn;
        $this -> apellido = $ln;
        $this -> tipoDoc = $tDoc;
        $this -> numeroDoc = $nDoc;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getTipoDoc(){
        return $this->tipoDoc;
    }
    public function getNumeroDoc(){
        return $this->numeroDoc;
    }
    public function __toString(){
        return "\nNombre: ".$this->nombre."\nApellido: ".$this->apellido."\nTipo y Número de Documento: ".$this->tipoDoc." ".$this->numeroDoc;
    }
}
?>