<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();
    mysqli_set_charset($conexion,"uft8");

    $consult_nombre_cliente = $_POST['nombre_cliente1'];

    $consulta = mysqli_query($conexion, "SELECT `nombre_cliente`, `identificacion_cliente`, `direccion_cliente`, `telefono_cliente` 
    FROM `cliente`") or die ("Error al consultar: datos de  cliente");
    ?>
    <table width="100%">
        <tr>
            <th>Nombre</th>
            <th>Identificación</th>
            <th>Dirección</th>
            <th>Teléfono</th>
        </tr>
    <?PHP

    //Capturamos los datos
    while (($fila = mysqli_fetch_array($consulta))!=NULL) {
        if($consult_nombre_cliente == $fila['nombre_cliente']){
            echo "<td>".$fila['nombre_cliente']."</td>";
            echo "<td>".$fila['identificacion_cliente']."</td>";
            echo "<td>".$fila['direccion_cliente']."</td>";
            echo "<td>".$fila['telefono_cliente']."</td>";
            break;
        }
    }
    mysqli_free_result($consulta);
?>   
        </table>

<?php

mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>