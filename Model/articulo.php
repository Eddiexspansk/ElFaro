<?php
class Articulo {
    public $id;
    public $texto;
    public $titulo;
    public $categoria;
    public $media;
    public $mediatype;

    public function __constructor($_texto, $_titulo, $_categoria, $_media, $_mediatype){
        $this->texto=$_texto;
        $this->titulo=$_titulo;
        $this->categoria=$_categoria;
        $this->media=$_media;
        $this->mediatype=$_mediatype;
    }
}
?>