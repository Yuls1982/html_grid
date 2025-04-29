<?php
// Incluir archivo de configuración de la base de datos 
include '../controladores/config.php'; // Ajusta según tu configuración

session_start();

// Verificar que el ID de la cita esté en la URL
if (isset($_GET['idUser'])) {
    $cita_id = $_GET['idUser'];

    // Obtener los datos de la cita
    $query = "SELECT * FROM citas WHERE id = ? AND idUser = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $cita_id, $_SESSION['idUser']);
    $stmt->execute();
    $result = $stmt->get_result();
    $cita = $result->fetch_assoc();
    $stmt->close();

    // Si no existe la cita o no es del usuario, redirigir a la página de citas
    if (!$cita) {
        header('Location: citaciones.php');
        exit;
    }
}

// Procesar el formulario para actualizar la cita
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fecha']) && isset($_POST['descripcion'])) {
    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];

    // Actualizar los datos de la cita en la base de datos
    $query = "UPDATE citas SET fecha_cita = ?, descripcion = ? WHERE id = ? AND idUser = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssii', $fecha, $descripcion, $cita_id, $_SESSION['idUser']);
    $stmt->execute();
    $stmt->close();

    // Redirigir a la página de citas después de la actualización
    header('Location: citaciones.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cita</title>
    <link rel="stylesheet" href="../estilos/estilos2.css"> <!-- Enlace al archivo CSS para estilos -->
</head>
<body>
    <div class="main-container">
    <header>
        <!-- MENU LINKS -->
        <div class="images-header">
        <div class="bienvenido">
            <!-- icon img cabecera -->
            <div class="bisel-abajo">
            <nav class="menu">
                <div class="lista-content">
                <ul class="lista">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="citaciones.php">Citaciones</a></li>
                    <li><a href="noticias_usu.php">Noticias</a></li>
                    <li><a href="perfil.php">Perfil</a></li>
                    <li><a href="cerrar_sesion.php">Cerrar sesión</a></li>
                </ul>
                </div>
            </nav>
            </div>
        </div>
        </div>
    </header>

    <h1>Editar Cita</h1>
    <main>
        <section>
            <h2>Modificar Cita</h2>
            <form action="editar_cita.php?id=<?php echo $cita_id; ?>" method="POST">
                <label for="fecha">Fecha de la Cita:</label>
                <input type="date" id="fecha" name="fecha" value="<?php echo $cita['fecha_cita']; ?>" required>
                <br><br>
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="4" required><?php echo htmlspecialchars($cita['descripcion']); ?></textarea>
                <br><br>
                <input type="submit" value="Actualizar Cita">
            </form>
        </section>
    </main>

    <footer>
    <footer class="footer" id="contacto">
        <div class="bisel-arriba"></div>
        <div class="degr-formu">
        <div class="ejez">
            <div class="f-container">
            <div class="containerd">
                <div class="footer-text1">
                <nav class="mio">
                <h5><a href="dondeestamos.html">Donde estamos</a></h5>
                <h6><a href="aviso.html">Aviso legal</a></h6>
            </nav>

                <nav class="mia">
                    <a title="Facebook" href="http://www.twitter.com"><img class="fakeimg1" src="../assets/images/galeria/icontwitter.jpg" alt="imagen1"></a>
                    <a title="Twitter" href="http://www.facebook.com"><img class="fakeimg3" src="../assets/images/galeria/face.jpg" alt="imagen1"></a>
                    <a title="Instagram" href="http://www.instagram.com"><img class="fakeimg2" src="../assets/images/galeria/insta.jpg" alt="imagen1"></a>
                </nav>
                <p>&copy; MasterD - 2023 / Todos los derechos reservados </p>
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
