<?php
include_once "ABM/abmTeatro.php";
include_once "ABM/abmFuncion.php";
include_once "ABM/abmFuncionObra.php";
include_once "ABM/abmFuncionCine.php";
include_once "ABM/abmFuncionMusical.php";

function colToStr($col){
	$str = "";
	foreach($col as $key){
		$str .= $key;
	}
	return $str;
}

function menues($par){
	if($par){
		//Seleccionar o crear un teatro
		echo "\nOpciones del teatro $ :";//mostrar el nombre
		echo "\n1| Mostrar información.";
		echo "\n2| Modificar el nombre.";
		echo "\n3| Modificar la dirección.";
		echo "\n4| Modificar las funciones del teatro.";
		echo "\n5| Calcular los costos totales del teatro.";
		echo "\n6| Eliminar el teatro.";
		echo "\n7| Seleccionar otro teatro";
		echo "\n8| Finalizar programa.";
		echo "\nIngrese opción: ";
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

//TEATROS
function mostrarTeatros(){
	$abmttr = new abmTeatro();
	$colObjTeatro = $abmttr->listTeatro();
	$rtn = False;
	if(count($colObjTeatro) != 0){
		echo colToStr($colObjTeatro);
		$rtn = True;
	}
	return $rtn;
}

function teats(){
	$abmttr = new abmTeatro();
	if(mostrarTeatros()){
		echo "Ingrese el ID del teatro a operar o 0 (cero) para crear uno: ";
	}else{
		echo "No hay teatros cargados. Ingrese 0 (cero) para crear uno: ";
	}
	$objTeatro = null;
	do{
		$ing = trim(fgets(STDIN));
		if($ing == 0){
			echo "Ingrese el nombre: ";
			$nombre = trim(fgets(STDIN));
			echo "Ingrese la direccion: ";
			$direccion = trim(fgets(STDIN));
			if(is_null($objTeatro = $abmttr->insertTeatro($nombre, $direccion))){
				echo "No se pudo crear el teatro.\n";
			}else{
				echo "Teatro creado, datos:\n".$objTeatro;
			}
		}else{
			if(is_null($objTeatro = $abmttr->selectTeatro($ing))){
				echo "Entrada inválida, intente nuevamente.\n";
			}
		}
	}while(is_null($objTeatro));
	return $objTeatro;
}

//FUNCIONES
function mostrarFunciones(){
	$abmfnc = new abmFuncion();
	$colObjFuncion = $abmfnc->listFuncion();
	$rtn = False;
	if(count($colObjFuncion) != 0){
		echo colToStr($colObjFuncion);
		$rtn = True;
	}
	return $rtn;
}

function dataFuns($objTeatro){
	$data = array();
	echo "Ingrese el nombre: ";
	$data['nombre'] = trim(fgets(STDIN));
	echo "Ingrese la hora de inicio en formato HH:mm ";
	$horaInicio = trim(fgets(STDIN));
	$data['horaInicio'] = $horaInicio.":00";
	echo "Ingrese la duración en formato HH:mm ";
	$duracion = trim(fgets(STDIN));
	$data['duracion'] = $duracion.":00";
	echo "Ingrese el precio de la entrada: ";
	$data['precio'] = trim(fgets(STDIN));
	echo "Ingrese el costo de la funcion: ";
	$data['costo'] = trim(fgets(STDIN));
	$data['objTeatro'] = $objTeatro;
	return $data;
}

function funs($objTeatro){
	if(mostrarFunciones()){
		echo "Ingrese el ID de la funcion a operar o 0 (cero) para crear una: ";
	}else{
		echo "No hay funciones cargadas. Ingrese 0 (cero) para crear una: ";
	}
	$objFuncion = array();
	do{
		$ing = trim(fgets(STDIN));
		if($ing == 0){
			echo "Ingrese el número correspondiente:\n";
			echo "1| Crear Obra de teatro\n";
			echo "2| Crear función de Cine\n";
			echo "3| Crear Musical\n";
			$ing2 = trim(fgets(STDIN));
			do{
				switch($ing2){
					case 1:
						$objFuncion = dataFuns($objTeatro);
						$objFuncion['porcInc'] = 45;
						$abmfnc = new abmObra();
						$objFuncion = $abmfnc->insertObra($objFuncion);
						break;
					case 2:
						$objFuncion = dataFuns($objTeatro);
						echo "Ingrese el genero: ";
						$objFuncion['genero'] = trim(fgets(STDIN));
						echo "Ingrese el pais de origen: ";
						$objFuncion['paisOrigen'] = trim(fgets(STDIN));
						$objFuncion['porcInc'] = 65;
						$abmfnc = new abmCine();
						$objFuncion = $abmfnc->insertCine($objFuncion);
						break;
					case 3:
						$objFuncion = dataFuns($objTeatro);
						echo "Ingrese director: ";
						$objFuncion['director'] = trim(fgets(STDIN));
						echo "Ingrese la cantidad de personas en escena: ";
						$objFuncion['cantPersonas'] = trim(fgets(STDIN));
						$objFuncion['porcInc'] = 12;
						$abmfnc = new abmMusical();
						$objFuncion = $abmfnc->insertMusical($objFuncion);
						break;
					default:
						echo "Opcion invalida, intente nuevamente.";
						break;
				}
			}while(is_null($objFuncion));
			echo "Funcion creada, datos:\n".$objFuncion;
		}else{
			if(is_null($objFuncion = $abmfnc->selectFuncion($ing))){
				echo "Entrada inválida, intente nuevamente.\n";
			}
		}
	}while(is_null($objFuncion));
	return $objFuncion;
}


//ppal
$ppal = null;
$objTeatro = teats();
$abmttr = new abmTeatro();
do{
	$ppal = menues(True);
	switch($ppal){
		case 1:
			echo $objTeatro;
			break;
		case 2:
			echo "Ingrese el nuevo nombre: ";
			$var = trim(fgets(STDIN));
			if($abmttr->updateTeatro($objTeatro, $var, True)){
				echo "El nombre ha sido modificado.";
			}else{
				echo "No se ha podido modificar el nombre";
			}
			break;
		case 3:
			echo "Ingrese la nueva direccion: ";
			$nombre = trim(fgets(STDIN));
			if($abmttr->updateTeatro($objTeatro, $var, False)){
				echo "La dirección ha sido modificada.";
			}else{
				echo "No se ha podido modificar la dirección";
			}
			break;
		case 4:
			$objFuncion = funs($objTeatro);
			echo $objFuncion;
			break;
		case 5:

			break;
		case 6:
			echo "¿Seguro? Esta acción eliminará también todas las funciones almacenadas.\n";
			echo "s para confirmar, cualquier otra tecla para cancelar: ";
			if(trim(fgets(STDIN)) == "s"){
				if($abmttr->deleteTeatro($objTeatro)){
					echo "Teatro eliminado.\n";
					echo "Se cierra el programa.";
					$ppal = 8;
				}else{
					echo "No se ha podido eliminar el teatro.";
				}
			}else{
				echo "Operación cancelada.";
			}
			break;
		case 7:
			$objTeatro = teats();
			break;
		case 8: break;
		default:
			echo "Opción inválida, intente nuevamente.\n";
			break;
	}
}while($ppal != 8);
?>
