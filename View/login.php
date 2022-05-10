<?php
include_once("../Model/usuario.php");
include_once("../Controller/login.php");
session_start();
if(isset($_POST["action"])&&$_POST["action"]=="login"){
    $login=new Login();
    $user=$login->login($_POST["usuario"], $_POST["palabra_secreta"]);
    if($user){
        $_SESSION["usuario"]=$user;
        header("location: /ElFaro");
        return;
    }
}
if(!isset($_SESSION["usuario"])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="styles.css">
    <title>Log In</title>
</head>
<body>
    <div class="container mb-3 ">
    <form action="login.php" method="post">
        <!--
            Nota: el atributo name es importante, pues lo vamos a recibir de esa manera
            en PHP
        -->
        <input name="usuario" type="text" placeholder="Escribe tu nombre de usuario">
        <br><br>
        <input name="palabra_secreta" type="password" placeholder="Contraseña">
        <br><br>
        <!--Lo siguiente envía el formulario-->
        <input type="hidden" name="action" value="login"/>
        <input type="submit" value="Iniciar sesión">
    </form>
    <hr>
    <div><input type=button onClick="location.href='index.html'" value='volver'></div>
</div>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>
</html>
<?php
}
?>