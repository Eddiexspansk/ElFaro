<!--Controller DAO convierte el objeto que se crea del 
formulario en tablas para la base-->

<?php
include_once("../Model/articulo.php");
include_once("../Model/categoria.php");
include_once("../Model/contacto.php");

//clase para conexión a la base de datos y funciones varias
class DAO {

    private $conn=null;
//Uso del Modelo PDO
    public function __construct() {
        $dsn = 'mysql:dbname=elfaro;host=127.0.0.1';
        $usuario = 'elfaro';
        $clave = 'elfaro';
        try {
            $this->conn = new PDO($dsn, $usuario, $clave);
        } catch (PDOException $e) {
            die('Falló la conexión: ' . $e->getMessage());
        }
    }

//Se crea la función getArcticulos para obtener los artículos
    public function getArticulos($cat=""){
        $articulos=[];
        $sql="SELECT TITULO,TEXTO,CATEGORIA,MEDIA FROM ARTICULO";
        if(strlen(trim($cat))>0){
            $sql.=" WHERE CATEGORIA = '".$cat."'";
        }
        $result=$this->conn->query($sql);
        if(!$result){
            die("No puedo recuperar los articulos");
        } else {
            while ($row = $result->fetch()) {
                $articulo=new Articulo();
                $articulo->titulo=$row["TITULO"];
                $articulo->texto=$row["TEXTO"];
                $articulo->categoria=$row["CATEGORIA"];
                $articulo->media=$row["MEDIA"];
                array_push($articulos,$articulo);
            }
        }
        return $articulos;
    }
//obtiene los usuarios desde la BD para agregarlos a la tabla del formulario
    public function getUsuarios($tu=""){
        $usuarios=[];
        $sql="SELECT ID,USERNAME, EMAIL, TIPO_USUARIO FROM USER";
        if(strlen(trim($tu))>0){
            $sql.=" WHERE TIPO_USUARIO = '".$tu."'";
        }
        $result=$this->conn->query($sql);
        if(!$result){
            die("No existe el usuario");
        } else {
            while ($row = $result->fetch()) {
                $usuario=new Usuario();
                $usuario->id=$row["ID"];
                $usuario->username=$row["USERNAME"];
                $usuario->email=$row["EMAIL"];
                $usuario->tipo_usuario=$row["TIPO_USUARIO"];
                array_push($usuarios,$usuario);
            }
        }
        return $usuarios;
    }
//Funciión para obtener las categorías de los artículos
    public function getCategorias(){
        $cats=[];
        // Categoria de inicio
        $cat=new Categoria();
        $cat->label="Inicio";
        $cat->value="";
        array_push($cats,$cat);
        $sql="SELECT DISTINCT CATEGORIA FROM ARTICULO ORDER BY CATEGORIA DESC";
        $result=$this->conn->query($sql);
        if(!$result){
            die("No puedo recuperar ninguna categoria");
        } else {
            while($row=$result->fetch()){
                $cat=new Categoria();
                $cat->label=$row["CATEGORIA"];
                $cat->id=$row["CATEGORIA"];
                array_push($cats,$cat);
            }
        }
        return $cats;
    }
//función para guardar en la BD los artículos
    public function postNoticia(Articulo $art){
        $sql="INSERT INTO ARTICULO (TITULO,TEXTO,CATEGORIA,MEDIA) VALUES (:TITULO,:TEXTO,:CATEGORIA,:MEDIA)";
         $sth=$this->conn->prepare($sql);
        $updated=$sth->execute(array(":TITULO"=>$art->titulo, ":TEXTO"=>$art->texto, ":CATEGORIA"=>$art->categoria, ":MEDIA"=>$art->media));
        if(!$updated){
            die("No puedo agregar la noticia");
        }
    }

//función para guardar los contactos
    public function guardaContacto(Contacto $contacto){
        $sql="CALL guardarContacto_SP(:NOMBRE, :EMAIL, :COMENTARIO);";
        $sth=$this->conn->prepare($sql);
        $updated=$sth->execute(array(":NOMBRE"=>$contacto->nombre, ":EMAIL"=>$contacto->email, ":COMENTARIO"=>$contacto->comentario));
        if(!$updated){
            die("No puedo guardar el Contacto");
        }
    }

//función para guardar el email del suscrito
    public function suscribeNewsletter($email){
        $sql="SELECT count(1) FROM SUBSCRIPCION WHERE EMAIL=:EMAIL";
        $sth=$this->conn->prepare($sql);
        $sth->execute(array(":EMAIL"=>$email));
        $row=$sth->fetch();
        if($row[0]<=0){
            echo "INSERTANDO";
            $sql="INSERT INTO SUBSCRIPCION (EMAIL) values (:EMAIL)";
            $sth=$this->conn->prepare($sql);
            $updated=$sth->execute(array(":EMAIL"=>$email));
            if(!$updated){
                die("No puedo guardar la suscripcion;");
            }
        } else {
            // ya esta suscrito
        }
    }
//función para encontrar si un usuario existe o no para agregarlo a la BD
    public function findUsername($username){
        $sql="SELECT ID,USERNAME,EMAIL,CODIGO from USER where USERNAME=:usuario";
        $sth=$this->conn->prepare($sql);
        $sth->execute(array(":usuario"=>$username));
        $result=$sth->fetch();
        if($result){
            $usr=new Usuario();
            $usr->id=$result["ID"];
            $usr->username=$result["USERNAME"];
            
            $usr->email=$result["EMAIL"];
            $usr->codigo=$result["CODIGO"];
            return $usr;
        }
        return null;
    }
//Función para el Login
    public function findForLogin($username, $password){
        $sql="SELECT ID,USERNAME,EMAIL,CODIGO from USER where USERNAME=:usuario and PASS=:password";
        $sth=$this->conn->prepare($sql);
        $sth->execute(array(":usuario"=>$username, ":password"=>$password));
        $result=$sth->fetch();
        if($result){
            $usr=new Usuario();
            $usr->id=$result["ID"];
            $usr->username=$result["USERNAME"];
            // no password reveal
            $usr->email=$result["EMAIL"];
            $usr->codigo=$result["CODIGO"];
            return $usr;
        }
        return null;
    }
//Funcion para guardar el usuario en la BD
    public function saveUser($usr){
        print_r($usr);
        $sql="INSERT INTO USER (USERNAME, PASS, EMAIL, CODIGO) values (:USERNAME, :PASS, :EMAIL, :CODIGO)";
        $sth=$this->conn->prepare($sql);
        $updated=$sth->execute(array(":USERNAME"=>$usr->username, ":EMAIL"=>$usr->email, ":PASS"=>$usr->password, ":CODIGO"=>$usr->code));
        if(!$updated){
            die("No puedo agregar el usuario");
        } else {
            return true;
        }
    }
}

?>