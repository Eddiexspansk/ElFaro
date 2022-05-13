<?php
// Include config file
require_once("../Model/usuario.php");
require_once("../Controller/DAO.php");
class Register {
    public function __construct(){}

    public function register($username, $password, $confirm, $email){
        $err=[];
        $dao=new DAO();
        if($dao->findUsername($username)!=null){
            $err["username"]="El usuario elegido ya está en uso, por favor intente con otro.";
            return $err;
        }
        if($password!=$confirm){
            $err["password"]="Las contraseñas no coinciden";
            $err["confirmpass"]="las contraseñas no coinciden";
            return $err;
        }
        if(strlen(trim($password))<3 && preg_match("/^[0-9a-zA-Z]+$/",$password)){
            $err["password"]="La clave no debe contener sólo números y letras, por favor ESFUERCESE UN POQUITO.";
            return $err;
        }
      
        echo "PASS";
        print_r($password);
        $signupRecord=new Usuario();
        $signupRecord->username=$username;
        $signupRecord->password=$password;
        $signupRecord->email=$email;
        $signupRecord->code=$this->randomCode();
        echo "---";
        print_r($signupRecord);
        $dao->saveUser($signupRecord);
    }
//código para verificación por email del registro
    function randomCode() { 

        $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
        srand((double)microtime()*1000000); 
        $i = 0; 
        $code = '' ; 
    
        while ($i <= 5) { 
            $num = rand() % 33; 
            $tmp = substr($chars, $num, 1); 
            $code = $code . $tmp; 
            $i++; 
        } 
    
        return $code; 
    
    } 
    function getUsuarios(){
        $dao = new DAO();
        return $dao->getUsuarios();
    }
    
}
