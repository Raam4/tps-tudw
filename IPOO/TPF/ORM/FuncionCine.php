<?php
    class Cine extends Funcion{
    
        private $fnc;
    
        public function __construct(){
            parent::__construct();
            $this->fnc['genero'] = "";
            $this->fnc['paisOrigen'] = "";
            $this->fnc['porcInc'] = "";
        }
    
        public function cargar($fnc){
            parent::cargar($fnc);
            $this->setGenero($fnc['genero']);
            $this->setpaisOrigen($fnc['paisOrigen']);
            $this->setPorcInc($fnc['porcInc']);
        }

        public function setGenero($genero){
            $this->fnc['genero'] = $genero;
        }
        public function getGenero(){
            return $this->fnc['genero'];
        }

        public function setPaisOrigen($paisOrigen){
            $this->fnc['paisOrigen'] = $paisOrigen;
        }
        public function getPaisOrigen(){
            return $this->fnc['paisOrigen'];
        }

        public function setPorcInc($porcInc){
            $this->fnc['porcInc'] = $porcInc;
        }
        public function getPorcInc(){
            return $this->fnc['porcInc'];
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
            $consulta.=" ORDER BY idFuncion";
            if($base->Iniciar()){
                if($base->Ejecutar($consulta)){				
                    $arreglo = array();
                    while($row2=$base->Registro()){
                        $obj=new Cine();
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
                $consultaInsertar="INSERT INTO cine(idFuncion, genero, paisOrigen)
                    VALUES (".parent::getIdFuncion().",'".$this->getGenero()."','".$this->getPaisOrigen()."')";
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
                $qryUpdate="UPDATE cine SET genero='".$this->getGenero()."', paisOrigen='".$this->getPaisOrigen()."', porcInc=".$this->getPorcInc()." WHERE idFuncion=". parent::getIdFuncion();
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
                   "\n Porcentaje de Incremento: ".$this->getPorcInc()."\n";
        }
    }
?>