<?php
include_once "ABM/abmTeatro.php";
include_once "ABM/abmFuncionObra.php";
include_once "ABM/abmFuncionCine.php";
include_once "ABM/abmFuncionMusical.php";

function menues($par){
	if($par){
		//Seleccionar o crear un teatro
		echo "\nOpciones del teatro $ :";//mostrar el nombre
		echo "\n1| Modificar el nombre.";
		echo "\n2| Modificar la dirección.";
		echo "\n3| Modificar las funciones del teatro.";
		echo "\n4| Calcular los costos totales del teatro.";
		echo "\n5| Eliminar el teatro.";
		echo "\n6| Seleccionar otro teatro";
		echo "\n7| Finalizar programa.";
	}else{
		//Seleccionar o crear una funcion
		echo "\nOpciones de la funcion $ :";//mostrar el nombre o id
		echo "\n1| Modificar los datos.";
		echo "\n2| Calcular el costo de la actividad.";
		echo "\n3| Eliminar la funcion seleccionada.";
		echo "\n4| Seleccionar otra funcion.";
		echo "\n5| Volver al menú principal.";
	}
	$opcion = trim(fgets(STDIN));
	return $opcion;
}

//ppal
do{
	$ppal = menues(True);
	switch($ppal){

	}
}while($ppal != 7);
?>
