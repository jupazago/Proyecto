<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    $usuario     =      $_POST['formulario_usuario'];
    $clave       =      $_POST['formulario_clave'];

    $tipo_de_cuenta = iniciar_sesion($usuario, $clave);
    echo $tipo_de_cuenta;


?>