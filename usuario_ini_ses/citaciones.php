<?php 
// Incluir archivo de configuración de la base de datos 
include '../controladores/config.php'; // Ajusta según tu configuración 

session_start();  



// Función para obtener citas del usuario 
function obtenerCitasUsuario($conn, $idCita) { 
    $query = "SELECT * FROM citas WHERE idCita = ? ORDER BY fecha_cita ASC"; 
    $stmt = $conn->prepare($query); 
    $stmt->bind_param('i', $idCita); 
    $stmt->execute(); 
    $result = $stmt->get_result(); 

    $citas = array(); 
    while ($row = $result->fetch_assoc()) { 
        $citas[] = $row; 
    } 

    $stmt->close(); 
    return $citas; 
} 

// Obtener las citas del usuario
$citas_usuario = obtenerCitasUsuario($conn, $_SESSION['idCita']); 

// Procesar el formulario para solicitar una nueva cita 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fecha']) && isset($_POST['descripcion'])) { 
    $fecha = $_POST['fecha']; 
    $descripcion = $_POST['descripcion']; 

    // Asegúrate de que idCita esté disponible
    if (isset($_SESSION['idCita'])) {
        $idCita = $_SESSION['idCita'];
    } else {
        die("Error: idCita no está disponible.");
    }

    // Insertar la nueva cita en la base de datos 
    $query = "INSERT INTO citas (idCita, fecha_cita, motivo_cita) VALUES (?, ?, ?)"; 
    $stmt = $conn->prepare($query); 
    $stmt->bind_param('iss', $idCita, $fecha, $descripcion);  // Corregí las variables aquí
    $stmt->execute(); 
    $stmt->close(); 

    // Redirigir para evitar reenvíos del formulario 
    header('Location: citaciones.php'); 
    exit; 
} 

// Procesar la modificación o eliminación de una cita existente 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && isset($_POST['cita_id'])) { 
    $accion = $_POST['accion']; 
    $cita_id = $_POST['cita_id']; 

    if ($accion === 'editar') { 
        // Redirigir a una página de edición de cita (debes implementar esto) 
        header('Location: editar_cita.php?idCita=' . $cita_id); 
        exit; 
    } elseif ($accion === 'eliminar') { 
        // Eliminar la cita de la base de datos 
        $query = "DELETE FROM citas WHERE idCita = ? AND idCita = ?"; 
        $stmt = $conn->prepare($query); 
        $stmt->bind_param('ii', $cita_id, $_SESSION['idCita']); 
        $stmt->execute(); 
        $stmt->close(); 

        // Redirigir para evitar reenvíos del formulario 
        header('Location: citaciones.php'); 
        exit; 
    } 
} 
?> 

<!DOCTYPE html> 
<html lang="es"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Citaciones</title> 
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
                    <li><a href="#" class="activo">Citaciones</a></li> 
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

        <h1>Citaciones</h1> 
    <main> 
        <section> 
            <h2>Solicitar Nueva Cita</h2> 
            <form action="citaciones.php" method="POST"> 
                <label for="fecha">Fecha de la Cita:</label> 
                <input type="date" id="fecha" name="fecha" required> 
                <br><br> 
                <label for="descripcion">Descripción:</label> 
                <textarea id="descripcion" name="descripcion" rows="4" required></textarea> 
                <br><br> 
                <input type="submit" value="Solicitar Cita"> 
            </form> 
        </section> 

        <section> 
            <h2>Mis Citaciones</h2> 
            <table> 
                <thead> 
                    <tr> 
                        <th>Fecha</th> 
                        <th>Descripción</th> 
                        <th>Acciones</th> 
                    </tr> 
                </thead> 
                <tbody> 
                    <?php foreach ($citas_usuario as $cita): ?> 
                        <tr> 
                            <td><?php echo $cita['fecha_cita']; ?></td> 
                            <td><?php echo htmlspecialchars($cita['motivo_cita']); ?></td> 
                            <td> 
                                <?php if (strtotime($cita['fecha_cita']) >= strtotime('today')): ?> 
                                    <form action="citaciones.php" method="POST"> 
                                        <input type="hidden" name="cita_id" value="<?php echo $cita['idCita']; ?>"> 
                                        <button type="submit" name="accion" value="editar">Editar</button> 
                                        <button type="submit" name="accion" value="eliminar">Eliminar</button> 
                                    </form> 
                                <?php endif; ?> 
                            </td> 
                        </tr> 
                    <?php endforeach; ?> 
                </tbody> 
            </table> 
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
