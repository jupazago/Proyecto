<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();
    mysqli_set_charset($conexion,"uft8");

    $consulta = mysqli_query($conexion, "SELECT `nombre_empleado`,`identificacion_empleado`,`user`,`pass`,`tipo_de_usuario`,empleado.estado FROM `empleado` INNER JOIN `login` ON empleado.id_login1=login.id_login INNER JOIN tipo_usuario ON login.id_tipo_usuario1=tipo_usuario.id_tipo_usuario") or die ("Error al consultar: datos de empleados");
    
    ?>
    <table width="100%">
        <tr>
            <th>Nombre</th>
            <th>Idenficiación</th>
            <th>Usuario</th>
            <th>Clave</th>
            <th>Tipo</th>
            <th>Estado</th>
        </tr>
    <?PHP
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        ?>
        <tr>
        <?PHP
            echo "<td>".$fila['nombre_empleado']."</td>";
            echo "<td>".$fila['identificacion_empleado']."</td>";
            echo "<td>".$fila['user']."</td>";
            echo "<td>".$fila['pass']."</td>";
            echo "<td>".str_replace("_"," ",$fila['tipo_de_usuario'])."</td>";
            echo "<td>".$fila['estado']."</td>";
        ?>
        </tr>
        <?PHP
    }
    mysqli_free_result($consulta);
    ?>
        </table>
    <?PHP
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
    
?>