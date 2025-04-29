1.1. INSTRUCCIONES
Como ejercicio final del módulo se debe crear un sitio web, podrá ser de una
empresa ficticia o vuestro sitio como programadores web. La información no
tiene por qué ser real.
Para la realización de este proyecto deberéis utilizar: HTML5, CSS3, JavaScript,
SQL y PHP.
El proyecto se debe entregar como un archivo comprimido que contenga la
carpeta completa del sitio web, incluyendo en el mismo la base de datos (archivo sql) que has creado.
Importante: Leer el enunciado completo te ayudará a entender lo que debes realizar
para este ejercicio. Recuerda cuidar la presentación del trabajo final ya que sino el
trabajo no se valorará.
3
TRABAJO FINAL: MYSQL
1.2. ESPECIFICACIONES GENERALES DEL SITIO WEB
La primera parte del ejercicio se compondrá de dos apartados:
(1 punto) Base de datos del sitio web que contendrá las siguientes tablas:
◼ users_data, que contendrá la información personal de los usuarios, con
los campos:
 idUser _ Clave principal de tipo INT, auto incrementativo, no nulo
 nombre _ este campo no podrá ser nulo
 apellidos _ este campo no podrá ser nulo
 email _ este campo deberá de ser único y no podrá ser nulo
 teléfono _ este campo deberá ser de tipo texto y no nulo
 fecha de nacimiento _ campo de tipo fecha, no nulo
 dirección _ campo de tipo texto
 sexo _ campo de tipo texto o enum
◼ users_login, que contendrá la información de inicio de sesión de los
usuarios registrados. Esta tabla deberá incluir los siguientes campos:
 idLogin _ Clave principal de tipo INT, auto incrementativo, no nulo
 idUser _ clave foránea que relaciona esta tabla con users_data,
deberá ser de tipo INT, no nulo y único.
 usuario _ campo de tipo texto, no nulo y único
 password _ campo de tipo texto, no nulo
 rol _ no nulo. Los valores de este campo serán: admin o user.
◼ citas, que contendrá la siguiente información:
 idCita _ Clave principal de tipo INT, auto incrementativo, no nulo
 idUser _ FK que relaciona esta tabla con users_data, INT, no nulo
 fecha cita _ campo de tipo fecha, no nulo
 motivo cita _ campo ----de tipo texto
4
TRABAJO FINAL: PHP
◼ noticias, esta tabla contendrá las diferentes noticias que escriban los
administradores del sitio web y deberá contener la siguiente finromación:
 idNoticia _ PK de tipo INT, auto incrementativo, no nulo
 título _ campo de tipo texto, no nulo, unique
 imagen _ este campo no podrá ser nulo
 texto _ campo de tipo texto largo, no nulo
 fecha _ campo de tipo fecha, no nulo
 idUser _ FK que relaciona esta tabla con users_data, INT, no nulo
(4 puntos) Sitio web compuesto de :
◼ Una página de inicio que se llamará index. Esta página será la portada
del sitio web y deberá contener varias secciones en las que se incluyan
diferentes elementos de HTML cómo: textos, imágenes, hipervínculos,
…
◼ Una página de noticias que se llamará noticias. En ella se deberán mostrar todas las no
ticias de la base de datos. Para cada noticia se ha de
ver el título, fecha de publicación, texto de la noticia, foto de la noticia y
el nombre del usuario que la ha creado.
◼ Una página que permita a los visitantes registrarse en el sitio web, llamada registro. 
Esta página deberá incluir:
 Un enlace a la página de inicio de sesión por si el visitante ya estuviese registrado
 en el sitio web.
 Un formulario completo que obtenga todos los datos personales
de los visitantes necesarios para insertarlos en la tabla users_data
y los datos de inicio de sesión que desean establecer necesarios
para insertarlos en la tabla users_login.
Siempre que un visitante se registre a través de este formulario lo hará con
el rol: user. Si el visitante envía el formulario y por algún motivo no puede registrarse
 (ya se ha registrado anteriormente, ….) deberá recibir un
mensaje de error. En el caso de que el visitante se registre correctamente, se le deberá
 enviar un mensaje de confirmación y redirigirle al
login.

5
TRABAJO FINAL: MYSQL
◼ Una página que permita a los visitantes iniciar sesión en el sitio web,
llamada login. Esta página deberá incluir:
 Un hipervínculo que permita al visitante ser redirigido a la página
de registro si no tiene cuenta.
 Un formulario de inicio de sesión que solicite al usuario los datos
necesarios para poder loguear en el sitio web.
Si el visitante introduce datos incorrectos en el formulario de inicio de
sesión, deberá recibir un mensaje de error. En el caso de que los datos
introducidos sean correctos deberá aprender un mensaje de confirmación y redirigirle al index.
◼ El visitante deberá ver en todas las páginas del sitio web (index, noticias, registro e inicio
de sesión) una barra de navegación que le permitirá navegar entre dichas páginas y que resalte en
 qué página se encuentra en ese momento dentro del sitio web.
Detalles importantes a tener en cuenta durante la realización del ejercicio:
◼ Los formularios se deben validar con PHP (al menos los campos obligatorios)
◼ La contraseña deberá encriptarse durante el registro de los usuarios
◼ La barra de navegación será la misma para los visitantes, usuarios y
administradores, pero las secciones que esta mostrará variarán dependiendo de si se trata
 de un visitante, usuario o administrador.
6
TRABAJO FINAL: PHP
1.3. ESPECIFICACIONES PARA LOS USUARIOS (2.5 PTS)
Cuando un visitante inicia sesión a través de la página de login y en sus credenciales tiene el rol:
 user, se convierte en un usuario.
Un usuario tendrá acceso a nuevas páginas, además del index y noticias, que
serán:
◼ Una página llamada perfil, dónde se mostrarán los datos personales del
usuario (nombre, apellidos, …..) y también se podrán modificar. El nombre de usuario con el que
 inicia sesión no se podrá cambiar. La contraseña con la que inicia sesión se podrá cambiar pero 
 no se podrá ver.
◼ Una página llamada citaciones, dónde el usuario podrá:
 Solicitar citas en el sitio web a través de un formulario, que permita insertar datos en la 
tabla de citas.
 Modificar las citas que ya tenga planificadas, siempre y cuando estas no se hayan realizado,
 es decir, siempre que la fecha de la cita
no sea anterior a la del día de hoy.
 Borrar citas planificadas que aún no se hayan realizado.
La barra de navegación de un usuario deberá mostrar las siguientes secciones:
◼ index
◼ noticias
◼ citaciones
◼ perfil
◼ cerrar sesión (Si el usuario hace clic sobre esta opción, se le permitirá
salir de la cuenta y se convertirá en un visitante, por lo que ya no se verán las páginas perfil
 y citaciones en la barra de navegación, exclusivas
de los usuarios).
7
TRABAJO FINAL: MYSQL
1.4. ESPECIFICACIONES PARA LOS ADMINISTRADORES
(2.5 PTS)
Cuando un visitante inicia sesión a través de la página de login y en sus credenciales tiene el rol:
21b admin, se convierte en un administrador.
Un administrador tendrá acceso a nuevas páginas, además del index, noticias y
perfil, que serán:
◼ Una página llamada usuarios-administracion, dónde el administrador
podrá:
 Crear nuevos usuarios y asignarles el rol de user o admin.
 Modificar los usuarios ya existentes
 Borrar usuarios ya existentes
◼ Una página llamada citas-administracion, dónde el administrador podrá
seleccionar a un usuario y :
 Crear citas para el usuario
 Ver las citas que tiene asignadas el usuario
 Modificar las citas asignadas al usuario
 Borrar las citas asignadas al usuario
◼ Una página llamada noticias-administracion, dónde el administrador podrá:
 Crear noticias
 Ver todas las noticias ya creadas
 Modificar cualquiera de las noticias ya existentes
 Borrar cualquiera de las noticias existentes
8
TRABAJO FINAL: PHP
La barra de navegación de un administrador deberá mostrar las siguientes secciones:
◼ index
◼ noticias
◼ usuarios-administracion
◼ citaciones-administracion
◼ noticias-administracion
◼ perfil
◼ cerrar sesión (Si el administrador hace clic sobre esta opción, se le
permitirá salir de la cuenta y se convertirá en un visitante, por lo que en
la barra de navegación ya no se deberán ver (ni poder acceder) a las
secciones exclusivas de los administradores).