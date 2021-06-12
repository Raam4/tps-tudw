<?php
    include_once "BaseDatos.php";
    include_once "Funcion.php";
    class Cine extends Funcion{
    
        private $genero;
        private $paisOrigen;
        private $porcInc;
    
        public function __construct(){
            parent::__construct();
            $this->genero = "";
            $this->paisOrigen = "";
            $this->porcInc = "";
        }
    
        public function cargar($nombre, $horaInicio, $duracion, $precio, $costo, $genero, $paisOrigen, $porcInc){
            parent::cargar($nombre, $horaInicio, $duracion, $precio, $costo);
            $this->setGenero($genero);
            $this->paisOrigen($paisOrigen);
            $this->setPorcInc($porcInc);
        }

        public function setGenero($genero){
            $this->genero = $genero;
        }
        public function getGenero(){
            return $this->genero;
        }

        public function setPaisOrigen($paisOrigen){
            $this->paisOrigen = $paisOrigen;
        }
        public function getPaisOrigen(){
            return $this->paisOrigen;
        }

        public function setPorcInc($porcInc){
            $this->porcInc = $porcInc;
        }
        public function getPorcInc(){
            return $this->porcInc;
        }
    
    
        public function buscar($idFuncion){
            $base=new BaseDatos();
            $qry="SELECT * FROM cine WHERE idFuncion=".$idFuncion;
            $resp= false;
            if($base->Iniciar()){
                if($base->Ejecutar($qry)){
                    if($row2=$base->Registro()){
                        parent::buscar($idFuncion);
                        $this->setGenero($row2['genero']);
                        $this->setPaisOrigen($row2['paisOrigen']);
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
            $consulta = "SELECT * FROM cine ";
            if($condicion!=""){
                $consulta=$consulta.' WHERE '.$condicion;
            }
            $consulta.=" ORDER BY nombre";
            if($base->Iniciar()){
                if($base->Ejecutar($consulta)){				
                    $arreglo = array();
                    while($row2=$base->Registro()){
                        $obj=new Cine();
                        $obj->Buscar($row2['idFuncion']);
                        array_push($arreglo,$obj);
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
                $consultaInsertar="INSERT INTO cine(idFuncion, genero, paisOrigen, porcInc)
                    VALUES (".parent::getIdFuncion().",'".$this->getGenero()."','".$this->getPaisOrigen()."',".$this->getPorcInc().")";
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
                $qryUpdate="UPDATE cine SET porcInc=".$this->getPorcInc().", genero='".$this->getGenero()."', paisOrigen='".$this->getPaisOrigen()."' WHERE idFuncion=". parent::getIdFuncion();
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
                    $qryDelete="DELETE FROM cine WHERE idFuncion=".parent::getIdFuncion();
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
            return parent::__toString().
                   "\n Genero: ".$this->getGenero().
                   "\n Pais de Origen: ".$this->getPaisOrigen().
                   "\n Porcentaje de Incremento: ".$this->getPorcInc();
        }
    }
?>