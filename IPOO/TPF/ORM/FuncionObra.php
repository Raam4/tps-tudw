<?php
include_once "BaseDatos.php";
include_once "Funcion.php";
class Obra extends Funcion{

    private $fnc;

    public function __construct(){
        parent::__construct();
        $this->fnc['porcInc'] = "";
    }

    public function cargar($fnc){
        parent::cargar($fnc);
        $this->setPorcInc($fnc['porcInc']);
    }

    public function setPorcInc($porcInc){
        $this->fnc['porcInc'] = $porcInc;
    }
    
    public function getPorcInc(){
        return $this->fnc['porcInc'];
    }


    public function buscar($idFuncion){
		$base=new BaseDatos();
		$qry="SELECT * FROM obra WHERE idFuncion=".$idFuncion;
		$resp= false;
		if($base->Iniciar()){
		    if($base->Ejecutar($qry)){
				if($row2=$base->Registro()){
				    parent::buscar($idFuncion);
				    $this->setPorcInc($row2['porcInc']);
					$resp = true;
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
	    $arreglo = null;
		$base = new BaseDatos();
		$consulta = "SELECT * FROM obra ";
		if($condicion!=""){
		    $consulta=$consulta.' WHERE '.$condicion;
		}
		echo $consulta;
		$consulta.=" ORDER BY idFuncion";
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){				
			    $arreglo = array();
				while($row2=$base->Registro()){
					$obj=new Obra();
					$obj->buscar($row2['idFuncion']);
					array_push($arreglo, $obj);
				}
		 	}else{
		 	    $this->setMsjOp($base->getError());
			}
		}else{
		 	$this->setMsjOp($base->getError());
		}	
		return $arreglo;
	}
    
    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		if(parent::insertar()){
		    $consultaInsertar="INSERT INTO obra(idFuncion)
				VALUES (".parent::getIdFuncion().")";
		    if($base->Iniciar()){
		        if($base->Ejecutar($consultaInsertar)){
		            $resp =  true;
		        }else{
		        	$this->setMsjOp($base->getError());
		        }
		    }else{
		        $this->setMsjOp($base->getError());
		    }
		}
		return $resp;
	}
	
	public function modificar(){
	    $resp = false; 
	    $base = new BaseDatos();
	    if(parent::modificar()){
	        $qryUpdate="UPDATE obra SET porcInc=".$this->getPorcInc()." WHERE idFuncion=". parent::getIdFuncion();
	        if($base->Iniciar()){
	            if($base->Ejecutar($qryUpdate)){
	                $resp = true;
	            }else{
	                $this->setMsjOp($base->getError());
	            }
	        }else{
	            $this->setMsjOp($base->getError());
	        }
	    }
		return $resp;
	}

	public function eliminar(){
		$base = new BaseDatos();
		$resp = false;
		if($base->Iniciar()){
				$qryDelete="DELETE FROM obra WHERE idFuncion=".parent::getIdFuncion();
				if($base->Ejecutar($qryDelete)){
				    if(parent::eliminar()){
				        $resp = true;
				    }
				}else{
					$this->setMsjOp($base->getError());
				}
		}else{
			$this->setMsjOp($base->getError());
		}
		return $resp; 
	}

	public function __toString(){
        return parent::__toString()."\n Porcentaje de Incremento: ".$this->getPorcInc()."\n";
    }
}
?>