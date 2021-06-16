<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();
    mysqli_set_charset($conexion,"uft8");

    $consult_codigo_produ = $_POST['codigo_producto'];

    $consulta = mysqli_query($conexion, "SELECT `cod_producto`,`nombre_producto`,`descripcion`,`precio_producto`, proveedor.nombre_proveedor FROM `producto` INNER JOIN `proveedor` ON producto.id_proveedor1 = proveedor.id_proveedor") or die ("Error al consultar: datos de  producto");
    ?>
    <table width="100%">
        <tr>
            <th>Codigo de Producto</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Proveedor</th>
        </tr>
    <?PHP

    //Capturamos los datos
    while (($fila = mysqli_fetch_array($consulta))!=NULL) {
        if($consult_codigo_produ == $fila['cod_producto']){

            echo "<td>".$fila['cod_producto']."</td>";
            echo "<td>".$fila['nombre_producto']."</td>";
            echo "<td>".$fila['descripcion']."</td>";
            echo "<td>".$fila['precio_producto']."</td>";
            echo "<td>".str_replace("_"," ",$fila['nombre_proveedor'])."</td>";
            break;
        }
    }
    mysqli_free_result($consulta);
?>   
        </table>






<?php

mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>