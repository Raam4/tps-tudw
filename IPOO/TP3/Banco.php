<?php
include_once "CuentaCorriente.php";
include_once "CajaAhorro.php";

class Banco{
    private $colCtaCorriente;
    private $colCajaAhorro;
    private $ultimoValorCuentaAsignado;
    private $colCliente;

    public function __construct($colCtaCorriente, $colCajaAhorro, $ultimoValorCuentaAsignado, $colCliente){
        $this->colCtaCorriente = $colCtaCorriente;
        $this->colCajaAhorro = $colCajaAhorro;
        $this->ultimoValorCuentaAsignado = $ultimoValorCuentaAsignado;
        $this->colCliente = $colCliente;
    }
    public function setColCtaCorriente($colCtaCorriente){
        $this->colCtaCorriente = $colCtaCorriente;
    }
    public function setColCajaAhorro($colCajaAhorro){
        $this->colCajaAhorro = $colCajaAhorro;
    }
    public function setUltimoValorCuentaAsignado($ultimoValorCuentaAsignado){
        $this->ultimoValorCuentaAsignado = $ultimoValorCuentaAsignado;
    }
    public function setColCliente($colCliente){
        $this->colCliente = $colCliente;
    }
    public function getColCtaCorriente(){
        return $this->colCtaCorriente;
    }
    public function getColCajaAhorro(){
        return $this->colCajaAhorro;
    }
    public function getUltimoValorCuentaAsignado(){
        return $this->ultimoValorCuentaAsignado;
    }
    public function getColCliente(){
        return $this->colCliente;
    }

    public function __toString(){
        $strCC = $this->colToStr($this->colCtaCorriente);
        $strCA = $this->colToStr($this->colCajaAhorro);
        $strCl = $this->colToStr($this->colCliente);
        return "\nCuentas Corriente: ".$strCC.
               "\nCajas de Ahorro: ".$strCA.
               "\nUltimo valor de cuenta asignado: ".$this->ultimoValorCuentaAsignado.
               "\nClientes: ".$strCl;
    }

    private function colToStr($col){
        $str = "";
        foreach($col as $key){
            $str .= $key;
        }
        return $str;
    }

    public function incorporarCliente($objCliente){
        $i = count($this->colCliente);
        $this->colCliente[$i] = $objCliente;
    }
    
    private function checkCliente($nroCliente){
        $cliente = null;
        foreach($this->colCliente as $key){
            if($key->getNroCliente() == $nroCliente){
                $cliente = $key;
                break;
            }
        }
        return $cliente;
    }

    private function checkCuenta($nroCuenta){
        $cuenta = null;
        $colCajaAhorro = $this->getColCajaAhorro();
        foreach($colCajaAhorro as $key){
            if($key->getNumCuenta() == $nroCuenta){
                $cuenta = $key;
                break;
            }
        }
        if(is_null($cuenta)){
            $colCtaCorriente = $this->getColCtaCorriente();
            foreach($colCtaCorriente as $key){
                if($key->getNumCuenta() == $nroCuenta){
                    $cuenta = $key;
                    break;
                }
            }
        }
        return $cuenta;
    }

    public function incorporarCC($nroCliente){
        $cliente = $this->checkCliente($nroCliente);
        if(is_null($cliente)){
            echo "El cliente no existe.";
        }else{
            $i = count($this->colCtaCorriente);
            $this->colCtaCorriente[$i] = new CuentaCorriente(random_int(0, 9999), $cliente, 1.3, 100000);
        }
    }

    public function incorporarCA($nroCliente){
        $cliente = $this->checkCliente($nroCliente);
        if(is_null($cliente)){
            echo "El cliente no existe.";
        }else{
            $i = count($this->colCajaAhorro);
            $this->colCajaAhorro[$i] = new CajaAhorro(random_int(0, 9999), $cliente, 1.3);
        }
    }

    public function realizarDeposito($nroCuenta, $monto){
        $cuenta = $this->checkCuenta($nroCuenta);
        if(is_null($cuenta)){
            echo "La cuenta no existe.";
        }else{
            $cuenta->depositar($monto);
        }
    }

    public function realizarRetiro($nroCuenta, $monto){
        $cuenta = $this->checkCuenta($nroCuenta);
        if(is_null($cuenta)){
            echo "La cuenta no existe.";
        }else{
            $cuenta->retirar($monto);
        }
    }

}
?>