<?php
include "Venta.php";
class Local{
    //Atributos
    private $colObjImportado;
    private $colObjRegional;
    private $colObjVenta;
    //Constructor
    public function __construct($colObjImportado, $colObjRegional, $colObjVenta)    {
        $this->colObjImportado = $colObjImportado;
        $this->colObjRegional = $colObjRegional;
        $this->colObjVenta = $colObjVenta;
    }
    //Observadores y Modificadores
    public function getColObjImportado(){
        return $this->colObjImportado;
    }
    public function setColObjImportado($colObjImportado){
        $this->colObjImportado = $colObjImportado;
    }
    public function getColObjRegional(){
        return $this->colObjRegional;
    }
    public function setColObjRegional($colObjRegional){
        $this->colObjRegional = $colObjRegional;
    }
    public function getColObjVenta(){
        return $this->colObjVenta;
    }
    public function setColObjVenta($colObjVenta){
        $this->colObjVenta = $colObjVenta;
    }
    //Metodos
    public function __toString(){
        $strImportado = self::colToStr($this->colObjImportado);
        $strRegional = self::colToStr($this->colObjRegional);
        $strVenta = self::colToStr($this->colObjVenta);
        return "\nProductos Importados: ".$strImportado.
               "\nProductos Regionales: ".$strRegional.
               "\nVentas: ".$strVenta;
    }

    private static function colToStr($col){
        $str = "";
        foreach($col as $key){
            $str .= $key;
        }
        return $str;
    }

    public function incorporarProductoTienda($objProducto){
        $add = true;
        $colObjImportado = $this->getColObjImportado;
        $colObjRegional = $this->colObjRegional;
        $barras = $objProducto->getCodBarra();
        if(is_a($objProducto, "Importado")){
            foreach($colObjImportado as $key){
                if($barras == $key->getCodBarra()){
                    $add = false;
                    break;
                }
            }
            if($add){
                array_push($colObjImportado, $objProducto);
                $this->setColObjImportado($colObjImportado);
            }
        }else{
            foreach($colObjRegional as $key){
                if($barras == $key->getCodBarra()){
                    $add = false;
                    break;                    
                }
            }
            if($add){
                array_push($colObjRegional, $objProducto);
                $this->setColObjRegional($colObjRegional);
            }

        }
        return $add;
    }

    public function retornarImporteProducto($codProducto){
        $precioVenta = 0;
        $colObjImportado = $this->getColObjImportado();
        $colObjRegional = $this->getColObjRegional();
        $colObjProducto = array_merge($colObjImportado , $colObjRegional);
        foreach($colObjProducto as $key){
            if($codProducto == $key->getCodBarra()){
                $precioVenta = $key->darPrecioVenta();
                break;
            }
        }
        return $precioVenta;
    }

    public function retornarCostoProductoTienda(){
        $costoProductoTienda = 0;
        $colObjImportado = $this->getColObjImportado();
        $colObjRegional = $this->getColObjRegional();
        $colObjProducto = array_merge($colObjImportado , $colObjRegional);
        foreach($colObjProducto as $key){
            $stock = $key->getStock();
            $costo = $key->getCosto();
            $costoProductoTienda += $stock * $costo;
        }
        return $costoProductoTienda;
    }

    public function productoMasEconomico($objRubro){
        $colObjImportado = $this->getColObjImportado();
        $colObjRegional = $this->getColObjRegional();
        $colObjProducto = array_merge($colObjImportado , $colObjRegional);
        $colProdRubro = array();
        foreach($colObjProducto as $key){
            if($key->getObjRubro() == $objRubro){
                array_push($colProdRubro, $key);
            }
        }
        $barato = $colProdRubro[0];
        foreach($colProdRubro as $key){
            if($key->darPrecioVenta() < $barato->darPrecioVenta()){
                $barato = $key;
            }
        }
        return $barato;
    }

    public function informarProductosMasVendidos($anio, $n){
        $colVentasAnio = array();
        $colObjVenta = $this->getColObjVenta();
        $colVendidos = array();
        foreach($colObjVenta as $key){
            if($key->getFecha() == $anio){
                array_push($colVentasAnio, $key);
            }
        }
        foreach($colVentasAnio as $key){
            $colObjProducto = $key->getColObjProducto();
            foreach($colObjProducto as $yek){
                $codBarra = $yek->getCodBarra();
                if(array_key_exists($colVendidos, $codBarra)){
                    $colVendidos[$codBarra]++;
                }else{
                    $colVendidos[$codBarra] = 1;
                }
            }
        }
        arsort($colVendidos);
        $masVendidos = array();
        for($i=0; $i<$n; $i++){
            $cod = key(current($colVendidos));
            foreach($colObjProducto as $key){
                if($key->getCodBarra() == $cod){
                    $masVendidos[$i] = $key;
                    break;
                }
            }
        }
        return $masVendidos;
    }

    public function promedioVentasImportados(){
        $i = 0;
        $colObjVenta = $this->getColObjVenta();
        foreach($colObjVenta as $key){
            $colObjProducto = $key->getColObjProducto();
            foreach($colObjProducto as $yek){
                if(is_a($yek, "Importado")){
                    $total = $yek->darPrecioVenta();
                    $i++;
                }
            }
        }
        return ($total / $i);
    }

    public function informarConsumoCliente($tipoDoc, $numDoc){
        $colObjVenta = $this->getColObjVenta();
        $productosCliente = array();
        foreach($colObjVenta as $key){
            $cliente = $key->getCliente();
            if($tipoDoc == $cliente->getTipoDoc() & $numDoc == $cliente->getNumDoc()){
                array_push($productosCliente, $key->getColObjProducto());
            }
        }
        return $productosCliente;
    }
}
?>