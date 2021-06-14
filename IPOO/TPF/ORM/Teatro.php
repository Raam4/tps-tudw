<?php
include_once "BaseDatos.php";
include_once "Funcion.php";
include_once "FuncionObra.php";
include_once "FuncionCine.php";
include_once "FuncionMusical.php";
class Teatro{
	private $ttr;
    /*private $idTeatro;
	private $nombre;
	private $direccion;
	private $colObjFuncion;
	private $msjOp;*/


	public function __construct(){
		$this->ttr['nombre'] = "";
		$this->ttr['direccion'] = "";
		$this->ttr['colObjFuncion'] = "";
	}

	public function cargar($ttr){		
		$this->setIdTeatro($ttr['idTeatro']);
		$this->setNombre($ttr['nombre']);
		$this->setDireccion($ttr['direccion']);
		$this->setColObjFuncion($ttr['colObjFuncion']);
    }
	
	
    public function setIdTeatro($idTeatro){
		$this->ttr['idTeatro'] = $idTeatro;
	}
	public function setNombre($nombre){
		$this->ttr['nombre'] = $nombre;
	}
	public function setDireccion($direccion){
		$this->ttr['direccion'] = $direccion;
	}
	public function setColObjFuncion($colObjFuncion){
		$this->ttr['colObjFuncion'] = $colObjFuncion;
	}
	public function setMsjOp($msjOp){
		$this->ttr['msjOp'] = $msjOp;
	}
	
	public function getIdTeatro(){
		return $this->ttr['idTeatro'];
	}
	public function getNombre(){
		return $this->ttr['nombre'];
	}
	public function getDireccion(){
		return $this->ttr['direccion'];
	}
	public function getcolObjFuncion(){
		return $this->ttr['colObjFuncion'];
	}
	public function getMsjOp(){
		return $this->ttr['msjOp'];
	}

    public function colToStr($col){
        $str = "";
        foreach($col as $key){
            $str .= $key;
        }
        return $str;
    }
		
    public function buscar($idTeatro, $param){
		$base=new BaseDatos();
		$qryTeatro="SELECT * FROM teatro WHERE idTeatro=".$idTeatro;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($qryTeatro)){
				if($row2=$base->Registro()){					
				    $this->setIdTeatro($idTeatro);
					$this->setNombre($row2['nombre']);
					$this->setDireccion($row2['direccion']);
					$cnd = "idTeatro = ".$idTeatro;
					/*$objObra = new Obra();
					$colObjObra = $objObra->listar($cnd);
					if(is_null($colObjObra)){
						$colObjObra = array();
					}
					$objCine = new Cine();
					$colObjCine = $objCine->listar($cnd);
					if(is_null($colObjCine)){
						$colObjCine = array();
					}
					$objMusical = new Musical();
					$colObjMusical = $objMusical->listar($cnd);
					if(is_null($colObjMusical)){
						$colObjMusical = array();
					}
					$colObjFuncion = array_merge($colObjObra, $colObjCine, $colObjMusical);*/
					if($param){
						$ObjFuncion = new Funcion();
						$colObjFuncion = $ObjFuncion->listar($cnd);
						if(is_null($colObjFuncion)){
							$colObjFuncion = array();
						}
						$this->setColObjFuncion($colObjFuncion);
					}
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
	    $arrayTeatro = null;
		$base=new BaseDatos();
		$qryTeatro="SELECT * FROM teatro ";
		if ($condicion!=""){
		    $qryTeatro=$qryTeatro.' WHERE '.$condicion;
		}
		$qryTeatro.=" ORDER BY idTeatro";
		if($base->Iniciar()){
			if($base->Ejecutar($qryTeatro)){				
				$arrayTeatro= array();
				while($row2=$base->Registro()){
					$ttr['idTeatro']=$row2['idTeatro'];
					$ttr['nombre']=$row2['nombre'];
					$ttr['direccion']=$row2['direccion'];
					$cnd = "idTeatro = ".$ttr['idTeatro'];
					/*$objObra = new Obra();
					$colObjObra = $objObra->listar($cnd);
					$objCine = new Cine();
					$colObjCine = $objCine->listar($cnd);
					$objMusical = new Musical();
					$colObjMusical = $objMusical->listar($cnd);
					$ttr['$colObjFuncion'] = array_merge($colObjObra, $colObjCine, $colObjMusical);*/
					$ObjFuncion = new Funcion();
					$ttr['colObjFuncion'] = $ObjFuncion->listar($cnd);
					$teat=new Teatro();
					$teat->cargar($ttr);
					array_push($arrayTeatro,$teat);
				}
		 	}else{
		 		$this->setMsjOp($base->getError());
			}
		}else{
		 	$this->setMsjOp($base->getError());
		}	
		return $arrayTeatro;
	}	

	public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$qryInsert="INSERT INTO teatro(nombre, direccion) 
				VALUES ('".$this->getNombre()."','".$this->getDireccion()."')";
		if($base->Iniciar()){
			$id = $base->devuelveIDInsercion($qryInsert);
			if(!is_null($id)){
			    $resp = true;
                $this->setIdTeatro($id);
			}else{
				$this->setMsjOp($base->getError());
			}
		}else{
			$this->setMsjOp($base->getError());
		}
		return $resp;
	}
	
	public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
		$qryUpdate="UPDATE teatro SET nombre='".$this->getNombre()."', direccion='".$this->getDireccion()."' WHERE idTeatro=". $this->getIdTeatro();
		if($base->Iniciar()){
			if($base->Ejecutar($qryUpdate)){
			    $resp=  true;
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
			if($base->Iniciar()){
				$colFunciones = $this->getColObjFuncion();
				if(count($colFunciones) != 0){
					foreach($colFunciones as $key){
						$key->eliminar();
					}
				}
			}
			$qryDelete="DELETE FROM teatro WHERE idTeatro=".$this->getIdTeatro();
			if($base->Ejecutar($qryDelete)){
				$resp=  true;
			}else{
				$this->setMsjOp($base->getError());
			}
		}else{
			$this->setMsjOp($base->getError());
		}
		return $resp; 
	}

	public function __toString(){
		$col = $this->getColObjFuncion();
		if($col != ""){
        	$str = $this->colToStr($col);
		}else{
			$str = "";
		}
	    return "\nID teatro: ".$this->getIdTeatro().
			   "\nNombre: ".$this->getNombre().
               "\nDireccion: ".$this->getDireccion().
               "\nFunciones:\n".$str."\n";
	}
}
?>