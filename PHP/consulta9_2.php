<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();
    mysqli_set_charset($conexion,"uft8");

    $insert_iden_produ = $_POST['identi_empleado'];
    $insert_nomb_produ = $_POST['nombre_empleado'];
    $insert_dire_produ = $_POST['direccion_empleado'];
    $insert_tele_produ = $_POST['telefono_empleado'];


    $sql= "UPDATE `empleado` SET `direccion_empleado`='$insert_dire_produ',`telefono_empleado`='$insert_tele_produ' WHERE `identificacion_empleado`='$insert_iden_produ'";
    
    if(mysqli_query($conexion,$sql)){
        echo "<br>Modificado con éxito <br>";
    }else{
        echo "<br>Error al consultar: datos de producto<br>";
    }
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>