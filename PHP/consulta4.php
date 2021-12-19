<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();
    mysqli_set_charset($conexion,"uft8");

    $insert_codigo_produ = $_POST['registrar_codigo'];
    $insert_nombre_produ = $_POST['registrar_nombre'];
    $insert_descri_produ = $_POST['registrar_descripcion'];
    $insert_precio_produ = $_POST['registrar_precio'];
    $insert_nombre_prove = $_POST['nom_proveedor'];         //SOLO PARA LA PRIMERA CONSULTA
    
    $encontrado = false;

    $consulta = mysqli_query($conexion, "SELECT `id_proveedor`,`nombre_proveedor` FROM `proveedor`") or die ("Error al consultar: datos de producto");
    //Capturamos el id del proveedor con una consulta
    while (($fila = mysqli_fetch_array($consulta))!=NULL) {
        if($fila['nombre_proveedor']==$insert_nombre_prove){
            $insert_id_prove = $fila['id_proveedor'];
            $encontrado=true;
        }
    }
    mysqli_free_result($consulta);

    if($encontrado==true){
        $consulta = mysqli_query($conexion, "INSERT INTO `producto`( `cod_producto`, `nombre_producto`, `descripcion`, `precio_producto`, `id_proveedor1`, `estado`) 
        VALUES ('$insert_codigo_produ','$insert_nombre_produ','$insert_descri_produ','$insert_precio_produ','$insert_id_prove','ACTIVO')") or die ("Error al consultar: Agregar nuevo producto");
        //Capturamos el id del proveedor con una consulta
        echo "<br>Agregado con éxito <br>";
    }else{
        echo "<br>Error <br>";
    }
    
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------

?>