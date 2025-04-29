<?php
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../views_usuario/login.php");
    exit;
}
?>

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
                    <div class="bisel-abajo">
                        <nav class="menu">
                            <div class="lista-content">
                                <ul class="lista">
                                    <li><a href="#" class="activo">Inicio</a></li>
                                    <li><a href="citas_administracion.php">Citaciones</a></li>
                                    <li><a href="noticias_administracion.php">Noticias</a></li>
                                    <li><a href="registrar_usuario.php">Registro</a></li>
                                    <li><a href="usuarios_administracion.php">Administración de Usuarios</a></li>
                                    <li><a href="usuarios_lista.php">Lista de Usuarios</a></li>
                                    <li><a href="cerrar_sesion.php">Cerrar Sesión</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        <!-- IMAGENES NOSOTROS -->
        <div>
            <video id="myVideo" width="600" height="400" muted>
                <source src="../assets/videos/4121126-uhd_3840_2160_25fps.mp4" type="video/mp4">
                Tu navegador no soporta la etiqueta de video.
            </video>
            <div class="n-container">
                <h2>Bienvenido</h2>
                <p>
                    ¿Necesitas una cita?
                    En este enlace podrás pedirnos una cita, modificar o anular.
                </p>
                <section class="Registro" id="Registro">
                    <h2>Regístrate a través de este enlace</h2>
                    <div class="n-container2">
                        <ul>
                            <li><a href="citas_administracion.php">Registro</a></li>
                        </ul>
                        <br>
                        ¿Necesitas una cita?
                        En este enlace podrás pedirnos una cita, modificar o anular.
                        <br>
                    </div>
                    <br>
                </section>
            </div>
        </div>

        <section class="Noticias" id="Noticias">
            <div class="n-container1">
                <h2>¿Qué tipos de seguro de salud privado <br> puedo contratar con Adeslas?</h2>
                <p></p>
            </div>
        </section>
        <br>

        <section class="Registro" id="Registro">
            <h2>Regístrate a través de este enlace</h2>
            <div class="n-container2">
                <ul>
                    <li><a href="registrar_usuario.php">Registro</a></li>
                </ul>
                <p>Nos pondremos en contacto contigo para darte
                    <br> un presupuesto personalizado.
                </p>
            </div>
        </section>

        <section class="Login" id="Login">
            <h2>¿Qué cubre el seguro dental de Adeslas?</h2>
            <p><br></p>
        </section>

        <footer class="footer" id="contacto">
            <div class="bisel-arriba"></div>
            <div class="degr-formu">
                <div class="ejez">
                    <div class="f-container">
                        <nav class="mio">
                            <h5><a href="dondeestamos.html">Dónde estamos</a></h5>
                            <h6><a href="aviso.html">Aviso legal</a></h6>
                        </nav>
                        <div class="containerd">
                            <div class="footer-text1">
                                <nav class="mia">
                                    <a title="Facebook" href="http://www.twitter.com"><img class="fakeimg1"
                                            src="../assets/images/galeria/icontwitter.jpg" alt="imagen1"></a>
                                    <a title="Twitter" href="http://www.facebook.com"><img class="fakeimg3"
                                            src="../assets/images/galeria/face.jpg" alt="imagen1"></a>
                                    <a title="Instagram" href="http://www.instagram.com"><img class="fakeimg2"
                                            src="../assets/images/galeria/insta.jpg" alt="imagen1"></a>
                                </nav>
                                <p>&copy; MasterD - 2023 / Todos los derechos reservados</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="../js/script.js"></script>
</body>

</html>
