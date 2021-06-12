<?php
include_once "BaseDatos.php";
include_once "Teatro.php";

$teatro = new Teatro();
$col = array();
$teatro->cargar("Ateneo", "Calle Falsa 123", $col);
$respuesta=$teatro->insertar();

if ($respuesta==true) {
	echo "\nOP INSERCION;  La persona fue ingresada en la BD";
	$colTeatros =$teatro->listar("");
	foreach ($colTeatros as $unTeatro){
		echo $unTeatro;
		echo "-------------------------------------------------------";
	}
}else 
	echo $obj_Persona->getmensajeoperacion();
?>
