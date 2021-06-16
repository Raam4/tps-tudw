<?php
include_once "./ORM/FuncionObra.php";
class abmObra{
    function insertObra($data){
        $objObra = new Obra();
        $objObra->setNombre($data['nombre']);
        $objObra->setHoraInicio($data['horaInicio']);
        $objObra->setDuracion($data['duracion']);
        $objObra->setPrecio($data['precio']);
        $objObra->setObjTeatro($data['objTeatro']);
        $objObra->setPorcInc($data['porcInc']);
        $costo = $data['precio'] * (($data['porcInc'] * 0.01) + 1);
        $objCine->setCosto($costo);
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
    
    function updateObra($arrObra){
        $arrObra['porcInc'] = 45;
        $objObra = new Obra();
        $objObra->cargar($arrObra);
        $rpta = $objObra->modificar();
        return $rpta;
    }

    function deleteObra($objObra){
        $rpta = $objObra->eliminar();
        return $rpta;
    }
}
?>