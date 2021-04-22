<?php
include "Prestamo.php";
class Financiera{
    //Atributos
    private $denominacion;
    private $direccion;
    private $colObjPrestamo;
    //Constructor
    public function __construct($denominacion, $direccion){
        $this->denominacion = $denominacion;
        $this->direccion = $direccion;
    }
    //Modificadores
    public function setDenominacion($denominacion){
        $this->denominacion = $denominacion;
    }
    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }
    public function setColObjPrestamo($colObjPrestamo){
        $this->colObjPrestamo = $colObjPrestamo;
    }
    //Observadores
    public function getDenominacion(){
        return $this->denominacion;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function getColObjPrestamo(){
        return $this->colObjPrestamo;
    }
    //Metodos
    public function __toString(){
        $str = self::colToStr($this->getColObjPrestamo());
        return "\nDenominacion: ".$this->denominacion.
               "\nDireccion: ".$this->direccion.
               "\nPrestamos: ".$str;
    }

    private static function colToStr($col){
        //Función creada para visualizar mejor un array en el metodo __toString()
        $str = "";
        foreach($col as $key){
            $str .= $key;
        }
        return $str;
    }

    public function incorporarPrestamo($objPrestamo){
        /**
         * @param obj Prestamo
         * Incorpora un nuevo objeto Prestamo a la coleccion de prestamos
         */
        $colObjPrestamo = $this->getColObjPrestamo();
        if(is_null($colObjPrestamo)){
            $colObjPrestamo = array();
        }
        $i = count($colObjPrestamo);
        $colObjPrestamo[$i] = $objPrestamo;
        $this->setColObjPrestamo($colObjPrestamo);
    }

    public function otorgarPrestamoSiCalifica(){
        /**
         * Genera las cuotas de un prestamo si se cumple determinada condicion de la persona solicitante
         * invocando a la funcion otorgarPrestamo() de la clase Prestamo
         */
        $colObjPrestamo = $this->getColObjPrestamo();
        foreach($colObjPrestamo as $key){
            $colObjCuota = $key->getColObjCuota();
            if(is_null($colObjCuota)){
                $monto = $key->getMonto();
                $cantidadCuotas = $key->getCantidadCuotas();
                $objPersona = $key->getObjPersona();
                $neto = $objPersona->getNeto();
                if(($monto / $cantidadCuotas) <= $neto * 0.4){
                    $key->otorgarPrestamo();
                }
            }
        }
    }

    public function informarCuotaPagar($idPrestamo){
        /**
         * @param $idPrestamo
         * Informa la siguiente cuota que se debe pagar del prestamo ingresado como parametro
         * @return obj Cuota
         */
        $colObjPrestamo = $this->getColObjPrestamo();
        $objCuota = null;
        foreach($colObjPrestamo as $key){
            $identificacion = $key->getIdentificacion();
            if($identificacion == $idPrestamo){
                $objCuota = $key->darSiguienteCuotaPagar();
                break;
            }
        }
        return $objCuota;
    }
}
?>