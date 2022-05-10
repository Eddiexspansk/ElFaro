<?php
include_once("../Model/usuario.php");
include_once("DAO.php");

class Login {
    public function __construct(){}

    public function login($username, $password){
        $dao=new DAO();
        $user=$dao->findForLogin($username, $password);
        return $user;
    }
}

?>