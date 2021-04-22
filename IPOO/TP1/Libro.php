<?php
    class Libro{
        private $isbn;
        private $titulo;
        private $anioEd;
        private $editorial;
        private $autor;
        private $totalPags;
        private $sinopsis;

        public function __construct($isbn, $titulo, $anioEd, $editorial, $autor, $totalPags, $sinopsis){
            $this->isbn = $isbn;
            $this->titulo = $titulo;
            $this->anioEd = $anioEd;
            $this->editorial = $editorial;
            $this->autor = $autor;
            $this->totalPags = $totalPags;
            $this->sinopsis = $sinopsis;
        }
        public function getIsbn(){
            return $this->isbn;
        }
        public function getTitulo(){
            return $this->titulo;
        }
        public function getAnioEd(){
            return $this->anioEd;
        }
        public function getEditorial(){
            return $this->editorial;
        }
        public function getAutor(){
            return $this->autor;
        }
        public function getTotalPags(){
            return $this->totalPags;
        }
        public function getSinopsis(){
            return $this->sinopsis;
        }
        public function setIsbn($isbn){
            $this->isbn = $isbn;
        }
        public function setTitulo($titulo){
            $this->titulo = $titulo;
        }
        public function setAnioEd($anioEd){
            $this->anioEd = $anioEd;
        }
        public function setEditorial($editorial){
            $this->editorial = $editorial;
        }
        public function setAutor($autor){
            $this->autor = $autor;
        }
        public function setTotalPags($totalPags){
            $this->totalPags = $totalPags;
        }
        public function setSinopsis($sinopsis){
            $this->sinopsis = $sinopsis;
        }
        public function __toString(){
            return "ISBN: ".$this->isbn."\n Titulo: ".$this->titulo."\n Edicion: ".$this->anioEd."\n Editorial: ".$this->editorial."\n Autor: ".$this->autor."\n Cantidad de Páginas: .".$this->totalPags."\n Sinopsis: ".$this->sinopsis;
        }

        public function perteneceEditorial($peditorial){
            return (strcasecmp($peditorial, $this->editorial) == 0) ? true : false;
        }
        
        public function iguales($plibro, $parreglo){
            $i = 0;
            $set = false;
            do{
                if ($parreglo[$i]->getIsbn() == $plibro->getIsbn()){
                    $set = true;
                }
                $i++;
            }while($set != true and $i != count($parreglo));
        return $set;
        }
        
        public function aniosDesdeEdicion(){
            return date("Y") - $this->anioEd;
        }

        public function libroDeEditoriales($arregloAutor, $peditorial){
            $i = 0;
            $arrayLib;
            foreach ($arregloAutor as $key){
                if ($peditorial == $key->getEditorial()){
                    $arrayLib[$i] = $key;
                    $i++;
                }
            }
            return $arrayLib;
        }
    }
?>