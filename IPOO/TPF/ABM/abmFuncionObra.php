<?php
class abmObra{
    function insertObra($data){
        $objObra = new Obra();
        $objObra->setNombre($data['nombre']);
        $objObra->setHoraInicio($data['horaInicio']);
        $objObra->setDuracion($data['duracion']);
        $objObra->setPrecio($data['precio']);
        $objObra->setCosto($data['costo']);
        $objObra->setObjTeatro($data['objTeatro']);
        $objObra->setPorcInc($data['porcInc']);
        $rpta = $objObra->insertar();
        if($rpta){
            return $objObra;
        }else{
            return null;
        }
    }

    function selectObra($idFuncion){
        $objObra = new Obra();
        if($objObra->buscar($idFuncion)){
            return $objObra;
        }else{
            return null;
        }
    }
    //update de nombre
    function updateNomObra($objObra, $nombre){
        $objObra->setNombre($nombre);
        $rpta = $objObra->modificar();
        return $rpta;
    }

    function deleteObra($objObra){
        $rpta = $objObra->eliminar();
        return $rpta;
    }
}
?>