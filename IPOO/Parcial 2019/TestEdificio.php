<?php
include "Edificio.php";
$responsable = new Persona ("DNI", 27432561, "Carlos", "Martinez", 154321233);
$objEdificio = new Edificio("Juan B. Justo 3456", array(), $responsable);

$x = new Persona("DNI", 12333456, "Pepe", "Suarez", 4456722);
$z = new Persona("DNI", 12333422, "Pedro", "Suarez", 446678);

$colObjInmueble = array();

$colObjInmueble[0] = new Inmueble("I1", 1, "Local Comercial", 50000, $x);
$colObjInmueble[1] = new Inmueble("I2", 1, "Local Comercial", 50000, null);
$colObjInmueble[2] = new Inmueble("I3", 2, "Departamento", 35000, $z);
$colObjInmueble[3] = new Inmueble("I4", 2, "Departamento", 35000, null);
$colObjInmueble[4] = new Inmueble("I5", 3, "Departamento", 35000, null);

$objEdificio->setColObjInmueble($colObjInmueble);

//print_r($objEdificio->darInmueblesDisponiblesParaAlquiler("Local Comercial", 4000));

$y = new Persona("DNI", 28765436, "Mariela", "Suarez", 25543562);

if($objEdificio->registrarAlquilerInmueble($colObjInmueble[4], $y)){
    echo "\nOperación completada.";
}else{
    echo "\nLa operación no pudo ser completada.";
}

if($objEdificio->registrarAlquilerInmueble($colObjInmueble[3], $y)){
    echo "\nOperación completada.";
}else{
    echo "\nLa operación no pudo ser completada.";
}

echo "\n".$objEdificio->calculaCostoEdificio();

echo $objEdificio;

?>