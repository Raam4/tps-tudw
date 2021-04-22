<?php
include "Financiera.php";

$objFinanciera = new Financiera("Money", "Av. Arg 1234");

$objPersonaUno = new Persona("Pepe", "Florez", 123456789, "Bs As 12", "dir@mail.com", 299444567, 40000); 
$objPersonaDos = new Persona("Luis", "Suarez", 987654321, "Bs As 123", "dir@mail.com", 2994455, 4000);

$colObjPrestamo = array();
$colObjPrestamo[0] = new Prestamo(1, 50000, 5, 0.1, $objPersonaUno);
$colObjPrestamo[1] = new Prestamo(2, 10000, 4, 0.1, $objPersonaDos);
$colObjPrestamo[2] = new Prestamo(3, 10000, 2, 0.1, $objPersonaDos);

foreach($colObjPrestamo as $key){
    $objFinanciera->incorporarPrestamo($key);
}
echo $objFinanciera;

$objFinanciera->otorgarPrestamoSiCalifica();
echo $objFinanciera;

$objCuota = $objFinanciera->informarCuotaPagar(2);
echo $objCuota;
/*La variable queda null ya que el 40% del neto (4000*0.4 = 1600) de la persona que solicita el prestamo id 2
es superado por monto/cantidad de cuotas (10000/4 = 2500).*/

if(is_null($objCuota)){
    echo "\nEl objeto es nulo";
}else{
    echo $objCuota->darMontoFinalCuota();
} //Punto 9 del test, daría error ya que el objeto cuota queda nulo

if(is_null($objCuota)){
    echo "\nEl objeto es nulo";
}else{
    echo $objCuota->setCancelada(true);
} //Punto 10 del test, daría error ya que el objeto cuota queda nulo

//Consulté si podia usar otro prestamo para el punto 11
$objCuota = $objFinanciera->informarCuotaPagar(1);
echo $objCuota;
?>