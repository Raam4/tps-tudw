<?php
include_once "./ORM/Teatro.php";
class abmTeatro{
    function insertTeatro($nombre, $direccion){
        $objTeatro = new Teatro();
        $objTeatro->setNombre($nombre);
        $objTeatro->setDireccion($direccion);
        $rpta = $objTeatro->insertar();
        return $rpta;
    }

    function selectTeatro($idTeatro){
        $objTeatro = new Teatro();
        $objTeatro->buscar($idTeatro);
        return $objTeatro;
    }
    //update de nombre
    function updateNomTeatro($objTeatro, $nombre){
        $objTeatro->setNombre($nombre);
        $rpta = $objTeatro->modificar();
        return $rpta;
    }

    function deleteTeatro($objTeatro){
        $rpta = $objTeatro->eliminar();
        return $rpta;
    }

    
}
?>