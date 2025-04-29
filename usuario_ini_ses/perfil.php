  <!DOCTYPE html>
  <html lang="es">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Mi Perfil</title>
      <link rel="stylesheet" href="../estilos/estilos2.css"> <!-- Enlace al archivo CSS para estilos -->
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
                                  <li><a href="index.php">Inicio</a></li>
                                      <li><a href="noticias_usu.php">noticias</a></li>
                                      <li><a href="citaciones.php">citaciones</a></li>
                                      <li><a href="#" class="activo">Perfil</a></li>
                                      <li><a href="cerrar_sesion.php" >cerrar sesión</a></li>
                          </ul>
                                  </ul>
                              </div>
                          </nav>
                      </div>
                  </div>
              </div>

              <h1>Mi Perfil</h1>
          </header>
          <main>


<?php
include '../controladores/config.php'; 

// Verificar si el usuario está autenticado y obtener sus datos
session_start();

if (isset($_SESSION['usuario'])) {
    // Obtener los datos del usuario desde la sesión o base de datos
    $nombre_usuario = $_SESSION['usuario'];
    // consulta a la base de datos para obtener los demás datos del usuario
    $nombre = ''; // Inicializar con el nombre del usuario
    $apellidos = ''; // Inicializar con los apellidos del usuario
    $email = ''; // Inicializar con el email del usuario
} else {
  echo "#";
    // Manejar caso en que el usuario no esté autenticado
    // Redireccionar o mostrar un mensaje de error
    header("Location: ../index.html");
    exit();
}
?>
              <section>
                  <h2>Datos Personales</h2>
                  <form action="guardar_perfil.php" method="POST">
                      <label for="username">Nombre de usuario:</label>
                      <input type="text" id="username" name="username" placeholder="Ingrese su nombre" value="<?php echo htmlspecialchars($nombre_usuario); ?>" readonly>
                      <br><br>
                      <label for="nombre">Nombre:</label>
                      <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre"value="<?php echo htmlspecialchars($nombre); ?>" required>
                      <br><br>
                      <label for="apellidos">Apellidos:</label>
                      <input type="text" id="apellidos" name="apellidos" placeholder="Ingrese sus apellidos" value="<?php echo htmlspecialchars($apellidos); ?>" required>
                      <br><br>
                      <label for="email">Correo electrónico:</label>
                      <input type="email" id="email" name="email" placeholder="Ingrese su mail" value="<?php echo htmlspecialchars($email); ?>" required>
                      <br><br>
                      <label for="contrasena">Cambiar Contraseña:</label>
                      <input type="password" id="contrasena" name="contrasena" placeholder="Ingrese nueva contraseña">
                      <br><br>
                      <input type="submit" value="Guardar Cambios">
                  </form>
              </section>
          </main>
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
                    <a title="Facebook" href="http://www.twitter.com"><img class="fakeimg1" src="./assets/images/galeria/icontwitter.jpg" alt="imagen1"></a>
                    <a title="Twitter" href="http://www.facebook.com"><img class="fakeimg3" src="./assets/images/galeria/face.jpg" alt="imagen1"></a>
                    <a title="Instagram" href="http://www.instagram.com"><img class="fakeimg2" src="./assets/images/galeria/insta.jpg" alt="imagen1"></a>
                  </nav>
                  <p>&copy; MasterD - 2023 / Todos los derechos reservados </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>

          </footer>
      </div>
  </body>
  </html>
