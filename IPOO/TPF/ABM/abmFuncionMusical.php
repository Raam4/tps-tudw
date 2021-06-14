<?php
class abmMusical{
    function insertMusical($data){
        $objMusical = new Musical();
        $objMusical->setNombre($data['nombre']);
        $objMusical->setHoraInicio($data['horaInicio']);
        $objMusical->setDuracion($data['duracion']);
        $objMusical->setPrecio($data['precio']);
        $objMusical->setCosto($data['costo']);
        $objMusical->setObjTeatro($data['objTeatro']);
        $objMusical->setDirector($data['director']);
        $objMusical->setCantPersonas($data['cantPersonas']);
        $objMusical->setPorcInc($data['porcInc']);
        $rpta = $objMusical->insertar();
        if($rpta){
            return $objMusical;
        }else{
            return null;
        }
    }

    function selectMusical($idFuncion){
        $objMusical = new Musical();
        if($objMusical->buscar($idFuncion)){
            return $objMusical;
        }else{
            return null;
        }
    }
    //update de nombre
    function updateNomMusical($objMusical, $nombre){
        $objMusical->setNombre($nombre);
        $rpta = $objMusical->modificar();
        return $rpta;
    }

    function deleteMusical($objMusical){
        $rpta = $objMusical->eliminar();
        return $rpta;
    }
}
?>