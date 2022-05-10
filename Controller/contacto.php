<?php
include_once("../Model/contacto.php");
include_once("DAO.php");
print_r($_POST);
class ContactoController {
    public function __construct(){

    }

    public function reciveContacto($nombre, $email, $comentario){
        $contacto=new Contacto();
        $contacto->nombre=$nombre;
        $contacto->email=$email;
        $contacto->comentario=$comentario;
        print_r($contacto);
        $dao=new DAO();
        $dao->guardaContacto($contacto);
    }

    public function subscribe($email){
        $dao=new DAO();
        $dao->suscribeNewsletter($email);
    }


}


if(isset($_POST["action"]) && $_POST["action"]=="guardaContacto"){
    $cc=new ContactoController();
    $cc->reciveContacto($_POST["nombre"], $_POST["email"], $_POST["comentario"]);
    if(isset($_POST["subscribe"]) && $_POST["subscribe"]=="newsletter"){
        $cc->subscribe($_POST["email"]);
    }
}
header("location: /ElFaro");
?>