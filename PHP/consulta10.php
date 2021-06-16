<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();
    mysqli_set_charset($conexion,"uft8");

    $consult_identi_empleado = $_POST['identi_empleado'];

    $consulta = mysqli_query($conexion, 
    "SELECT `nombre_empleado`,`identificacion_empleado`,`user`,`pass`,`tipo_de_usuario`,empleado.estado 
    FROM `empleado` 
    INNER JOIN `login` ON empleado.id_login1=login.id_login 
    INNER JOIN tipo_usuario ON login.id_tipo_usuario1 = tipo_usuario.id_tipo_usuario 
    WHERE `identificacion_empleado`='$consult_identi_empleado'") or die ("Error al consultar: datos de empleados");
    
    ?>
    <table width="100%" border="1">
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
            $contrasenia = $fila['pass'];
            $identificacion = $fila['identificacion_empleado'];

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

        <form id='form_modificarpass_empleado_2' method='POST' width="100%">
        <fieldset>
            <legend>Modificar Contraseña</legend>
            <label>Identificacion:</label><br>
            <input type='text' id='identi' name='identi' value='<?php echo $identificacion; ?>' readonly  class="w3-inputs"><br><br> 
            <label>Ingrese una nueva clave:</label><br>
            <input type='text' id='contrasenia' name='contrasenia' value='<?php echo $contrasenia; ?>'  class="w3-inputs"><br><br>              
            <button type='button' id='Enviar10_2' class="w3-btn w3-teal">Modificar</button><br><br>
            <input type='reset' value='Datos iniciales' class="w3-btn w3-teal">
        </fieldset>
    </form>
    <div id="respuesta10_2"></div>
        <script>
            $('#Enviar10_2').click(function(){
                $.ajax({
                    url:'../PHP/consulta10_2.php',
                    type:'POST',
                    data: $('#form_modificarpass_empleado_2').serialize(),
                    success: function(res){
                        $('#respuesta10_2').html(res);
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