<?php
class Destino{
    //Atributos
    private $id;
    private $nombre;
    private $valorDia;
    //Constructor
    public function __construct($id, $nombre, $valorDia)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->valorDia = $valorDia;
    }
    //Observadores y Modificadores
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function getValorDia(){
        return $this->valorDia;
    }
    public function setValorDia($valorDia){
        $this->valorDia = $valorDia;
    }
    //Metodos
    public function __toString(){
        return "\nIdentificación: ".$this->id.
               "\nNombre: ".$this->nombre.
               "\nValor por Dia: ".$this->valorDia;
    }
}
?>