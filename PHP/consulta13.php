<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();
    mysqli_set_charset($conexion,"uft8");

    $consulta_proveedor = $_POST['nombre_proveedor1'];

    $consulta = mysqli_query($conexion, 
    "SELECT `nombre_proveedor`, `direccion_proveedor`, `telefono_proveedor` 
    FROM `proveedor`
    WHERE `nombre_proveedor`='$consulta_proveedor'") or die ("Error al consultar: datos de empleados");
    
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        ?>
        <tr>
        <?PHP
            $nombre = $fila['nombre_proveedor'];
            $direcc = $fila['direccion_proveedor'];
            $telefo = $fila['telefono_proveedor'];

        ?>
        </tr>
        <?PHP
    }
    mysqli_free_result($consulta);
    ?>
        </table>

        <form id='form_modificar_proveedor_2' method='POST' width="100%">
        <fieldset>
            <legend>Datos</legend>
            <label>Nombre:</label><br>
            <input type='text' id='nombre' name='nombre' value='<?php echo $nombre; ?>' readonly  class="w3-inputs"><br><br> 
            <label>Direccion:</label><br>
            <input type='text' id='direcc' name='direcc' value='<?php echo $direcc; ?>'  class="w3-inputs"><br><br>   
            <label>Telefono:</label><br>
            <input type='text' id='tele' name='tele' value='<?php echo $telefo; ?>'  class="w3-inputs"><br><br> 

            <button type='button' id='Enviar13_2' class="w3-btn w3-teal">Modificar</button><br><br>
            <input type='reset' value='Datos iniciales' class="w3-btn w3-teal">
        </fieldset>
    </form>
    <div id="respuesta13_2"></div>
        <script>
            $('#Enviar13_2').click(function(){
                $.ajax({
                    url:'../PHP/consulta13_2.php',
                    type:'POST',
                    data: $('#form_modificar_proveedor_2').serialize(),
                    success: function(res){
                        $('#respuesta13_2').html(res);
                    },
                    error: function(res){
                        alert("Problemas al tratar de enviar el formulario");
                    }
                });
            });
        </script>


    <?PHP
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
    
?>