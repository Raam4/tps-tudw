<?php
include_once "TP1/Libro.php";
    class Lectura{
        private $libros;
        private $pagActual;

        public function __construct($libros, $pagActual){
            $this->libros = $libros;
            $this->pagActual = $pagActual;
        }
        public function getLibro(){
            return $this->libros;
        }
        public function getPagActual(){
            return $this->pagActual;
        }
        public function setLibro($libros){
            $this->libro = $libro;
        }
        public function setPagActual($pagActual){
            $this->pagActual = $pagActual;
        }
        public function __toString(){
            return "Libro: ".$this->libro."\n Página Actual: ".$this->pagActual;
        }

        public function siguientePagina(){
            return $this->pagActual += 1;
        }

        public function retrocederPagina(){
            return $this->pagActual -= 1;
        }

        public function irPagina($x){
            return $this->pagActual = $x;
        }

        public function libroLeido($titulo){
            return $this->libros->iguales($titulo, $this->libros);
        }

        public function darSinopsis($titulo){
            $var = "";
            do{
                if ($this->libros[$i]->getTitulo() == $titulo){
                    $var = $this->libros->getSinopsis();
                }
            $i++;
            }while($var = "" and $i != counT($this->libros));
            return $var;
        }

        public function leidosAinosEdicion($x){

        }
    }
?>