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

    $output_dir = "imagenes/";/* Path for file upload */
	$RandomNum   = time();
	$ImageName      = str_replace(' ','-',strtolower($_FILES['media']['name']));
	$ImageType      = $_FILES['media']['type'];
 
	$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
	$ImageExt       = str_replace('.','',$ImageExt);
	$ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
	$NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
    $ret[$NewImageName]= $output_dir.$NewImageName;

    $poster=new PostNoticia();
    $poster->post($_POST["texto"], $_POST["titulo"], $_POST["categoria"], $_POST["media"]);
    
   
}

header("location: /ElFaro");
?>
