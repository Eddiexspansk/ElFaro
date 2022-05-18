<?php
include_once("../Model/articulo.php");
include_once("DAO.php");
class PostNoticia
{
    public function __construct()
    {
    }

    public function post($texto, $titulo, $categoria, $media, $mediatype)
    {
        $dao = new DAO();
        $articulo = new Articulo();
        $articulo->texto = $texto;
        $articulo->titulo = $titulo;
        $articulo->categoria = $categoria;
        $articulo->media = $media;
        $articulo->mediatype = $mediatype;
        $dao->postNoticia($articulo);
        return true;
    }
}


if (isset($_POST["action"]) && "postNoticia" == $_POST["action"]) {
   
        $nombre_archivo=$_FILES['media']['name'];
        $tipo_archivo=$_FILES['media']['type'];
        $tamano_archivo=$_FILES['media']['size'];

        

        $carpeta_destino=$_SERVER['DOCUMENT_ROOT'].'/ElFaro/imagenes/';
        move_uploaded_file($_FILES['media']['tmp_name'],$carpeta_destino.$nombre_archivo);

        $archivo_objetivo = fopen($carpeta_destino.$nombre_archivo,"r");
        $contenido=fread($archivo_objetivo, $tamano_archivo);
        fclose($archivo_objetivo);

        $poster = new PostNoticia();
        $poster->post($_POST["texto"], $_POST["titulo"], $_POST["categoria"], $contenido, $tipo_archivo);

      
    }


    header("location: /ElFaro");
?>
