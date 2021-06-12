<?php
include_once "BaseDatos.php";
class Funcion{
    /**
    * Atributos
    * String $nombre,
    * array int $horaInicio
    * int $duracion
    * int $precio
    */
    private $idFuncion;
    private $nombre;
    private $horaInicio;
    private $duracion;
    private $precio;
    private $costo;
    private $objTeatro;
    private $msjOp;

    //Metodo Constructor
    public function __construct(){
        $this->$idFuncion = 0;
        $this->nombre = "";
        $this->horaInicio = "";
        $this->duracion = "";
        $this->precio = "";
        $this->costo = "";
        $this->objTeatro = "";
    }
    public function cargar($nombre, $horaInicio, $duracion, $precio, $costo, $objTeatro){
        $this->setNombre($nombre);
        $this->setHoraInicio($horaInicio);
        $this->setDuracion($duracion);
        $this->setPrecio($precio);
        $this->setCosto($costo);
        $this->setObjTeatro($objTeatro);
    }

    //Modificadoras
    public function setIdFuncion($idFuncion){
        $this->idFuncion = $idFuncion;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setHoraInicio($horaInicio){
        $this->horaInicio = $horaInicio;
    }
    public function setDuracion($duracion){
        $this->duracion = $duracion;
    }
    public function setPrecio($precio){
        $this->precio = $precio;
    }
    public function setCosto($costo){
        $this->costo = $costo;
    }
    public function setObjTeatro($ObjTeatro){
        $this->objTeatro = $objTeatro;
    }
    public function setMsjOp($msjOp){
        $this->msjOp = $msjOp;
    }
    //Observadoras
    public function getIdFuncion($idFuncion){
        return $this->idFuncion;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getHoraInicio(){
        return $this->horaInicio;
    }
    public function getDuracion(){
        return $this->duracion;
    }
    public function getPrecio(){
        return $this->precio;
    }
    public function getCosto(){
        return $this->costo;
    }
    public function getObjTeatro(){
        return $this->objTeatro;
    }
    public function getMsjOp($msjOp){
        return $this->msjOp;
    }
    //Metodos
    public function buscar($idFuncion){
        $base = new BaseDatos();
        $qryFuncion = "SELECT * FROM funcion WHERE idFuncion=".$idFuncion;
        $resp = false;
        if($base->Iniciar()){
            if($base->Ejecutar($qryFuncion)){
                if($row2=$base->Registro()){
                    $this->setNrodoc($idFuncion);
                    $this->setNombre($row2['nombre']);
                    $this->setHoraInicio($row2['horaInicio']);
                    $this->setDuracion($row2['duracion']);
                    $this->setPrecio($row2['precio']);
                    $this->setCosto($row2['costo']);
                    $idTeatro = $row2['idTeatro'];
                    $objTeatro->buscar($idTeatro);
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
        $qryFuncion.=" ORDER BY nombre";
        if($base->Iniciar()){
            if($base->Ejecutar($qryFuncion)){				
                $arrayFuncion= array();
                while($row2 = $base->Registro()){
                    $idFuncion = $row2['idFuncion'];
                    $nombre = $row2['nombre'];
                    $horaInicio = $row2['horaInicio'];
                    $duracion = $row2['duracion'];
                    $precio = $row2['precio'];
                    $costo = $row2['costo'];
                    $idTeatro = $row2['idTeatro'];
                    $objTeatro = new Teatro();
                    $objTeatro->buscar($idTeatro);
                    $fnc = new Funcion();
                    $fnc->cargar($idFuncion, $nombre, $horaInicio, $duracion, $precio, $costo, $objTeatro);
                    array_push($arrayFuncion, $fnc);
                }                
            }else{
                $this->setmensajeoperacion($base->getError());
            }
        }else{
            $this->setmensajeoperacion($base->getError());
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
			if($base->Ejecutar($qryInsert)){
			    $resp = true;
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
				$this->setmensajeoperacion($base->getError());
			}
		}else{
				$this->setmensajeoperacion($base->getError());
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
				$this->setmensajeoperacion($base->getError());
            }
		}else{
			$this->setmensajeoperacion($base->getError());
		}
		return $resp; 
	}


    public function __toString(){
        return "\nNombre de la función: ".$this->getNombre().
               "\nHora de inicio: ".$this->getHoraInicio().
               "\nDuración: ".$this->getDuracion().
               "\nPrecio: $".$this->getPrecio().
               "\nCosto: $".$this->getCosto();
    }
}
?>