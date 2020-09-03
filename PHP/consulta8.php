<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();
    mysqli_set_charset($conexion,"uft8");

    $insert_nombre = str_replace(" ","_",$_POST['registrar_nombre']);
    $insert_identi = $_POST['registrar_identificacion'];
    $insert_direcc = $_POST['registrar_direccion'];
    $insert_telefo = $_POST['registrar_telefono'];
    
    $sql= "INSERT INTO `cliente`(`nombre_cliente`, `identificacion_cliente`, `direccion_cliente`, `telefono_cliente`, `estado`) VALUES ('$insert_nombre','$insert_identi','$insert_direcc','$insert_telefo','ACTIVO')";
    
    if(mysqli_query($conexion,$sql)){
        echo "<br>Agregado con éxito <br>";
    }else{
        echo "<br>Error al consultar: datos de Cliente<br>";
    }


    
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------

?>