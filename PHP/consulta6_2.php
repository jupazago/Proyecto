<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();
    mysqli_set_charset($conexion,"uft8");

    $insert_codigo_produ = $_POST['codigo_producto'];
    $insert_nombre_produ = $_POST['nombre_producto'];
    $insert_descri_produ = $_POST['descrip_producto'];
    $insert_precio_produ = $_POST['precio_producto'];


    $sql= "UPDATE `producto` SET `nombre_producto`='$insert_nombre_produ',`descripcion`='$insert_descri_produ',`precio_producto`='$insert_precio_produ' WHERE `cod_producto`='$insert_codigo_produ'";
    
    if(mysqli_query($conexion,$sql)){
        echo "<br>Modificado con éxito <br>";
    }else{
        echo "<br>Error al consultar: datos de producto<br>";
    }
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>