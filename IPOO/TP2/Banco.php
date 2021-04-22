<?php
include_once "Mostrador.php";
    
    class Banco{
        private $mostrador; //array de Mostrador

        public function __construct($mostrador){
            $this->mostrador = $mostrador;
        }
        public function setMostrador($mostrador){
            $this->mostrador = $mostrador;
        }
        public function getMostrador(){
            return $this->mostrador;
        }

        public function mostradoresQueAtienden($unTramite){
            $array;
            $i = 0;
            foreach($this->mostrador as $key){
                if ($key->atiende($unTramite)){
                    $array[$i] = $key;
                    $i++;
                }
            }
            return $array;
        }

        public function mejorMostradorPara($unTramite){
            $array = $this->mostradoresQueAtienden($unTramite);
            $i = 1;
            $dev = $array[0];
            while($i != count($array)){
                if($array[$i]->full()){
                    if($array[$i]->getColaActual() < $dev->getColaActual()){
                        $dev = $array[$i];
                    }
                }
            }
            return $dev->full() ? $dev : null;
        }

        public function atender($unCliente){
            $tramite = $unCliente->getTramite();
            $unCliente->setMostAsign(mejorMostradorPara($tramite));
            if($unCliente->getMostAsign() != null){
                echo "Será atendido en cuanto haya lugar en un mostrador";
            }
        }

        public function ingresarTramite($cliente){
            $tipoTramite = $cliente->getTipoTramite();
            $cliente = $cliente->getPersona();
            $horaIngreso = date("Y-m-d H:i:s");
            $tramite = new Tramite($tipoTramite, $cliente, $horaIngreso, null);
            return $tramite;
        }

        public function cerrarTramite($tramite){
            $horaEgreso = date("Y-m-d H:i:s");
            if($tramite->getFechaHoraIn() != null and $tramite->getFechaHoraOut() == null){
                $tramite->setFechaHoraOut($horaEgreso);
            }else{
                return "El trámite no tiene estado Abierto";
            }
        }
    }
?>