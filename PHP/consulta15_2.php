<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();
    mysqli_set_charset($conexion,"uft8");

    $nombre = $_POST['nombre'];
    $dire = $_POST['direcc'];
    $tele = $_POST['tele'];

    $sql= "UPDATE `cliente` 
    SET `direccion_cliente`='$dire', `telefono_cliente`='$tele' WHERE `nombre_cliente`='$nombre'";
    
    if(mysqli_query($conexion,$sql)){
        echo "<br>Modificado con éxito <br>";
    }else{
        echo "<br>Error al consultar: contraseña empleado<br>";
    }
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>