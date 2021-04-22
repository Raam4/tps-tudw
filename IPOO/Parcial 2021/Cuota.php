<?php
class Cuota{
    //Atributos
    private $numero;
    private $montoCuota;
    private $montoInteres;
    private $cancelada;
    //Constructo
    public function __construct($numero, $montoCuota, $montoInteres){
        $this->numero = $numero;
        $this->montoCuota = $montoCuota;
        $this->montoInteres = $montoInteres;
        $this->cancelada = false;
    }
    //Modificadores
    public function setNumero($numero){
        $this->numero = $numero;
    }
    public function setMontoCuota($montoCuota){
        $this->montoCuota = $montoCuota;
    }
    public function setMontoInteres($montoInteres){
        $this->montoInteres = $montoInteres;
    }
    public function setCancelada($cancelada){
        $this->cancelada = $cancelada;
    }
    //Observadores
    public function getNumero(){
        return $this->numero;
    }
    public function getMontoCuota(){
        return $this->montoCuota;
    }
    public function getMontoInteres(){
        return $this->montoInteres;
    }
    public function getCancelada(){
        return $this->cancelada;
    }
    //Metodos
    public function __toString(){
        $str = $this->cancelada ? "Si" : "No";
        return "\nCuota Numero: ".($this->numero + 1).
               "\nMonto de Cuota: ".$this->montoCuota.
               "\nMonto de Interes: ".$this->montoInteres.
               "\nCancelada: ".$str;
    }

    public function darMontoFinalCuota(){
        /**
         * Metodo que retorna el importe total de la cuota mas los intereses correspondientes
         */
        $montoCuota = $this->getMontoCuota();
        $montoInteres = $this->getMontoInteres();
        $total = $montoCuota + $montoInteres;
        return $total;
    }
}
?>