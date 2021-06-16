<?php
include_once "./ORM/FuncionCine.php";
class abmCine{
    function insertCine($data){
        $objCine = new Cine();
        $objCine->setNombre($data['nombre']);
        $objCine->setHoraInicio($data['horaInicio']);
        $objCine->setDuracion($data['duracion']);
        $objCine->setPrecio($data['precio']);
        $objCine->setObjTeatro($data['objTeatro']);
        $objCine->setGenero($data['genero']);
        $objCine->setPaisOrigen($data['paisOrigen']);
        $objCine->setPorcInc($data['porcInc']);
        $costo = $data['precio'] * (($data['porcInc'] * 0.01) + 1);
        $objCine->setCosto($costo);
        $rpta = $objCine->insertar();
        if($rpta){
            return $objCine;
        }else{
            return null;
        }
    }

    function selectCine($idFuncion){
        $objCine = new Cine();
        if($objCine->buscar($idFuncion)){
            return $objCine;
        }else{
            return null;
        }

        
    }
    
    function updateCine($arrCine){
        echo "Ingrese el genero: ";
        $arrCine['genero'] = trim(fgets(STDIN));
        echo "Ingrese el país de origen: ";
        $arrCine['paisOrigen'] = trim(fgets(STDIN));
        $arrCine['porcInc'] = 65;
        $objCine = new Cine();
        $objCine->cargar($arrCine);
        $rpta = $objCine->modificar();
        return $rpta;
    }

    function deleteCine($objCine){
        $rpta = $objCine->eliminar();
        return $rpta;
    }
}
?>