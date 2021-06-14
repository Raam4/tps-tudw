<?php
class abmCine{
    function insertCine($data){
        $objCine = new Cine();
        $objCine->setNombre($data['nombre']);
        $objCine->setHoraInicio($data['horaInicio']);
        $objCine->setDuracion($data['duracion']);
        $objCine->setPrecio($data['precio']);
        $objCine->setCosto($data['costo']);
        $objCine->setObjTeatro($data['objTeatro']);
        $objCine->setGenero($data['genero']);
        $objCine->setPaisOrigen($data['paisOrigen']);
        $objCine->setPorcInc($data['porcInc']);
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
    //update de nombre
    function updateNomCine($objCine, $nombre){
        $objCine->setNombre($nombre);
        $rpta = $objCine->modificar();
        return $rpta;
    }

    function deleteCine($objCine){
        $rpta = $objCine->eliminar();
        return $rpta;
    }
}
?>