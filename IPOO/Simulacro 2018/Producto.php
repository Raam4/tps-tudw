<?php
class Producto{
    //Atributos
    private $codBarra;
    private $nombre;
    private $marca;
    private $color;
    private $talle;
    private $descripcion;
    private $stock;
    //Constructor
    public function __construct($codBarra, $nombre, $marca, $color, $talle, $descripcion, $stock){
        $this->codBarra = $codBarra;
        $this->nombre = $nombre;
        $this->marca = $marca;
        $this->color = $color;
        $this->talle = $talle;
        $this->descripcion = $descripcion;
        $this->stock = $stock;
    }
    //Modificadores
    public function setCodBarra($codBarra){
        $this->codBarra = $codBarra;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setMarca($marca){
        $this->marca = $marca;
    }
    public function setColor($color){
        $this->color = $color;
    }
    public function setTalle($talle){
        $this->talle = $talle;
    }
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    public function setStock($stock){
        $this->stock = $stock;
    }
    //Obervadores
    public function getCodBarra(){
        return $this->codBarra;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getMarca(){
        return $this->marca;
    }
    public function getColor(){
        return $this->color;
    }
    public function getTalle(){
        return $this->talle;
    }
    public function getDescripcion(){
        return $this->descripcion;
    }
    public function getStock(){
        return $this->stock;
    }
    //Metodos
    public function __toString(){
        return "\nCodigo de Barra: ".$this->codBarra.
               "\nNombre: ".$this->nombre.
               "\nMarca: ".$this->marca.
               "\nColor: ".$this->color.
               "\nTalle: ".$this->talle.
               "\nDescripción: ".$this->descripcion.
               "\nStock: ".$this->stock;
    }

    public function actualizarStock($nStock){
        $stock = $this->getStock() + $nStock;
        $this->setStock($stock);
    }
}
?>