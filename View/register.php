<?php
include_once("../Model/usuario.php");
include_once("../Controller/register.php");
session_start();
$err=[];
$username="";
$password="";
$confirm_password="";
$email="";
print_r($_POST);
$reg=new Register();
if(isset($_POST["action"])&&$_POST["action"]=="register"){
    
    $err=$reg->register($_POST["username"],$_POST["password"], $_POST["confirm_password"], $_POST["email"]);
    if(!$err || count($err)==0){
        header("location: /ElFaro/View/portada.php?msg=1");
        return;
    }
}

if(!isset($_SESSION["user"])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Registrarse</h2>
<?php
    if(isset($mensaje) && strlen($mensaje)>0){
        echo "<h2 style=\"color: red;\">".$mensaje."</h2>";
    }else{
        echo "<p>Por favor rellena los campos para registrarte.</p>";
    }
?>
        <form action="" method="post">
            <div class="form-group">
                <label>Usuario</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($err["username"])) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $err["username"]; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($err["password"])) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $err["password"]; ?></span>
            </div>
            <div class="form-group">
                <label>Confirmar Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($err["confirmpass"])) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $err["confirmpass"]; ?></span>
            </div>
            <div class="form-group">
                <label>Correo Electrónico</label>
                <input type="email" name="email" class="form-control <?php echo (!empty($err["email"])) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $err["email"]; ?></span>
            </div>
            <div class="form-group">
                <input type="hidden" name="action" value="register"/>
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>¿Tienes una cuenta? <a href="login.php">Ingresa acá</a>.</p>
        </form>
        <div>

       <!--tabla para mostrar los datos de los usuarios registrados-->
        <table>
        <tr>
            <th>id</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Tipo Usuario</th>
        </tr>
        <?php
        $usuarios = $reg->getUsuarios();
        foreach($usuarios as $usuario){  
        ?>
        <tr>
            <td><?=$usuario->id?></td>
            <td><?=$usuario->username?></td>
            <td><?=$usuario->email?></td>
            <td><?=$usuario->tipo_usuario?></td>
        </tr>
  <?php
  }
  ?>
        </table>
        </div>
    </div>    
</body>
</html>
<?php
}
?>