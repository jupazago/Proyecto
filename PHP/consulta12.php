<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();
    mysqli_set_charset($conexion,"uft8");

    $consult_nombre_produ = $_POST['nombre_proveedor1'];

    $consulta = mysqli_query($conexion, "SELECT `nombre_proveedor`, `direccion_proveedor`, `telefono_proveedor` FROM `proveedor`") or die ("Error al consultar: datos de  producto");
    ?>
    <table width="100%">
        <tr>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Teléfono</th>
        </tr>
    <?PHP

    //Capturamos los datos
    while (($fila = mysqli_fetch_array($consulta))!=NULL) {
        if($consult_nombre_produ == $fila['nombre_proveedor']){
            echo "<td>".$fila['nombre_proveedor']."</td>";
            echo "<td>".$fila['direccion_proveedor']."</td>";
            echo "<td>".$fila['telefono_proveedor']."</td>";
            break;
        }
    }
    mysqli_free_result($consulta);
?>   
        </table>

<?php

mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>