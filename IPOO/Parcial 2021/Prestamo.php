<?php
include "Cuota.php";
include "Persona.php";
class Prestamo{
    //Atributos
    private $identificacion;
    private $codElectrodomestico;
    private $fechaOtorgado;
    private $monto;
    private $cantidadCuotas;
    private $tasaInteres;
    private $colObjCuota;
    private $objPersona;
    //Constructor
    public function __construct($identificacion, $monto, $cantidadCuotas, $tasaInteres, $objPersona){
        $this->identificacion = $identificacion;
        $this->monto = $monto;
        $this->cantidadCuotas = $cantidadCuotas;
        $this->tasaInteres = $tasaInteres;
        $this->objPersona = $objPersona;
    }
    //Modificadores
    public function setIdentificacion($identificacion){
        $this->identificacion = $identificacion;
    }
    public function setCodElectrodomestico($codElectrodomestico){
        $this->codElectrodomestico = $codElectrodomestico;
    }
    public function setFechaOtorgado($fechaOtorgado){
        $this->fechaOtorgado = $fechaOtorgado;
    }
    public function setMonto($monto){
        $this->monto = $monto;
    }
    public function setCantidadCuotas($cantidadCuotas){
        $this->cantidadCuotas = $cantidadCuotas;
    }
    public function setTasaInteres($tasaInteres){
        $this->tasaInteres = $tasaInteres;
    }
    public function setColObjCuota($colObjCuota){
        $this->colObjCuota = $colObjCuota;
    }
    public function setObjPersona($objPersona){
        $this->objPersona = $objPersona;
    }
    //Observadores
    public function getIdentificacion(){
        return $this->identificacion;
    }
    public function getCodElectrodomestico(){
        return $this->codElectrodomestico;
    }
    public function getFechaOtorgado(){
        return $this->fechaOtorgado;
    }
    public function getMonto(){
        return $this->monto;
    }
    public function getCantidadCuotas(){
        return $this->cantidadCuotas;
    }
    public function getTasaInteres(){
        return $this->tasaInteres;
    }
    public function getColObjCuota(){
        return $this->colObjCuota;
    }
    public function getObjPersona(){
        return $this->objPersona;
    }
    //Metodos
    public function __toString(){
        $colObjCuota = $this->getColObjCuota();
        if(is_null($colObjCuota)){
            $str = "";
        }else{
            $str = self::colToStr($this->getColObjCuota());
        }
        return "\nIdentificacion: ".$this->identificacion.
               "\nCodigo de Electrodomestico: ".$this->codElectrodomestico.
               "\nFecha de Otorgamiento: ".$this->fechaOtorgado.
               "\nMonto: ".$this->monto.
               "\nCantidad de Cuotas: ".$this->cantidadCuotas.
               "\nTasa de Interes: ".$this->tasaInteres.
               "\nCuotas: ".$str.
               "\nPersona: ".$this->objPersona;
    }

    private static function colToStr($col){
        //Función creada para visualizar mejor un array en el metodo __toString()
        $str = "";
        foreach($col as $key){
            $str .= $key;
        }
        return $str;
    }

    private function calcularInteresPrestamo($numCuota){
        /**
         * Calcula el monto del interes de determinada cuota
         * @return int
         */
        $monto = $this->getMonto();
        $cantidadCuotas = $this->getCantidadCuotas();
        $tasaInteres = $this->getTasaInteres();
        $interesCuota = ($monto - (($monto / $cantidadCuotas) * ($numCuota))) * $tasaInteres;
        return $interesCuota;
    }

    public function otorgarPrestamo(){
        /**
         * Setea las variables $fechaOtorgado y $colObjCuota generando un array para esta ultima
         * y un objeto cuota para cada una de sus posiciones
         */
        $fecha = date('d-m-y');
        $this->setFechaOtorgado($fecha);
        $cantidadCuotas = $this->getCantidadCuotas();
        $monto = $this->getMonto();
        $colObjCuota = array();
        for($i=0; $i<$cantidadCuotas; $i++){
            $montoCuota = $monto / $cantidadCuotas;
            $montoInteres = $this->calcularInteresPrestamo($i);
            $colObjCuota[$i] = new Cuota($i, $montoCuota, $montoInteres);
        }
        $this->setColObjCuota($colObjCuota);
    }

    public function darSiguienteCuotaPagar(){
        /**
         * Busca en el array de cuotas la siguiente a la última cancelada
         * @return obj Cuota
         */
        $objCuota = null;
        $colObjCuota = $this->getColObjCuota();
        if(!(is_null($colObjCuota))){
            foreach($colObjCuota as $key){
                $cancelada = $key->getCancelada();
                if(!$cancelada){
                    $objCuota = $key;
                    break;
                }
            }
        }
        return $objCuota;
    }
}
?>