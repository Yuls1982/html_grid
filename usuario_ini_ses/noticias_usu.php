
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Noticias</title>
    <link rel="stylesheet" type="text/css" href="../estilos/estilos2.css">
</head>
<body>
<div class="contenedor">
    <header>
        <div class="main-container">
            <header>
                <!-- MENU LINKS -->
                <nav class="menu">
                    <div class="lista-content">
                        <ul>
                        <li><a href="index.php">Inicio</a></li>
                                    <li><a href="#" class="activo">noticias</a></li>
                                    <li><a href="citaciones.php">citaciones</a></li>
                                    <li><a href="perfil.php">perfil</a></li>
                                    <li><a href="cerrar_sesion.php" >cerrar sesión</a></li>
                        </ul>
                    </div>
                </nav>
            </header>
        </div>
    </header>
    <section class="contenido">
        <div class="noticias">
            <?php
            // Conexión a la base de datos
            $dbHost = "localhost";
            $dbUsername = "root";
            $dbPassword = "918521146";
            $dbName = "ejercicio_final_bd";

            $connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

            // Verificación de la conexión
            if ($connection->connect_error) {
                die("Error de conexión a la base de datos: " . $connection->connect_error);
            }

            // Consulta SQL para recuperar los datos
            $sql = "SELECT * FROM noticias";

            // Ejecución de la consulta
            $result = $connection->query($sql);

            // Verificación de errores en la consulta
            if ($result->num_rows === 0) {
                echo "No hay datos para mostrar";
            } else {
                // Mostrar datos de cada fila
                while ($row = $result->fetch_assoc()) {
                    echo "<h1>" . htmlspecialchars($row["titulo"]) . "</h1>";
                    echo "<img src='" . htmlspecialchars($row["imagen"]) . "' alt='imagen2'>";
                    echo "<p class='texto1'>" . htmlspecialchars($row["texto"]) . "</p>";
                    echo "<p>" . htmlspecialchars($row["fecha"]) . "</p>";

                    // Mostrar nombre del usuario si está disponible
                    if (isset($row["idUser"])) {
                        echo "<p>Autor: " . htmlspecialchars($row["idUser"]) . "</p>";
                    } else {
                        echo "<p>Autor no disponible</p>";
                    }
                }
            }

            // Cierre de la conexión a la base de datos
            $connection->close();
            ?>
        </div>
    </section>
    <footer class="footer" id="contacto">
        <div class="ejez">
            <div class="f-container">
                <!-- enlaces pie de página -->
                <nav class="mio">
                    <h5><a href="dondeestamos.html">Dónde estamos</a></h5>
                    <h6><a href="aviso.html">Aviso legal</a></h6>
                </nav>
                <div class="containerd">
                    <div class="footer-text">
                        <nav class="mia">
                            <a title="Twitter" href="http://www.twitter.com"><img class="fakeimg1" src="../assets/images/galeria/icontwitter.jpg" alt="imagen1"></a>
                            <a title="Facebook" href="http://www.facebook.com"><img class="fakeimg3" src="../assets/images/galeria/face.jpg" alt="imagen1"></a>
                            <a title="Instagram" href="http://www.instagram.com"><img class="fakeimg2" src="../assets/images/galeria/insta.jpg" alt="imagen1"></a>
                        </nav>
                        <p>&copy; MasterD - 2024 / Todos los derechos reservados</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
