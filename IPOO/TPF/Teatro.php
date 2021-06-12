<?php
include_once "BaseDatos.php";
class Teatro{
    private $idTeatro;
	private $nombre;
	private $direccion;
	private $colObjFuncion;
	private $msjOp;


	public function __construct(){
		$this->idTeatro = 0;
		$this->nombre = "";
		$this->direccion = "";
		$this->colObjFuncion = "";
	}

	public function cargar($idTeatro,$nombre,$direccion,$colObjFuncion){		
		$this->setIdTeatro($idTeatro);
		$this->setNombre($nombre);
		$this->setDireccion($direccion);
		$this->setColObjFuncion($colObjFuncion);
    }
	
	
    public function setIdTeatro($idTeatro){
		$this->idTeatro=$idTeatro;
	}
	public function setNombre($nombre){
		$this->nombre=$nombre;
	}
	public function setDireccion($direccion){
		$this->direccion=$direccion;
	}
	public function setColObjFuncion($colObjFuncion){
		$this->colObjFuncion=$colObjFuncion;
	}
	public function setMsjOp($msjOp){
		$this->msjOp=$msjOp;
	}
	
	public function getIdTeatro(){
		return $this->idTeatro;
	}
	public function getNombre(){
		return $this->nombre ;
	}
	public function getDireccion(){
		return $this->direccion ;
	}
	public function getcolObjFuncion(){
		return $this->colObjFuncion ;
	}
	public function getMsjOp(){
		return $this->msjOp ;
	}

    public function colToStr($col){
        $str = "";
        foreach($col as $key){
            $str .= $key;
        }
        return $str;
    }
		
    public function Buscar($idTeatro){
		$base=new BaseDatos();
		$qryTeatro="SELECT * FROM teatro WHERE idTeatro=".$idTeatro;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($qryTeatro)){
				if($row2=$base->Registro()){					
				    $this->setIdTeatro($idTeatro);
					$this->setNombre($row2['nombre']);
					$this->setDireccion($row2['direccion']);
					/*ESTO NO $this->setColObjFuncion($row2['colObjFuncion']);
					*hay que buscar e instanciar todas las funciones para crear el array.
					*/
					$cnd = "idTeatro = ".$idTeatro;
					$objFuncion = new Funcion();
					$colObjFuncion = $objFuncion->listar($cnd);
					$this->setColObjFuncion($colObjFuncion);
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
					$idTeatro=$row2['idTeatro'];
					$Nombre=$row2['nombre'];
					$direccion=$row2['direccion'];
					$colObjFuncion=$row2['colObjFuncion'];
					$teat=new teat();
					$teat->cargar($idTeatro,$Nombre,$direccion,$colObjFuncion);
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
		$qryInsert="INSERT INTO teatro(idTeatro, direccion, nombre, colObjFuncion) 
				VALUES (".$this->getIdTeatro().",'".$this->getDireccion()."','".$this->getNombre()."','".$this->getcolObjFuncion()."')";
		if($base->Iniciar()){
			if($base->Ejecutar($qryInsert)){
			    $resp=  true;
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
		$qryUpdate="UPDATE teatro SET nombre='".$this->getNombre()."', direccion='".$this->getDireccion()."'
                           , colObjFuncion='".$this->getcolObjFuncion()."' WHERE idTeatro=". $this->getIdTeatro();
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
        $str = $this->colToStr($this->getColObjFuncion);
	    return "\nNombre: ".$this->getNombre().
               "\nDireccion:".$this->getDireccion().
               "\nFunciones: ".$str;
	}
}
?>