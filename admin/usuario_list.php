<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php
session_start();
//hay que modificarlo como panel de control
$datos = $_SESSION['usuario'];
if ($datos[2] == 'admin'){

    echo "hola $datos[1]";
    $array = $_SESSION['listadoUsers'];

    echo '<hr>';
    unset($_SESSION['listadoUsers']);

    foreach($array as $key => $value){
        echo "$key : $value->nombre<br>";
        echo '<hr>';

    }
}
?>

    </body>
</html>


