<?php
include "Banco.php";
$bco = new Banco(array(), array(), "Nada", array());

$clienteUno = new Cliente(1234, "Jhon", "Doe", "Dni", 123456789);
$clienteDos = new Cliente(4321, "Jane", "Doe", "Dni", 987654321);

$bco->incorporarCliente($clienteUno);
$bco->incorporarCliente($clienteDos);

$bco->incorporarCC(1234);
$bco->incorporarCC(4321);
$bco->incorporarCA(1234);
$bco->incorporarCA(1234);
$bco->incorporarCA(4321);

$CCs = $bco->getColCtaCorriente();
$CAs = $bco->getColCajaAhorro();

foreach($CAs as $key){
    $nro = $key->getNumCuenta();
    $bco->realizarDeposito($nro, 300);
}

$ccA = $CCs[0]->getNumCuenta();
$caB = $CAs[2]->getNumCuenta();

$bco->realizarRetiro($ccA, 150);
$bco->realizarDeposito($caB, 150);

echo $bco;

?>