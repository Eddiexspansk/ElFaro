<?php
include_once("../Model/articulo.php");
include_once("DAO.php");
class PostNoticia {
    public function __construct(){
    }

    public function post($texto, $titulo, $categoria, $media){
        $dao=new DAO();
        $articulo=new Articulo();
        $articulo->texto=$texto;
        $articulo->titulo=$titulo;
        $articulo->categoria=$categoria;
        $articulo->media=$media;
        $dao->postNoticia($articulo);
        return true;
    }

    
}



if(isset($_POST["action"]) && "postNoticia"==$_POST["action"]){
    $poster=new PostNoticia();
    $poster->post($_POST["texto"], $_POST["titulo"], $_POST["categoria"], $_POST["media"]);
}

header("location: /ElFaro");
?>
