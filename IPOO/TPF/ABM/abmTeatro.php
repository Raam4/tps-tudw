<?php
include_once "./ORM/Teatro.php";
include_once "./ORM/Funcion.php";
class abmTeatro{
    function insertTeatro($nombre, $direccion){
        $objTeatro = new Teatro();
        $objTeatro->setNombre($nombre);
        $objTeatro->setDireccion($direccion);
        $rpta = $objTeatro->insertar();
        if($rpta){
            return $objTeatro;
        }else{
            return null;
        }
    }

    function selectTeatro($idTeatro){
        $objTeatro = new Teatro();
        $rpta = $objTeatro->buscar($idTeatro, True);
        if($rpta){
            return $objTeatro;
        }else{
            return null;
        }
    }

    //update de nombre
    function updateTeatro($objTeatro, $var, $par){
        if($par){
            $objTeatro->setNombre($var);
        }else{
            $objTeatro->setDireccion($var);
        }
        $rpta = $objTeatro->modificar();
        return $rpta;
    }

    function deleteTeatro($objTeatro){
        $abmfnc = new abmFuncion();
        $colObjFuncion = $objTeatro->getColObjFuncion();
        if($colObjFuncion != 0){
            foreach($colObjFuncion as $key){
                $abmfnc->deleteFuncion($key);
            }
        }
        $rpta = $objTeatro->eliminar();
        return $rpta;
    }

    function listTeatro(){
        $objTeatro = new Teatro();
        $colObjTeatro = $objTeatro->listar($var = "");
        return $colObjTeatro;
    }

    function calculaCostos($objTeatro){
        $colObjFuncion = $objTeatro->getColObjFuncion();
        $costoTeatro = 0;
        foreach($colObjFuncion as $key){
            $costoTeatro += $key->getCosto();
        }
        return $costoTeatro;
    }

    function devuelveFunciones($objTeatro){
        $colObjFuncion = $objTeatro->getColObjFuncion();
        return $colObjFuncion;
    }

}
?>