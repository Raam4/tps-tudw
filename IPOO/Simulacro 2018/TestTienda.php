<?php
include "Tienda.php";
$p1 = new Producto("0001", "uno", "one", "azul", "S", "descripcion", 3);
$p2 = new Producto("0002", "dos", "two", "rojo", "M", "descripcion", 4);
$p3 = new Producto("0003", "tres", "three", "amarillo", "L", "descripcion", 1);
$p4 = new Producto("0004", "cuatro", "four", "verde", "XL", "descripcion", 0);

$colObjProducto = array($p1, $p2, $p3, $p4);

$objTienda = new Tienda('Nombre', "Calle Falsa 123", 147896523, $colObjProducto, array());

$array = array("codigoBarra" => "0001", "cantidad" => 5);

$colObjVenta = array();
$colObjVenta[0] = $objTienda->realizarVenta($array);
$objTienda->setColObjVenta($colObjVenta);

echo $objTienda;
?>