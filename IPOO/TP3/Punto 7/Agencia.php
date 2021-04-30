<?php
include "VentaOnline.php";
class Agencia{
    //Atributos
    private $colObjPaqueteTuristico;
    private $colObjVenta;
    private $colObjVentaOnline;
    //Construct
    public function __construct($colObjPaqueteTuristico, $colObjVenta, $colObjVentaOnline){
        $this->colObjPaqueteTuristico = $colObjPaqueteTuristico;
        $this->colObjVenta = $colObjVenta;
        $this->colObjVentaOnline = $colObjVentaOnline;
    }
    //Observadores y Modificadores
    public function getColObjPaqueteTuristico(){
        return $this->colObjPaqueteTuristico;
    }
    public function setColObjPaqueteTuristico($colObjPaqueteTuristico){
        $this->colObjPaqueteTuristico = $colObjPaqueteTuristico;
    }
    public function getColObjVenta(){
        return $this->colObjVenta;
    }
    public function setColObjVenta($colObjVenta){
        $this->colObjVenta = $colObjVenta;
    }
    public function getColObjVentaOnline(){
        return $this->colObjVentaOnline;
    }
    public function setColObjVentaOnline($colObjVentaOnline){
        $this->colObjVentaOnline = $colObjVentaOnline;
    }
    //Metodos
    public function __toString(){
        $strObjPaqueteTuristico = self::colToStr($this->colObjPaqueteTuristico);
        $strObjVenta = self::colToStr($this->colObjVenta);
        $strObjVentaOnline = self::colToStr($this->colObjVentaOnline);
        return "\nPaquetes Turisticos: ".$strObjPaqueteTuristico.
               "\nVentas en Agencia: ".$strObjVenta.
               "\nVentas Online: ".$strObjVentaOnline;
    }

    private static function colToStr($col){
        $str = "";
        foreach($col as $key){
            $str .= $key;
        }
        return $str;
    }

    public function incorporarPaquete($objPaqueteTuristico){
        $incorpora = true;
        $i = 0;
        $col = $this->getColObjPaqueteTuristico();
        $fecha = $objPaqueteTuristico->getFechaDesde();
        $objDestino = $objPaqueteTuristico->getObjDestino();
        /*foreach($colObjPaqueteTuristico as $key){
            if(($key->getFechaDesde() == $fecha) and ($key->getObjDestino() == $objDestino)){
                $incorpora = $false;
                break;
            }

        }*/
        do{
            if(($col[$i]->getFechaDesde() == $fecha) and ($col[$i]->getObjDestino() == $objDestino)){
                $incorpora = false;
            }
            $i++;
        }while($incorpora == true and $i<count($col));
        if($incorpora){
            array_push($col, $objPaqueteTuristico);
            $this->setColObjPaqueteTuristico($col);
        }
        return $incorpora;
    }

    public function incorporarVenta($objPaqueteTuristico, $tipoDoc, $nroDoc, $cantPer, $esOnline){
        $importe = -1;
        if($esOnline){
            $objVenta = new VentaOnline(date("Y-m-d"), $objPaqueteTuristico, $cantPer, array($tipoDoc, $nroDoc));
        }else{
            $objVenta = new Venta(date("Y-m-d"), $objPaqueteTuristico, $cantPer, array($tipoDoc, $nroDoc));
        }
        $importe = $objVenta->darImporteVenta();
        return $importe;
    }

    public function informarPaquetesTuristicos($fecha, $objDestino){
        $colObjPaqueteTuristico = $this->getColObjPaqueteTuristico();
        $paquetes = array();
        foreach($colObjPaqueteTuristico as $key){
            if(($key->getFechaDesde() == $fecha) and ($key->getObjDestino() == $objDestino)){
                array_push($paquetes, $key);
            }
        }
        return $paquetes;
    }

    public function paqueteMasEconomico($fecha, $objDestino){
        $array = $this->informarPaquetesTuristicos($fecha, $objDestino);
        $rolav = null;
        $eco = null;
        foreach($array as $key){
            $cantDias = $key->getCantDias();
            $valorDia = $objDestino->getvalorDia();
            $valor = $cantDias * $valorDia;
            if(is_null($rolav)){
                $rolav = $valor;
                $eco = $key;
            }else{
                if($valor<$rolav){
                    $rolav = $valor;
                    $eco = $key;
                }
            }
        }
        return $eco;
    }

    public function informarConsumoCliente($tipoDoc, $nroDoc){
        $colObjVentas = array();
        array_merge($colObjVentas, $this->getColObjVenta(), $this->getColObjVentaOnline());
        $colPaquetesCliente = array();
        foreach($colObjVentas as $key){
            $datos = $key->getCliente();
            if($datos[0] == $tipoDoc and $datos[1]==$nroDoc){
                array_push($colPaquetesCliente, $key->getObjPaqueteTuristico());
            }
        }
        return $colPaquetessCliente;
    }

    public function informarPaqueteMasVendido($anio, $n){
        $colObjPaqueteTuristico = $this->getColObjPaqueteTuristico();
        $colObjVentas = array();
        array_merge($colObjVentas, $this->getColObjVenta(), $this->getColObjVentaOnline());
        $packs = null;
        $i = 0;
        if($n>1){
            $packs = array();
        }
        do{
            $pack = $colObjVentas[$i]->getObjPaqueteTuristico();

        }while((count($packs)<$n) and ($i<count($colObjVentas)));
    }
}
?>