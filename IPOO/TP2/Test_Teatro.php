<?php
    include 'Teatro.php';
    /**
     * Programa Principal
     * String $nombre, $direccion, $nm
     * int $cantFunc, $dr, $i, $j, $pr, $opcion, $cuatro
     * array int $st
     * array obj $funcion
     * obj $teatro
     */
    $teat = null;
    $str = "";
    do{
        $opcion = menu();
        switch($opcion){
            case 1:
                echo "Ingrese el nuevo nombre del teatro: ";
                if(is_null($teat)){
                    $nombre = trim(fgets(STDIN));
                }else{    
                    $teat->setNombre($nombre);
                }break;
            case 2:
                echo "Ingrese la nueva dirección del teatro: ";
                if(is_null($teat)){
                    $direccion = trim(fgets(STDIN));
                }else{
                    $teat->setNombre($direccion);
                }break;
            case 3:
                if(is_null($teat)){
                    echo "Ingrese la cantidad de funciones a cargar:";
                    $cantFunc = trim(fgets(STDIN));
                    for($i=0; $i<$cantFunc; $i++){
                        echo "\nIngrese el nombre de la función ".($i+1).": ";
                        $nm = trim(fgets(STDIN));
                        echo "\nIngrese la hora de inicio en formato HHmm: ";
                        $st = format(trim(fgets(STDIN)));
                        echo "\nIngrese la duracion en minutos: ";
                        $dr = trim(fgets(STDIN));
                        $j = $i;
                        while(0<$i and 0<$j){
                            if($funcion[$j-1]->solap($st, $dr)){
                                echo "\nLa función ingresada se solapará con la función ".$funcion[$j-1]->getNombre();
                                echo "\nIngrese nuevamente los datos de la función evitando lo anterior mencionado.";
                                $i--;
                                continue 2;
                            }else{
                                $j--;
                            }
                        }
                        echo "\nIngrese el precio: ";
                        $pr = trim(fgets(STDIN));
                        $funcion[$i] = new Funcion($nm, $st, $dr, $pr);
                    }
                    $teat = new Teatro($nombre, $direccion, $funcion);
                }else{
                    echo "Ya se encuentra información cargada de funciones, utilice la opción 4 o 5.";
                }
                break;
            case 4:
                if(is_null($teat)){
                    echo "No se encuentra información cargada de funciones, utilice la opción 3.";
                }else{
                    cuatro();
                }
                break;
            case 5:
                if(is_null($teat)){
                    echo "La información del teatro está sin cargar o incompleta, seleccione otra opción.";
                }else{
                    echo $teat;
                }
                break;
            case 6:
                echo "Fin del programa.";
                break;
            default:
                echo "Opción inválida, intente nuevamente.";
                break;
        }

    }while($opcion != 6);

    function menu(){
        /**
         * Muestra un menú de opciones para el usuario y recibe un entero
         * int $opcion
         * @return int
         */
        echo "\n---------------------------------------------";
        echo "\n1| Modificar el nombre del teatro.";
        echo "\n2| Modificar la dirección del teatro.";
        echo "\n3| Cargar información de las funciones.";
        echo "\n4| Modificar la información de las funciones.";
        echo "\n5| Mostrar la información del Teatro.";
        echo "\n6| Salir del programa.";
        echo "\n---------------------------------------------";
        $opcion = trim(fgets(STDIN));
        return $opcion;
    }
    
    function subMenu(){
        /**
        * Muestra un submenú para la opcion 4 de menu()
        * int $dos;
        * @return int
        */
        echo "\n---------------------------------------------";
        echo "\n1| Cargar una nueva función.";
        echo "\n2| Modificar una función.";
        echo "\n3| Eliminar una función.";
        echo "\n4| Mostrar la información de las funciones.";
        echo "\n5| Volver al menú anterior.";
        echo "\n---------------------------------------------";
        $dos = trim(fgets(STDIN));
        return $dos;
    }

    function subSubMenu(){
        /**
        * Muestra un submenú para la opcion 2 de subMenu()
        * int $tres;
        * @return int
        */
        echo "\n---------------------------------------------";
        echo "\n1| Modificar el nombre.";
        echo "\n2| Modificar la hora de inicio y duracion.";
        echo "\n3| Modificar el precio.";
        echo "\n4| Modificar otra funcion";
        echo "\n5| Volver al menú anterior.";
        echo "\n---------------------------------------------";
        $tres = trim(fgets(STDIN));
        return $tres;
    }

    function format($hhmm){
        /**
         * Inicializa un array con dos elementos de hasta 2 digitos c/u
         * @param $hhmm
         * @return array
         */
        if(959 < $hhmm or $hhmm<1100){
            $minutos = $hhmm % 100;
            $horas = ($hhmm - $minutos) / 100;
        }else{
            $minutos = $hhmm % 1000;
            $horas = ($hhmm - $minutos) / 1000;
        }
        $arrayHora = array($horas, $minutos);
        return $arrayHora;
    }

    function cuatro(){
        do{
            $dos = subMenu();
            switch($dos){
                case 1:
                    do{
                        echo "\nIngrese el nombre de la nueva función:";
                        $nm = trim(fgets(STDIN));
                        echo "\nIngrese la hora de inicio en formato HHmm: ";
                        $st = format(trim(fgets(STDIN)));
                        echo "\nIngrese la duracion en minutos: ";
                        $dr = trim(fgets(STDIN));
                        $j = count($funcion);
                        while(0<$j){
                            for($i=0; $i<count($funcion); $i++){
                                if($funcion[$j-1]->solap($st, $dr)){
                                    echo "\nLa función ingresada se solapará con la función ".$funcion[$j-1]->getNombre();
                                    echo "\nIngrese nuevamente los datos de la función evitando lo anterior mencionado.";
                                    $i--;
                                    continue 3;
                                }else{
                                    $j--;
                                }
                            }
                        }
                    if($j==0){
                        break;
                    }
                    }while($funcion[$j-1]->solap($st, $dr));
                    echo "\nIngrese el precio: ";
                    $pr = trim(fgets(STDIN));
                    $pos = count($funcion);
                    $funcion[$pos] = new Funcion($nm, $st, $dr, $pr);
                    break;
                case 2:
                    do{
                        echo "Ingrese el número de la funcion a modificar";
                        $pos = trim(fgets(STDIN)) - 1;
                        $ver = true;
                        if(is_int($pos) and 0<$pos and $pos<=count($funcion)){
                            $ver = false;
                        }elseif(is_int($pos) and 0>$pos or $pos>=count($funcion)){
                            echo "No existe la funcion, verifique el valor ingresado.";
                        }else{
                            echo "Ingrese una número entero.";
                        }
                    }while($ver);
                    cuatroDos();
                    break;
                case 3:
                    echo "Ingrese el numero de la funcion a eliminar:";
                    $pos = trim(fgets(STDIN)) - 1;
                    $ver = true;
                    if(is_int($pos) and 0<$pos and $pos<=count($funcion)){
                        unset($funcion[$pos]);
                        $funcion = array_values($funcion);
                        $ver = false;
                    }elseif(is_int($pos) and 0>$pos or $pos>=count($funcion)){
                        echo "No existe la funcion, verifique el valor ingresado.";
                    }else{
                        echo "Ingrese una número entero.";
                    }
                case 4:
                    for($i=0; $i<count($funcion); $i++){
                        $str .= "Función ".($i+1)."\n".$funcion[$i]."\n";
                    }
                    echo $str;
                    break;
                case 5: break;
                default:
                    echo "Opción inválida, intente nuevamente.";
                    break;
            }
        }while($dos != 5);
    }

    function cuatroDos(){
        do{
            $tres = subSubMenu();
            switch($tres){
                case 1:
                    echo "Ingrese el nuevo nombre: ";
                    $nm = trim(fgets(STDIN));
                    $funcion[$pos]->setNombre($nm);
                    break;
                case 2:
                    do{
                        echo "\nIngrese la hora de inicio en formato HHmm: ";
                        $st = format(trim(fgets(STDIN)));
                        echo "\nIngrese la duracion en minutos: ";
                        $dr = trim(fgets(STDIN));
                        $j = count($funcion);
                        while(0<$j){
                            for($i=0; $i<count($funcion); $i++){
                                if($funcion[$j-1]->solap($st, $dr) and $pos != ($j-1)){
                                    echo "\nLa función ingresada se solapará con la función ".$funcion[$j-1]->getNombre();
                                    echo "\nIngrese nuevamente los datos de la función evitando lo anterior mencionado.";
                                    $i--;
                                    continue 3;
                                }else{
                                    $j--;
                                }
                            }
                        }
                        if($j==0){
                            break;
                        }
                    }while($funcion[$j-1]->solap($st, $dr));
                    $funcion[$pos]->setHoraInicio($st);
                    $funcion[$pos]->duracion($dr);
                    break;
                case 3:
                    echo "Ingrese el nuevo precio: ";
                    $pr = trim(fgets(STDIN));
                    $funcion[$pos]->setPrecio($pr);
                    break;
                case 4:
                    echo "Ingrese el número de la funcion a modificar";
                    $pos = trim(fgets(STDIN)) - 1;
                    break;
                case 5: break;
                default:
                    echo "Opción inválida, intente nuevamente.";
                    break;
            }
        }while($tres != 5);
    }
?>