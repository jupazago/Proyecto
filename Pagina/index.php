<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    //existencia_de_la_conexion();    //Verificamos la funcion

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <script type="text/javascript" src="../JavaScript/funciones.js"></script>
</head>
<body>
    <form name="formulario_iniciar_sesion" action="menu.php" method='post'>
        <h2>Usuario</h2>
        <input type="text" name="formulario_usuario" id="formulario_usuario"/>
        <h2>Clave</h2>
        <input type="text" name="formulario_clave" id="formulario_clave"/>
        <br><br>
        <input type="submit" value="Iniciar Sesión" id="enviar">
    </form>
    <div id="respuesta"></div>
</body>
</html>