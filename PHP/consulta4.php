<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();
    mysqli_set_charset($conexion,"uft8");

    $insert_nombre_prove = $_POST['nom_proveedor'];
    
    
    $consulta = mysqli_query($conexion, "SELECT `id_proveedor`,`nombre_proveedor` FROM `proveedor`") or die ("Error al consultar: datos de empleados");
    //Capturamos el id del proveedor con una consulta
    while (($fila = mysqli_fetch_array($consulta))!=NULL) {
        if($fila['nombre_proveedor']==$insert_nombre_prove){
            $insert_id_prove = $fila['id_proveedor'];
        }
    }


?>