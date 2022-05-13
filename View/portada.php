<?php
// Model
include_once("../Model/categoria.php");
include_once("../Model/articulo.php");
include_once("../Model/contacto.php");
include_once("../Model/usuario.php");



// Controller
include_once("../Controller/getNoticias.php");
session_start();
$cat = "";
if (isset($_GET["cat"])) {
  $cat = $_GET["cat"];
}
$n = new Noticias();
$noticias = $n->getNoticias($cat);
$cantidad_articulos = $n->getCuenta();
$categorias = $n->getCategorias();
$msg = [];
$msg[1] = "Usuario registrado, muchas gracias";
$mensaje = false;
if (isset($_GET["msg"])) {
  $mensaje = $msg[intval($_GET["msg"])];
}
?>
<!DOCTYPE html>
<html lang="Es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!--se agrega Boostrap al html-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!--Se crea el enlace a la hoja de estilos que será la que conendrá el código CSS-->
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
  <!--TAB-->
  <!--Se agrega el ícono en el Tab de la página-->
  <link rel="icon" href="../imagenes/vecteezy_lighthouse-logo-vector-design_.jpg">
  <!--Título en el Tab-->
  <title>El Faro (AIEP S5)</title>
</head>

<body>
  <!--HEADER-->

  <!--Se alinea el header para que el faro y el título se vean en el centro de la pantalla-->
  <header align="center">
    <div class="header-container">
      <div id="reloj"></div>
      <div class="col">
        <div class="row">
          <FONT FACE="rockwell">
            <h1>EL FARO</h1>
            <?php
            if (isset($_SESSION["usuario"])) {
              $user = $_SESSION["usuario"];
              echo "Hola " . $user->username;
            }
            ?>
          </FONT>
        </div>
        <?php
        if ($mensaje) {
          echo "<div>" . $mensaje . "</div>";
        }
        ?>
        <!--Barra de Navegación-->
        <nav class="navbar navbar-expand-lg navbar-light bg-body">
          <div class="container-fluid">
            <a class="navbar-brand " href="#"><img src="../imagenes/vecteezy_lighthouse-logo-vector-design_.jpg" class="img-thumbnail rounded-circle" width="50px" height="50px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0" id="categorias">
                <?php
                foreach ($categorias as $categoria) {
                ?>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="?cat=<?= htmlentities($categoria->id) ?>">
                      <?= $categoria->label ?>
                    </a>
                  </li>
                <?php
                }
                ?>
              </ul>
            </div>
          </div>
        </nav>

  </header>

  <!--ÁREA DE PUBLICIDAD-->
  <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../imagenes/banner1.JPG" class="d-sm-block" alt="...">
      </div>
      <div class="carousel-item ">
        <img src="../imagenes/banner2.JPG" class="d-sm-block" alt="...">
      </div>
      <div class="carousel-item ">
        <img src="../imagenes/banner 3.JPG" class="d-sm-block" alt="...">
      </div>
    </div>
  </div>
  <hr>
  <!--LAS NOTICIAS DESTACADAS APARECERAN CUANDO SE INGRESE UNA NUEVA NOTICIA EN EL FORMULARIO-->
  <div class="container-fluid row flex-row" id="nuevas-noticias">
  </div>

  <!--Se crea la clase menú para dar forma a un menú mas estilizado con CSS-->
  <div class="container-fluid">
    <section align="center">

      <!--AQUÍ ENTRA LA CANTIDAD DE ARTICULOS-->
      <p id="constante"><?= $cantidad_articulos ?></p>

      <div class="row flex-row" id="noticias">
        <?php
        foreach ($noticias as $noticia) {
        ?>
          <div class="col col-sm-4">
            <article class="card border-secondary h-100" style="width: 20em">
              <table>
                <tr style="background-color: #21D192">
                  <td>
                    <h4 style="color:white" class="card-header"><?= $noticia->titulo ?></h4>
                    <h6 style="color:white">cat: <?= $noticia->categoria ?></h6>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p class="card-body text-secondary"><?= $noticia->texto ?></p>
                  </td>
                </tr>
              </table>
            </article>
          </div>
        <?php
        }
        ?>

      </div>

      <hr>
      <!--Se Crea el área para Miniaturas, se ingresarán en las semana 8 desde la BD-->
      <div class="container">
        <div>Miniaturas</div>
        <div class="d-flex flex-row">
          <div class="p-4 border-end" id="miniaturas">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p> <img src="../imagenes/ciudadSantiago.JPG" alt="" height="40px" width="40px">
          </div>
          <div class="p-4 border-end" id="miniaturas">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p> <img src="../imagenes/ciudadSantiago.JPG" alt="" height="40px" width="40px">
          </div>
          <div class="p-4 border-end" id="miniaturas">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p> <img src="../imagenes/ciudadSantiago.JPG" alt="" height="40px" width="40px">
          </div>
          <div class="p-4 border-end" id="miniaturas">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p> <img src="../imagenes/ciudadSantiago.JPG" alt="" height="40px" width="40px">
          </div>
          <div class="p-4 border-end" id="miniaturas">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p> <img src="../imagenes/ciudadSantiago.JPG" alt="" height="40px" width="40px">
          </div>
          <div class="p-4 border-end" id="miniaturas">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p> <img src="../imagenes/ciudadSantiago.JPG" alt="" height="40px" width="40px">
          </div>
        </div>

                <!--Este formulario podr{a subir arhivos desde lasSemana 8 -->
        <hr />
        <p>Ingresa tu Artículo</p>
        <div class="form">
          <form name="formulario" action="../Controller/postNoticia.php" enctype="multipart/form-data" method="POST">
            <div class="form-group">
              <label for="titleField">Título: </label>
              <input type="text" id="titleField" class="titleField" name="titulo">`
            </div>
            <div class="form-group">
              <label for="catField">Categoría: </label>
              <input type="text" id="catField" class="catField" name="categoria"><br>
            </div>
            <div class="form-group">
              <label for="descField">Descripción: </label>
              <textarea id="descField" class="descField" name="texto"></textarea><br>
              <input type="hidden" name="action" value="postNoticia" />
              <div class="form-group">
                <div class="mb-3">
                  <input type="file" class="form-control-file" name="media">
                </div>
                <input type="submit" value="Ingrese su artículo" class="articleSubmit" name="guardar">
              </div>
            </div>
          </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center text-lg-start text-dark" style="background-color: #ECEFF1">
      <!-- Section: Social media -->
      <section class="d-flex justify-content-between p-4 text-white" style="background-color: #21D192">
        <!-- Left -->
        <div class="me-5">
          <span>Nos puedes encontrar en las redes sociales :</span>
        </div>

        <!-- Seccion: Social media -->
        <div>
          <a href="" class="text-white me-4">
            <i class="bi bi-facebook"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="bi bi-twitter"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="bi bi-google"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="bi bi-instagram"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="bi bi-linkedin"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="bi bi-github"></i>
          </a>
        </div>

      </section>


      <!-- Seccion: Links  -->
      <section class="">
        <div class="container text-center text-md-start mt-5">
          <!-- Grid row -->
          <div class="row mt-3">
            <!-- Grid column -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
              <!-- Content -->
              <h6 class="text-uppercase fw-bold">Quienes somos</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci necessitatibus impedit quam sapiente
                deleniti enim obcaecati hic, libero provident corrupti dolor nesciunt soluta culpa! Facere eum doloremque
                necessitatibus soluta assumenda.
              </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
              <!-- Links -->
              <h6 class="text-uppercase fw-bold">Products</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
              <p>
                <a href="#!" class="text-dark">Nosotros</a>
              </p>
              <p>
                <a href="#!" class="text-dark">Noticias</a>
              </p>
              <p>
                <a href="#!" class="text-dark">Mechandasing</a>
              </p>
              <p>
                <a href="#!" class="text-dark">Bootstrap</a>
              </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
              <!-- Links -->
              <h6 class="text-uppercase fw-bold">Useful links</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
              <p>
                <a href="../View/register.php" class="text-dark">Registrarse</a>
              </p>
              <p>
                <a href="login.php" class="text-dark">Ingresar</a>
              </p>
              <p>
                <a href="#!" class="text-dark">Empleo</a>
              </p>
              <p>
                <a href="#!" class="text-dark">Ayuda</a>
              </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div id="formContacto" class=" col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
              <form name="formContacto" action="../Controller/contacto.php" method="POST">
                <h6 class="text-uppercase fw-bold">Contacto</h6>
                <div class="form-group">
                  <input type="text" id="nombreContacto" placeholder="Nombre" name="nombre"><br>
                </div>
                <div class="form-group">
                  <input type="email" id="emailContacto" placeholder="Email" name="email"><br>
                </div>
                <div class="form-group">
                  <textarea rows="4" cols="20" id="textareaContacto" class="textareaContacto" placeholder="Descripción..." name="comentario"></textarea><br>
                  <input type="checkbox" id="javascript" name="subscribe" value="newsletter">
                    <label for="javascript">NEWSLETTER</label>
                  <input type="hidden" name="action" value="guardaContacto" />
                  <input type="submit" value="Enviar" class="contactoForm"><br>
                </div>
              </form>
            </div>
            <div>
              <!-- Grid column -->
            </div>
            <!-- Grid row -->
          </div>
      </section>
      <!-- Section: Links  -->

      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        Author: Eduardo Pinto
        <a href="mailto:epm@example.com">epm@example.com</a>
      </div>
      <!-- Copyright -->
    </footer>
    <!-- Footer -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>