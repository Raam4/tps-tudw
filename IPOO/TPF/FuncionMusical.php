<?php
    include_once "BaseDatos.php";
    include_once "Funcion.php";
    class Musical extends Funcion{
    
        private $director;
        private $cantPersonas;
        private $porcInc;
    
        public function __construct(){
            parent::__construct();
            $this->director = "";
            $this->cantPersonas = "";
            $this->porcInc = "";
        }
    
        public function cargar($nombre, $horaInicio, $duracion, $precio, $costo, $director, $cantPersonas, $porcInc){
            parent::cargar($nombre, $horaInicio, $duracion, $precio, $costo);
            $this->setDirector($director);
            $this->cantPersonas($cantPersonas);
            $this->setPorcInc($porcInc);
        }

        public function setDirector($director){
            $this->director = $director;
        }
        public function getDirector(){
            return $this->director;
        }

        public function setCantPersonas($cantPersonas){
            $this->cantPersonas = $cantPersonas;
        }
        public function getCantPersonas(){
            return $this->cantPersonas;
        }

        public function setPorcInc($porcInc){
            $this->porcInc = $porcInc;
        }
        public function getPorcInc(){
            return $this->porcInc;
        }
    
    
        public function buscar($idFuncion){
            $base=new BaseDatos();
            $qry="SELECT * FROM musical WHERE idFuncion=".$idFuncion;
            $resp= false;
            if($base->Iniciar()){
                if($base->Ejecutar($qry)){
                    if($row2=$base->Registro()){
                        parent::buscar($idFuncion);
                        $this->setDirector($row2['director']);
                        $this->setCantPersonas($row2['cantPersonas']);
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
            $consulta = "SELECT * FROM musical ";
            if($condicion!=""){
                $consulta=$consulta.' WHERE '.$condicion;
            }
            $consulta.=" ORDER BY nombre";
            if($base->Iniciar()){
                if($base->Ejecutar($consulta)){				
                    $arreglo = array();
                    while($row2=$base->Registro()){
                        $obj=new musical();
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
                $consultaInsertar="INSERT INTO musical(idFuncion, director, cantPersonas, porcInc)
                    VALUES (".parent::getIdFuncion().",'".$this->getDirector()."','".$this->getCantPersonas()."',".$this->getPorcInc().")";
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
                $qryUpdate="UPDATE musical SET porcInc=".$this->getPorcInc().", director='".$this->getDirector()."', cantPersonas='".$this->getCantPersonas()."' WHERE idFuncion=". parent::getIdFuncion();
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
                    $qryDelete="DELETE FROM musical WHERE idFuncion=".parent::getIdFuncion();
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
                   "\n Director: ".$this->getDirector().
                   "\n Cantidad de Personas en Escena: ".$this->getCantPersonas().
                   "\n Porcentaje de Incremento: ".$this->getPorcInc();
        }
    }
?>