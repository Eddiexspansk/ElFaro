<?php
class Articulo {
    public $texto;
    public $titulo;
    public $categoria;
    public $media;

    public function __constructor($_texto, $_titulo, $_categoria, $_media){
        $this->texto=$_texto;
        $this->titulo=$_titulo;
        $this->categoria=$_categoria;
        $this->media=$_media;
    }
}
?>