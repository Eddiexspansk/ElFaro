<?php
// http://bla/bla/image.php?art=<artid>
include_once("../Model/articulo.php");
include_once("getNoticias.php");

$artid=$_GET["art"];
$noticiasservice=new Noticias();
$art=$noticiasservice->getNoticia($artid);
header("Content-Type: ".$art->mediatype);
//header("Content-Disposition: attachment; filename=a.jpg");
echo $art->media;
?>