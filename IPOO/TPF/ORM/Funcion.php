<?php
include_once "BaseDatos.php";
class Funcion{
    private $fnc;
    /*private $nombre;
    private $horaInicio;
    private $duracion;
    private $precio;
    private $costo;
    private $objTeatro;
    private $msjOp;*/

    //Metodo Constructor
    public function __construct(){
        $this->fnc['idFuncion'] = "";
        $this->fnc['nombre'] = "";
        $this->fnc['horaInicio'] = "";
        $this->fnc['duracion'] = "";
        $this->fnc['precio'] = "";
        $this->fnc['costo'] = "";
        $this->fnc['objTeatro'] = "";
    }

    public function cargar($fnc){
        $this->setIdFuncion($fnc['idFuncion']);
        $this->setNombre($fnc['nombre']);
        $this->setHoraInicio($fnc['horaInicio']);
        $this->setDuracion($fnc['duracion']);
        $this->setPrecio($fnc['precio']);
        $this->setCosto($fnc['costo']);
        $this->setObjTeatro($fnc['objTeatro']);
    }
    
    
    public function setIdFuncion($idFuncion){
        $this->fnc['idFuncion'] = $idFuncion;
    }
    public function setNombre($nombre){
        $this->fnc['nombre'] = $nombre;
    }
    public function setHoraInicio($horaInicio){
        $this->fnc['horaInicio'] = $horaInicio;
    }
    public function setDuracion($duracion){
        $this->fnc['duracion'] = $duracion;
    }
    public function setPrecio($precio){
        $this->fnc['precio'] = $precio;
    }
    public function setCosto($costo){
        $this->fnc['costo'] = $costo;
    }
    public function setObjTeatro($objTeatro){
        $this->fnc['objTeatro'] = $objTeatro;
    }
    public function setMsjOp($msjOp){
        $this->fnc['msjOp'] = $msjOp;
    }
    //Observadoras
    public function getIdFuncion(){
        return $this->fnc['idFuncion'];
    }
    public function getNombre(){
        return $this->fnc['nombre'];
    }
    public function getHoraInicio(){
        return $this->fnc['horaInicio'];
    }
    public function getDuracion(){
        return $this->fnc['duracion'];
    }
    public function getPrecio(){
        return $this->fnc['precio'];
    }
    public function getCosto(){
        return $this->fnc['costo'];
    }
    public function getObjTeatro(){
        return $this->fnc['objTeatro'];
    }
    public function getMsjOp(){
        return $this->fnc['msjOp'];
    }
    
    //Metodos
    public function buscar($idFuncion){
        $base = new BaseDatos();
        $qryFuncion = "SELECT * FROM funcion WHERE idFuncion=".$idFuncion;
        $resp = false;
        if($base->Iniciar()){
            if($base->Ejecutar($qryFuncion)){
                if($row2=$base->Registro()){
                    $this->setIdFuncion($idFuncion);
                    $this->setNombre($row2['nombre']);
                    $this->setHoraInicio($row2['horaInicio']);
                    $this->setDuracion($row2['duracion']);
                    $this->setPrecio($row2['precio']);
                    $this->setCosto($row2['costo']);
                    $idTeatro = $row2['idTeatro'];
                    $objTeatro = new Teatro();
                    $objTeatro->buscar($idTeatro, True);
                    $this->setObjTeatro($objTeatro);
                    $resp= true;
                }
            }else{
                $this->setMsjOp($base->getError()); 
            }
        }else{
            $this->setMsjOp($base->getError());
        }		
        return $resp;
    }
    public function listar($condicion=""){
        $arrayFuncion = null;
        $base=new BaseDatos();
        $qryFuncion="SELECT * FROM funcion";
        if($condicion!=""){
            $qryFuncion=$qryFuncion.' WHERE '.$condicion;
        }
        $qryFuncion.=" ORDER BY idFuncion";
        if($base->Iniciar()){
            if($base->Ejecutar($qryFuncion)){				
                $arrayFuncion= array();
                while($row2 = $base->Registro()){
                    $arr = array();
                    $arr['idFuncion'] = $row2['idFuncion'];
                    $arr['nombre'] = $row2['nombre'];
                    $arr['horaInicio'] = $row2['horaInicio'];
                    $arr['duracion'] = $row2['duracion'];
                    $arr['precio'] = $row2['precio'];
                    $arr['costo'] = $row2['costo'];
                    $idTeatro = $row2['idTeatro'];
                    $arr['objTeatro'] = new Teatro();
                    $arr['objTeatro']->buscar($idTeatro, False);
                    $fun = new Funcion();
                    $fun->cargar($arr);
                    array_push($arrayFuncion, $fun);
                }                
            }else{
                $this->setMsjOp($base->getError());
            }
        }else{
            $this->setMsjOp($base->getError());
        }	
        return $arrayFuncion;
    }

    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
        $objTeatro = $this->getObjTeatro();
        $idTeatro = $objTeatro->getIdTeatro();
		$qryInsert="INSERT INTO funcion(nombre, horaInicio, duracion, precio, costo, idTeatro) 
				VALUES ('".$this->getNombre()."','".$this->getHoraInicio()."','".$this->getDuracion()."',".$this->getPrecio().",".$this->getCosto().",".$idTeatro.")";
		if($base->Iniciar()){
            $id = $base->devuelveIDInsercion($qryInsert);
			if(!is_null($id)){
			    $resp = true;
                $this->setIdFuncion($id);
			}else{
				$this->setMsjOp($base->getError());
            }
		} else{
			$this->setMsjOp($base->getError());
		}
		return $resp;
	}

    public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
        $objTeatro = $this->getObjTeatro();
        $idTeatro = $objTeatro->getIdTeatro();
		$qryUpdate="UPDATE funcion SET nombre='".$this->getNombre()."', horaInicio='".$this->getHoraInicio()."', duracion='".$this->getDuracion()."', precio=".$this->getPrecio().", costo=".$this->getCosto().", idTeatro=".$idTeatro." WHERE idFuncion=". $this->getIdFuncion();
		if($base->Iniciar()){
			if($base->Ejecutar($qryUpdate)){
			    $resp = true;
			}else{
				$this->setMsjOp($base->getError());
			}
		}else{
				$this->setMsjOp($base->getError());
		}
		return $resp;
	}

    public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
			$qryDelete="DELETE FROM funcion WHERE idFuncion=".$this->getIdFuncion();
			if($base->Ejecutar($qryDelete)){
			    $resp = true;
			}else{
				$this->setMsjOp($base->getError());
            }
		}else{
			$this->setMsjOp($base->getError());
		}
		return $resp; 
	}


    public function __toString(){
        return "\nID de Funcion: ".$this->getIdFuncion().
               "\nNombre de la función: ".$this->getNombre().
               "\nHora de inicio: ".$this->getHoraInicio().
               "\nDuración: ".$this->getDuracion().
               "\nPrecio: $".$this->getPrecio().
               "\nCosto: $".$this->getCosto().
               "\nObj Teatro: ".$this->getObjTeatro();
    }
}
?>