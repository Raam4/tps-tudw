<?php
class Persona{
    //Atributos
    private $tipoDoc;
    private $nroDoc;
    private $nombre;
    private $apellido;
    private $telefono;
    //Constructor
    public function __construct($tipoDoc, $nroDoc, $nombre, $apellido, $telefono){
        $this->tipoDoc = $tipoDoc;
        $this->nroDoc = $nroDoc;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->telefono = $telefono;
    }
    //Modificadores
    public function setTipoDoc($tipoDoc){
        $this->tipoDoc = $tipoDoc;
    }
    public function setNroDoc($nroDoc){
        $this->nroDoc = $nroDoc;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setApellido($apellido){
        $this->apellido = $apellido;
    }
    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }
    //Observadores
    public function getTipoDoc(){
        return $this->tipoDoc;
    }
    public function getNroDoc(){
        return $this->nroDoc;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    //Metodos
    public function __toString(){
        return "\nTipo y Nro de Documento: ".$this->tipoDoc." ".$this->nroDoc.
               "\nNombre y Apellido: ".$this->nombre." ".$this->apellido.
               "\nTelefono de Contacto: ".$this->telefono;
    }
}
?>