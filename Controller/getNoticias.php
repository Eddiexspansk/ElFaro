<?php
include_once("../Model/categoria.php");
include_once("../Model/articulo.php");
include_once("DAO.php");

class Noticias{
    private $noticias;
    private $cuenta=0;
    public function __constructor(){
    }

    public function getNoticias($cat){
        $dao=new DAO();
        $arts=$dao->getArticulos($cat);
        $this->cuenta=count($arts);
        return $arts;
    }

    public function getNoticiasAsHtml($cat){
        $noticias=$this->getNoticias($cat);
        $out="";
        foreach($noticias as $noticia){
            $out.="<Noticia><Titulo>".$noticia->titulo."</Titulo><Categoria>".$noticia->categoria."</Categoria><Texto>".$noticia->texto."</Texto></Noticia>";
        }
        return $out;
    }

    public function getCuenta(){
        return $this->cuenta;
    }

    public function getCategorias(){
        $dao=new DAO();
        return $dao->getCategorias();
    }

}
?>