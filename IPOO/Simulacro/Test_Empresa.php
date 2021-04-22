<?php
include "Empresa.php";
$objClienteUno = new Cliente("Jhon", "Doe", true, "DNI", 123456789);
$objClienteDos = new Cliente("Jane", "Doe", true, "DNI", 987654321);
$colClientes = array($objClienteUno, $objClienteDos);

$objProductoUno = new Producto(11, 50000, 2018, "Cemento Loma Negra", 70, true);
$objProductoDos = new Producto(12, 10000, 2019, "Hierro del 12", 60, true);
$objProductoTres = new Producto(13, 10000, 2020, "Cal Santa Clara", 50, false);
$colProductos = array($objProductoUno, $objProductoDos, $objProductoTres);

$colVentas = array();

$objEmpresa = new Empresa("Cosmos", "Av. Argentina 123", $colClientes, $colProductos, $colVentas);

$objEmpresa->registrarVenta(array(11, 12, 13), $objClienteDos);

$objEmpresa->registrarVenta(array(0), $objClienteDos);

$objEmpresa->registrarVenta(array(2), $objClienteDos);

$objEmpresa->retornarVentasXCliente("DNI", 123456789);

$objEmpresa->retornarVentasXCliente("DNI", 987654321);

echo $objEmpresa;
?>