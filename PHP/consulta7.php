<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
foco_input();
</script>
<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();
    mysqli_set_charset($conexion,"uft8");

    $consult_codigo_produ = $_POST['codigo_producto'];

    $consulta = mysqli_query($conexion, "SELECT `nombre_producto`,`precio_producto`, proveedor.nombre_proveedor FROM `producto` INNER JOIN proveedor ON proveedor.id_proveedor=producto.id_proveedor1 WHERE `cod_producto`='$consult_codigo_produ'") or die ("Error al consultar: datos de  producto");
    //Capturamos los datos
    while (($fila = mysqli_fetch_array($consulta))!=NULL) {
        $consult_nombre_produ = $fila['nombre_producto'];
        $consult_nombre_prove= $fila['nombre_proveedor'];
        $consult_precio_produ = $fila['precio_producto'];
    
?>  </tr><table border="1" id="tablaprueba"> 
    <tbody id="tbodyform">
    <tr>
        <td><?php echo ucwords($consult_nombre_produ) ?></td>
        <td><?php echo $consult_nombre_prove ?></td>
        <td><span class="precio"><?php echo $consult_precio_produ ?></span></td>
        <td><input type="number" class="cantidad" value="1" min="1"/></td>
        <td class="total"><span class="total"><?php echo $consult_precio_produ ?></span></td>
        <td><input type="button" class="borrar" value=" X "></input></td>
    </tr>
    </tbody>
    </table>
    <?PHP
        break;
    }
    ?>
<script type="text/javascript">
    limpiarFormulario();
    foco_input();
</script>
