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
		echo "\nOpciones del teatro:";//mostrar el nombre
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
		echo "\nOpciones de la funcion:";//mostrar el nombre o id
		echo "\n1| Modificar los datos.";
		echo "\n2| Eliminar la funcion seleccionada.";
		echo "\n3| Seleccionar otra funcion.";
		echo "\n4| Volver al menú principal.";
		echo "\nIngrese opción: ";
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
		echo "\nIngrese el ID del teatro a operar o 0 (cero) para crear uno: ";
	}else{
		echo "\nNo hay teatros cargados. Ingrese 0 (cero) para crear uno: ";
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

function opcModificaFun($objTeatro, $objFuncion){
	echo "Modificará la función: \n";
	$abmfnc = new abmFuncion();
	$arrupd = dataFuns($objTeatro);
	$rtn = $abmfnc->updateFuncion($objFuncion, $arrupd);
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
	$data['objTeatro'] = $objTeatro;
	return $data;
}

function funs($objTeatro){
	if(mostrarFunciones()){
		echo "\nIngrese el ID de la funcion a operar, 0 (cero) para crear una: ";
	}else{
		echo "\nNo hay funciones cargadas. Ingrese 0 (cero) para crear una: ";
	}
	$objFuncion = array();
	do{
		$ing = trim(fgets(STDIN));
		if($ing == 0){
			echo "1| Crear Obra de teatro\n";
			echo "2| Crear función de Cine\n";
			echo "3| Crear Musical\n";
			echo "Ingrese el número correspondiente: ";
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
						echo "Opcion invalida, intente nuevamente: ";
						break;
				}
			}while(is_null($objFuncion));
			echo "Funcion creada, datos:\n".$objFuncion;
		}else{
			$abmfnc = new abmFuncion();
			if(is_null($objFuncion = $abmfnc->selectFuncion($ing))){
				echo "Entrada inválida, intente nuevamente: ";
			}
		}
	}while(is_null($objFuncion));
	return $objFuncion;
}

function handleFuns($objFuncion, $objTeatro){
	$abmfnc = new abmFuncion();
	do{
		$sub = menues(False);
		switch($sub){
			case 1:
				if(opcModificaFun($objTeatro, $objFuncion)){
					echo "Funcion actualizada.";
				}else{
					echo "La funcion no se pudo modificar";
				}
				break;
			case 2:
				echo "Seguro que quiere eliminar funcion?\n";
				echo "s para confirmar, cualquier otra tecla para cancelar: ";
				if(trim(fgets(STDIN)) == "s"){
					if($abmfnc->deleteFuncion($objFuncion)){
						echo "Funcion eliminada.\n";
						$objFuncion = funs($objTeatro);
					}else{
						echo "No se ha podido eliminar el teatro.\n";
					}
				}else{
					echo "Operación cancelada.\n";
				}
				break;
			case 3:
				$objFuncion = funs($objTeatro);
				break;
			case 4: break;
			default:
				echo "Opción inválida, intente nuevamente: ";
				break;
		}
	}while($sub != 4);
}

function sumarhrs($hora1, $hora2){
    $a = new DateTime($hora1); //Creo un objeto DateTime
    $b = new DateInterval((new DateTime($hora2))->format('\P\TH\Hi\Ms\S')); //Creo un objeto DateInterval
    $a->add($b); //Sumo las horas
    return $a->format('h:i:s'); //Imprimo las horas
}

function solapa($objTeatro, $hora){
	$abmttr = new abmTeatro();
	$colObjFuncion = $abmttr->devuelveFunciones($objFuncion);
	$rtn = False;
	if($colObjFuncion != 0){
		foreach($colObjFuncion as $key){
			$inicia = $key['horaInicio'];
			$finaliza = sumarhrs($inicia, $key['duracion']);
			if(($hora < $inicia) and ($finaliza < $finaliza)){
				$rtn = True;
			}
		}
	}
	$rtn;
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
				echo "El nombre ha sido modificado.\n";
			}else{
				echo "No se ha podido modificar el nombre.\n";
			}
			break;
		case 3:
			echo "Ingrese la nueva direccion: ";
			$var = trim(fgets(STDIN));
			if($abmttr->updateTeatro($objTeatro, $var, False)){
				echo "La dirección ha sido modificada.\n";
			}else{
				echo "No se ha podido modificar la dirección.\n";
			}
			break;
		case 4:
			$objFuncion = funs($objTeatro);
			handleFuns($objFuncion, $objTeatro);
			break;
		case 5:
			$costos = $abmttr->calculaCostos($objTeatro);
			echo "Los costos totales del teatro suman: $".$costos;
			break;
		case 6:
			echo "¿Seguro? Esta acción eliminará también todas las funciones almacenadas.\n";
			echo "s para confirmar, cualquier otra tecla para cancelar: ";
			if(trim(fgets(STDIN)) == "s"){
				if($abmttr->deleteTeatro($objTeatro)){
					echo "Teatro eliminado.\n";
					$objTeatro = teats();
				}else{
					echo "No se ha podido eliminar el teatro.\n";
				}
			}else{
				echo "Operación cancelada.\n";
			}
			break;
		case 7:
			$objTeatro = teats();
			break;
		case 8:
			echo "Fin del programa!\n";
			break;
		default:
			echo "Opción inválida, intente nuevamente: ";
			break;
	}
}while($ppal != 8);
?>
