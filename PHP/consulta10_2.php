<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();
    mysqli_set_charset($conexion,"uft8");

    $contrasenia = $_POST['contrasenia'];
    $identi = $_POST['identi'];

    $sql= "UPDATE `login` 
    INNER JOIN `empleado` ON empleado.id_login1 = login.id_login 
    SET login.pass = '$contrasenia'   
    WHERE empleado.identificacion_empleado = '$identi'";
    
    if(mysqli_query($conexion,$sql)){
        echo "<br>Modificado con éxito <br>";
    }else{
        echo "<br>Error al consultar: contraseña empleado<br>";
    }
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>