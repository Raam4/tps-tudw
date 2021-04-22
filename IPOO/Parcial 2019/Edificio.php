<?php
include "Inmueble.php";
class Edificio{
    //Atributos
    private $direccion;
    private $colObjInmueble;
    private $objPersona;
    //Constructor
    public function __construct($direccion, $colObjInmueble, $objPersona){
        $this->direccion = $direccion;
        $this->colObjInmueble = $colObjInmueble;
        $this->objPersona = $objPersona;
    }
    //Modificadores
    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }
    public function setColObjInmueble($colObjInmueble){
        $this->colObjInmueble = $colObjInmueble;
    }
    public function setObjPersona($objPersona){
        $this->objPersona = $objPersona;
    }
    //Observadores
    public function getDireccion(){
        return $this->direccion;
    }
    public function getColObjInmueble(){
        return $this->colObjInmueble;
    }
    public function getObjPersona(){
        return $this->objPersona;
    }
    //Metodos
    public function __toString(){
        $cantidadDeptos = count($this->getColObjInmueble());
        return "\nDireccion: ".$this->direccion.
               "\nInmuebles: ".$cantidadDeptos.
               "\nEncargado: ".$this->objPersona;
    }


    public function darInmueblesDisponiblesParaAlquiler($unTipoInmueble, $costoMensual){
        $colInmuebles = $this->getColObjInmueble();
        $colDisponibles = array();
        $i = 0;
        foreach($colInmuebles as $key){
            $costo = $key->getCostoMensual() <= $costoMensual;
            $tipo = $key->getTipo() == $unTipoInmueble;
            if($costo and $tipo){
                $colDisponibles[$i] = $key;
                $i++;
            }
        }
        return $colDisponibles;
    }

    private function pisoCompleto($piso, $tipo){
        $colInmuebles = array();
        $i = 0;
        $completo = true;
        foreach($this->getColObjInmueble() as $key){
            $t = $key->getTipo() == $tipo;
            $p = $key->getNroPiso() == $piso;
            if($p and $t){
                $colInmuebles[$i] = $key;
                $i++;
            }
        }
        foreach($colInmuebles as $key){
            $alq = $key->getObjPersona();
            if(is_null($alq)){
                $completo = false;
                break;
            }
        }
        return $completo;
    }

    public function registrarAlquilerInmueble($objInmueble, $objPersona){
        $alquilar = true;
        if(!(is_null($objInmueble->getObjPersona()))){
            $alquilar = false;
        }else{
            $piso = $objInmueble->getNroPiso();
            $tipo = $objInmueble->getTipo();
            for($i=1; $i<$piso; $i++){
                if(!($this->pisoCompleto($i, $tipo))){
                    $alquilar = false;
                    break;
                }
            }
        }
        if($alquilar){
            $objInmueble->alquilarInmueble($objPersona);
        }
        return $alquilar;
    }

    public function calculaCostoEdificio(){
        $costo = 0;
        $colInmuebles = $this->getColObjInmueble();
        foreach($colInmuebles as $key){
            if(!(is_null($key->getObjPersona()))){
                $costo += $key->getCostoMensual();
            }
        }
        return $costo;
    }
}
?>