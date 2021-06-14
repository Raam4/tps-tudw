<?php
include_once "ABM/abmTeatro.php";
include_once "ABM/abmFuncionObra.php";

$ttr = new abmTeatro();
$objTeatro = $ttr->selectTeatro(10);

/*$func = new abmObra();
$obra = array();
$obra['nombre'] = "nombre";
$obra['horaInicio'] = date("H:i:s");
$obra['duracion'] = date("H:i:s");
$obra['precio'] = 123;
$obra['costo'] = 123;
$obra['objTeatro'] = $objTeatro;
$obra['porcInc'] = 20;

$conf = $func->insertObra($obra);
if($conf){
	print("ok");
}else{
	print("not ok");
}*/

print $objTeatro;


?>
