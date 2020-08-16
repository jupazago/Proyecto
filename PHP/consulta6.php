<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();
    mysqli_set_charset($conexion,"uft8");

    $consult_codigo_produ = $_POST['codigo_producto'];

    $consulta = mysqli_query($conexion, "SELECT `cod_producto`,`nombre_producto`,`descripcion`,`precio_producto` FROM `producto`") or die ("Error al consultar: datos de  producto");
    //Capturamos los datos
    while (($fila = mysqli_fetch_array($consulta))!=NULL) {
        if($consult_codigo_produ == $fila['cod_producto']){

            $consult_nombre_produ = $fila['nombre_producto'];
            $consult_descri_produ = $fila['descripcion'];
            $consult_precio_produ = $fila['precio_producto'];
        
            break;
        }
    }
?>

    <form id='form_modificar_producto_2' method='POST'>
        <fieldset>
            <legend>Modificar producto</legend>
            <label>Código:</label><br>
            <input type='text' id='codigo_producto' name='codigo_producto' value='<?php echo $consult_codigo_produ; ?>' readonly><br><br>
            <label>Nombre:</label><br>
            <input type='text' id='nombre_producto' name='nombre_producto' value='<?php echo $consult_nombre_produ; ?>'><br><br>
            <label>descripción:</label><br>
            <textarea id='descrip_producto' name='descrip_producto' rows="4" cols="50"><?php echo $consult_descri_produ; ?></textarea><br><br>
            <label>Precio:</label><br>
            <input type='number' id='precio_producto' name='precio_producto' value='<?php echo $consult_precio_produ; ?>'><br><br>               
            <button type='button' id='Enviar6_2'>Modificar</button>
            <input type='reset' value='Limpiar'>
        </fieldset>
    </form>
    <div id="respuesta6_2"></div>
        <script>
            $('#Enviar6_2').click(function(){
                $.ajax({
                    url:'../PHP/consulta6_2.php',
                    type:'POST',
                    data: $('#form_modificar_producto_2').serialize(),
                    success: function(res){
                        $('#respuesta6_2').html(res);
                    },
                    error: function(res){
                        alert("Problemas al tratar de enviar el formulario");
                    }
                });
            });
        </script>

<?php

mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
?>