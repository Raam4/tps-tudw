<?php
include "Persona.php";
class Inmueble{
    //Atributos
    private $codRef;
    private $nroPiso;
    private $tipo;
    private $costoMensual;
    private $objPersona;
    //Constructor
    public function __construct($codRef, $nroPiso, $tipo, $costoMensual, $objPersona){
        $this->codRef = $codRef;
        $this->nroPiso = $nroPiso;
        $this->tipo = $tipo;
        $this->costoMensual = $costoMensual;
        $this->objPersona = $objPersona;
    }
    //Modificadores
    public function setCodRef($codRef){
        $this->codRef = $codRef;
    }
    public function setNroPiso($nroPiso){
        $this->nroPiso = $nroPiso;
    }
    public function setTipo($tipo){
        $this->tipo = $tipo;
    }
    public function setCostoMensual($costoMensual){
        $this->costoMensual = $costoMensual;
    }
    public function setObjPersona($objPersona){
        $this->objPersona = $objPersona;
    }
    //Observadores
    public function getCodRef(){
        return $this->codRef;
    }
    public function getNroPiso(){
        return $this->nroPiso;
    }
    public function getTipo(){
        return $this->tipo;
    }
    public function getCostoMensual(){
        return $this->costoMensual;
    }
    public function getObjPersona(){
        return $this->objPersona;
    }
    //Metodos
    public function __toString(){
        return "\nCodigo de Referencia: ".$codRef.
               "\nNum. de piso: ".$nroPiso.
               "\nTipo de inmueble: ".$tipo.
               "\nCosto mensual: ".$costoMensual.
               "\nInquilino: ".$objPersona;
    }

    public function alquilarInmueble($objPersona){
        $comp = $this->getObjPersona();
        if(is_null($comp)){
            $this->setObjPersona($objPersona);
        }else{
            echo "\nEl inmueble ya se encuentra alquilado.";
        }
    }
}
?>