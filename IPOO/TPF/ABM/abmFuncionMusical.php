<?php
include_once "./ORM/FuncionMusical.php";
class abmMusical{
    function insertMusical($data){
        $objMusical = new Musical();
        $objMusical->setNombre($data['nombre']);
        $objMusical->setHoraInicio($data['horaInicio']);
        $objMusical->setDuracion($data['duracion']);
        $objMusical->setPrecio($data['precio']);
        $objMusical->setObjTeatro($data['objTeatro']);
        $objMusical->setDirector($data['director']);
        $objMusical->setCantPersonas($data['cantPersonas']);
        $objMusical->setPorcInc($data['porcInc']);
        $costo = $data['precio'] * (($data['porcInc'] * 0.01) + 1);
        $objMusical->setCosto($costo);
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
    
    function updateMusical($arrMusical){
        echo "Ingrese el director: ";
        $arrMusical['director'] = trim(fgets(STDIN));
        echo "Ingrese la cantidad de personas en escena: ";
        $arrMusical['cantPersonas'] = trim(fgets(STDIN));
        $arrMusical['porcInc'] = 12;
        $arrMusical['costo'] = $arrMusical['precio'] * (($arrMusical['porcInc'] * 0.01) + 1);
        $objMusical = new Musical();
        $objMusical->cargar($arrMusical);
        $rpta = $objMusical->modificar();
        return $rpta;
    }

    function deleteMusical($objMusical){
        $rpta = $objMusical->eliminar();
        return $rpta;
    }
}
?>