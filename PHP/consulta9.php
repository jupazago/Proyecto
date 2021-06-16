<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();
    mysqli_set_charset($conexion,"uft8");

    $consult_identi_produ = $_POST['identi_empleado'];

    $consulta = mysqli_query($conexion, 
    "SELECT `identificacion_empleado`,`nombre_empleado`,`direccion_empleado`,`telefono_empleado` 
    FROM `empleado`") or die ("Error al consultar: datos de  producto");
    
    //Capturamos los datos
    while (($fila = mysqli_fetch_array($consulta))!=NULL) {
        if($consult_identi_produ == $fila['identificacion_empleado']){

            $consult_nombre_produ = $fila['nombre_empleado'];
            $consult_direcc_produ = $fila['direccion_empleado'];
            $consult_telefo_produ = $fila['telefono_empleado'];
        
            break;
        }
    }
?>

    <form id='form_modificar_empleado_2' method='POST'>
        <fieldset>
            <legend>Modificar Datos</legend>
            <label>Identificación:</label><br>
            <input type='text' id='identi_empleado' name='identi_empleado' class="w3-inputs"  value='<?php echo $consult_identi_produ; ?>' readonly><br><br>
            <label>Nombre:</label><br>
            <input type='text' id='nombre_empleado' name='nombre_empleado' class="w3-inputs" value='<?php echo $consult_nombre_produ; ?>' readonly><br><br>
            <label>Dirección:</label><br>
            <input type="text" id='direccion_empleado' name='direccion_empleado' class="w3-inputs" value='<?php echo $consult_direcc_produ; ?>'><br><br>
            <label>Teléfono:</label><br>
            <input type='text' id='telefono_empleado' name='telefono_empleado' class="w3-inputs" value='<?php echo $consult_telefo_produ; ?>'><br><br>               
            <button type='button' id='Enviar9_2' class="w3-btn w3-teal">Modificar</button><br><br>
            <input type='reset' value='Datos iniciales' class="w3-btn w3-teal">
        </fieldset>
    </form>
    <div id="respuesta9_2"></div>
        <script>
            $('#Enviar9_2').click(function(){
                $.ajax({
                    url:'../PHP/consulta9_2.php',
                    type:'POST',
                    data: $('#form_modificar_empleado_2').serialize(),
                    success: function(res){
                        $('#respuesta9_2').html(res);
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