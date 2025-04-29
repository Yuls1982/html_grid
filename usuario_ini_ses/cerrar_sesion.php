<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../estilos/estilos2.css">
  <title>Estructura</title>
</head>
<body>
    <div class="main-container">
        <header>
            <div class="images-header">
                <div class="bienvenido">
                    <!-- Aquí puedes añadir tu imagen de cabecera si lo deseas -->
                    <div class="bisel-abajo">
                        <nav class="menu">
                            <div class="lista-content">
                                <ul class="lista">
                                    <li><a href="index.php">index</a></li>
                                    <li><a href="noticias_usu.php">noticias</a></li>
                                    <li><a href="citaciones.php">citaciones</a></li>
                                    <li><a href="perfil.php">perfil</a></li>
                                    <li><a href="#" class="activo">cerrar sesión</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <footer class="footer" id="contacto">
            <div class="bisel-arriba"></div>
            <div class="degr-formu">
                <div class="ejez">
                    <div class="f-container">
                        <nav class="mio">
                            <h5><a href="dondeestamos.html">Donde estamos</a></h5>
                            <h6><a href="aviso.html">Aviso legal</a></h6>
                        </nav>
                        <div class="containerd">
                            <div class="footer-text1">
                                <nav class="mia">
                                    <a title="Facebook" href="http://www.twitter.com"><img class="fakeimg1"
                                            src="./assets/images/galeria/icontwitter.jpg" alt="imagen1"></a>
                                    <a title="Twitter" href="http://www.facebook.com"><img class="fakeimg3"
                                            src="./assets/images/galeria/face.jpg" alt="imagen1"></a>
                                    <a title="Instagram" href="http://www.instagram.com"><img class="fakeimg2"
                                            src="./assets/images/galeria/insta.jpg" alt="imagen1"></a>
                                </nav>
                                <p>&copy; MasterD - 2023 / Todos los derechos reservados </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>




<?php

session_start();
session_unset();
session_destroy();
header("Location: ../index.html");
exit;


