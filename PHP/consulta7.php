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

    $consulta = mysqli_query($conexion, "SELECT `id_producto`,`nombre_producto`,`precio_producto`, proveedor.nombre_proveedor FROM `producto` INNER JOIN proveedor ON proveedor.id_proveedor=producto.id_proveedor1 WHERE `cod_producto`='$consult_codigo_produ'") or die ("Error al consultar: datos de  producto");
    //Capturamos los datos
    while (($fila = mysqli_fetch_array($consulta))!=NULL) {
?>  </tr><table border="0" id="tablaprueba" width="100%"> 
    <tbody id="tbodyform">
        
        <td width="25%" class="ides" style="display:none"><?php echo $fila['id_producto'] ?></td>
        <td width="25%" class="names"><?php echo ucwords($fila['nombre_producto']) ?></td>
        <td width="15%"><?php echo $fila['nombre_proveedor'] ?></td>
        <td width="15%" class="precios"><span class="precio"><?php echo $fila['precio_producto'] ?></span></td>
        <td width="5%"><input type="number" class="cantidad" value="1" min="1"/></td>
        <td width="20%" class="total"><span class="total"><?php echo $fila['precio_producto'] ?></span></td>
        <td width="20%"><input type="button" class="borrar" value=" X " style="background-color: #f44336;"></input></td>
    
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
