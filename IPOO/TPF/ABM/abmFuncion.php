<?php
class abmFuncion{

    function selectFuncion($idFuncion){
        $objFuncionEsp = null;
        $abmObra = new abmObra();
        $abmCine = new abmCine();
        $abmMusical = new abmMusical();
        if(!is_null($objObra = $abmObra->selectObra($idFuncion))){
            $objFuncionEsp = $objObra;
        }
        if(!is_null($objCine = $abmCine->selectCine($idFuncion))){
            $objFuncionEsp = $objCine;
        }
        if(!is_null($objMusical = $abmMusical->selectMusical($idFuncion))){
            $objFuncionEsp = $objMusical;
        }
        return $objFuncionEsp;
    }

    function listFuncion(){
        $objFuncion = new Funcion();
        $colObjFuncion = $objFuncion->listar($var = "");
        $colObjFuncionEsp = array();
        if(!is_null($colObjFuncion)){
            $abmObra = new abmObra();
            $abmCine = new abmCine();
            $abmMusical = new abmMusical();
            foreach($colObjFuncion as $key){
                $idFuncion = $key->getIdFuncion();
                if(!is_null($objObra = $abmObra->selectObra($idFuncion))){
                    array_push($colObjFuncionEsp, $objObra);
                }
                if(!is_null($objCine = $abmCine->selectCine($idFuncion))){
                    array_push($colObjFuncionEsp, $objCine);
                }
                if(!is_null($objMusical = $abmMusical->selectMusical($idFuncion))){
                    array_push($colObjFuncionEsp, $objMusical);
                }
            }
        }
        return $colObjFuncionEsp;
    }

    function updateFuncion($objFuncionEsp, $objupd){
        $abmObra = new abmObra();
        $abmCine = new abmCine();
        $abmMusical = new abmMusical();
        $objupd['idFuncion'] = $objFuncionEsp->getIdFuncion();;
        if(!is_null($abmObra->selectObra($objupd['idFuncion']))){
            $rtn = $abmObra->updateObra($objupd);
        }
        if(!is_null($abmCine->selectCine($objupd['idFuncion']))){
            $rtn = $abmCine->updateCine($objupd);
        }
        if(!is_null($abmMusical->selectMusical($objupd['idFuncion']))){
            $rtn = $abmMusical->updateMusical($objupd);
        }
        return $rtn;
    }

    function deleteFuncion($objFuncionEsp){
        $abmObra = new abmObra();
        $abmCine = new abmCine();
        $abmMusical = new abmMusical();
        $idFuncionEsp = $objFuncionEsp->getIdFuncion();
        if(!is_null($objObra = $abmObra->selectObra($idFuncionEsp))){
            $rtn = $abmObra->deleteObra($objObra);
        }
        if(!is_null($objCine = $abmCine->selectCine($idFuncionEsp))){
            $rtn = $abmCine->deleteCine($objCine);
        }
        if(!is_null($objMusical = $abmMusical->selectMusical($idFuncionEsp))){
            $rtn = $abmMusical->deleteMusical($objMusical);
        }
        return $rtn;
    }

    function devuelveHoras($objFuncion){
        $horas['inicio'] = $objFuncion->getHoraInicio();
        $horas['duracion'] = $objFuncion->getDuracion();
        return $horas;
    }
}
?>