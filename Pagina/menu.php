<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    $usuario     =      $_POST['formulario_usuario'];
    $clave       =      $_POST['formulario_clave'];

    $tipo_de_cuenta = iniciar_sesion($usuario, $clave);

    echo "Bienvenido ".$tipo_de_cuenta;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <script src="../JavaScript/funciones.js"></script>
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
</head>
<body>
    <?php
        //registrar_empleado();
        //modificar_empleado();
        //ver_cuentas_empleado();
        registrar_producto();
    ?>
</body>
</html>