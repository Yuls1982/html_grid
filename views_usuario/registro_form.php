        <!DOCTYPE html>
        <html lang="es">
        <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" href="../estilos/estilos2.css">
          <title>Formulario de Registro</title>
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
                          <li><a href="../index.html">Inicio</a></li>
                          <li><a href="./noticias.php">Noticias</a></li>
                          <li><a href="#" class="activo">Registro</a></li>
                          <li><a href="./login.php">Login</a></li>
                        </ul>
                      </div>
                    </nav>
                  </div>
                </div>
              </div>
            </header>
            
            <div class="caja1">
                <h2>Formulario de Registro</h2>
                <form action="procesar_registro.php" method="post">
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" required><br><br>

                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required><br><br>

                    <label for="apellidos">Apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" required><br><br>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required><br><br>

                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required><br><br>
                    
                    <label for="confirm_password">Confirmar Contraseña:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required><br><br>

                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required><br><br>

                    <label for="direccion">Dirección:</label>
                    <input type="text" id="direccion" name="direccion"><br><br>

                    <label for="telefono">Teléfono:</label>
                    <input type="tel" id="telefono" name="telefono"><br><br>

                    <label for="sexo">Sexo:</label>
                    <select id="sexo" name="sexo" required>
                        <option value="">Seleccione</option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                    </select><br><br>

                    <input type="submit" value="Registrarse">
                </form>
            </div>

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
                      <div class="footer-text3">
                      <nav class="mio">
                      <h5><a href="dondeestamos.html">Donde estamos</a></h5>
                      <h6><a href="aviso.html">Aviso legal</a></h6>
                    </nav>

                        <nav class="mia">
                          <a title="Facebook" href="http://www.twitter.com"><img class="fakeimg1" src="../assets/images/galeria/icontwitter.jpg" alt="imagen1"></a>
                          <a title="Twitter" href="http://www.facebook.com"><img class="fakeimg3" src="../assets/images/galeria/face.jpg" alt="imagen1"></a>
                          <a title="Instagram" href="http://www.instagram.com"><img class="fakeimg2" src="../assets/images/galeria/insta.jpg" alt="imagen1"></a>
                        </nav>
                        <p class="text_final">&copy; MasterD - 2023 / Todos los derechos reservados </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </footer>
          </div>
        </body>
        </html>
