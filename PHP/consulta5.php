<?php
//Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();
    mysqli_set_charset($conexion,"uft8");

    $insert_nombre_produ = str_replace(" ","_",$_POST['registrar_nombre']);
    $insert_direcc_produ = $_POST['registrar_direccion'];
    $insert_telefo_produ = $_POST['registrar_telefono'];

    $sql= "INSERT INTO `proveedor`(`nombre_proveedor`, `direccion_proveedor`, `telefono_proveedor`, `estado`) VALUES ('$insert_nombre_produ','$insert_direcc_produ','$insert_telefo_produ','ACTIVO')";
    
    if(mysqli_query($conexion,$sql)){
        echo "<br>Agregado con éxito <br>";
    }else{
        echo "<br>Error al consultar: datos de proveedor<br>";
    }

    
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>