<?php
  // Se comprueba si hay sesión y si no la hay, se inicia una.
  if(session_status() == PHP_SESSION_NONE){
    session_start();
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                  <li><a href="#" class="activo">Registro</a></li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </header>

    <!-- COMPROBACIÓN DE SI EXISTEN MENSAJES DE SESIÓN -->
    <div>
      <?php
        // SI EXISTE UN MENSAJE DE ERROR
        if(isset($_SESSION['error_msg'])){
          // Si mensaje de error contiene un array de errores
          if(is_array($_SESSION['error_msg'])){
            echo '<div class="error_msg">';
            
            foreach($_SESSION['error_msg'] as $error){
              echo '<p>'.$error.'</p>';
            }

            echo '</div>';

          } else {
            // Se muestra el mensaje de error
            echo '<div class="error_msg">'.$_SESSION['error_msg'].'</div>';
          }

          // Se elimina el mensaje de error para que no aparezca en futuras recargas de la página
          unset($_SESSION['error_msg']);
        }

        // SI EXISTE UN MENSAJE DE ÉXITO
        if(isset($_SESSION['success_msg'])){
          // Se muestra el mensaje de éxito
          echo '<div class="success_msg">'.$_SESSION['success_msg'].'</div>';
          
          // Se elimina el mensaje de éxito para que no aparezca en futuras recargas de la página
          unset($_SESSION['success_msg']);
        }
      ?>
    </div>

    <div class="form_registro">
      <h2>Formulario de Registro</h2>
      <form action="../controladores/c_registro.php" method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" ><br><br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" ><br><br>

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" ><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" ><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" ><br><br>

        <label for="confirm_password">Confirmar Contraseña:</label>
        <input type="password" id="confirm_password" name="confirm_password" ><br><br>

        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" ><br><br>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion"><br><br>

        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono"><br><br>

        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo" >
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
                  <a title="Facebook" href="http://www.twitter.com"><img class="fakeimg1"
                      src="../assets/images/galeria/icontwitter.jpg" alt="imagen1"></a>
                  <a title="Twitter" href="http://www.facebook.com"><img class="fakeimg3"
                      src="../assets/images/galeria/face.jpg" alt="imagen1"></a>
                  <a title="Instagram" href="http://www.instagram.com"><img class="fakeimg2"
                      src="../assets/images/galeria/insta.jpg" alt="imagen1"></a>
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