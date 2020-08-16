<?php

    //Funcion que verifica si existeel archivo de conexion de la base de datos
    function existencia_de_la_conexion(){
        try {
            //Verificar si existe el archivo de conexion
            if(!file_exists('../PHP/conexion.php')){
                throw new Exception ('PHP: File  -conexion-  no existe',1);  //NO existe, captura excepcion
            }else{
                return true;
                //require_once("../PHP/conexion.php");                //SI Existe, continuar y realizar la conexion
            }
        
        } catch (Exception $excepcion) {
            //Captura de excepcion y su respectivo codigo
            echo 'Capture: ' .  $excepcion->getMessage(), "<br>";
            echo 'Código: ' . $excepcion->getCode(), "<br>";
        }
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function iniciar_sesion($usuario, $clave){
        
        if(existencia_de_la_conexion()){
            require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
        }
        $conexion = conectar();                     //Obtenemos la conexion
        
        //Consulta a la base de datos en la tabla login
        $consulta = mysqli_query($conexion, "SELECT `user`,`pass`,`tipo_de_usuario` FROM `login` INNER JOIN tipo_usuario ON login.id_tipo_usuario1 = tipo_usuario.id_tipo_usuario WHERE login.estado='ACTIVO'")
        or die ("Error al iniciar sesión: ");

        $encontrado = false;
        while (($fila = mysqli_fetch_array($consulta))!=NULL){

        //Comprobamos la existencia del usuario y contraseña del formulario en los resulatdos de la bases de datos
            if($usuario == $fila['user'] && $clave == $fila['pass']){
                //Existe en la base de datos y es conrrecto los datos
                $tipo_de_cuenta = $fila['tipo_de_usuario']; //Obtenemos su tipo de cuenta
                $encontrado = true;
                mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
                mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
                break;
            }
        }
        if($encontrado==false){
            mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
            mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
            //Si no se encontró registro alguno, regresamos al index de inicio de sesión
            ?>
            <script type="text/javascript">
				window.history.back();
			</script>
            <?php
        }

        return $tipo_de_cuenta;
        
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function registrar_empleado(){
        ?>
        <div>
        <form id="form_registrar_empleado" method="POST">
            <fieldset>
                <legend>Agregar nuevo empleado/administrador:</legend>
                <label>Nombre:</label><br>
                <input type="text" id="registrar_nombre" name="registrar_nombre"><br><br>
                <label>Identificación:</label><br>
                <input type="number" id="registrar_identificacion" name="registrar_identificacion"><br><br>
                <label>Dirección:</label><br>
                <input type="text" id="registrar_direccion" name="registrar_direccion"><br><br>
                <label>Teléfono:</label><br>
                <input type="text" id="registrar_telefono" name="registrar_telefono"><br><br>
                <label>Usuario:</label><br>
                <input type="text" id="registrar_usuario" name="registrar_usuario"><br><br>
                <label>Clave:</label><br>
                <input type="text" id="registrar_clave" name="registrar_clave"><br><br>
                <label>Tipo de Cuenta:</label><br>
                <input list="tipo_cuenta" name="tipo_cuenta">
                    <datalist id="tipo_cuenta">
                    <?php
                        //Codigo para desplegar en el DATALIST los tipos de usuarios disponibles
                        if(existencia_de_la_conexion()){
                            require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
                        }
                        $conexion = conectar();                     //Obtenemos la conexion
                        
                        //Consulta a la base de datos en la tabla login
                        $consulta = mysqli_query($conexion, "SELECT `id_tipo_usuario`,`tipo_de_usuario` FROM `tipo_usuario` WHERE `estado`='ACTIVO'") or die ("Error al consultar: tipos de usuarios");

                        while (($fila = mysqli_fetch_array($consulta))!=NULL){
                            // traemos los tipos de usuario existentes en la base de datos
                            $BD_id_tipo_usuario = $fila['id_tipo_usuario'];
                            $BD_tipo_de_usuario = $fila['tipo_de_usuario'];
                            echo "<option value=".$BD_id_tipo_usuario." label=".$BD_tipo_de_usuario."></option>";
                        }
                        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
                    ?>
                    </datalist><br><br>
                    
                <button type="button" id="Enviar">Registrar</button>
                <input type="reset" value="Limpiar">
            </fieldset>
        </form>
        <div id="respuesta1"></div>
        <script>
            $('#Enviar').click(function(){
                $.ajax({
                    url:'../PHP/consulta1.php',
                    type:'POST',
                    data: $('#form_registrar_empleado').serialize(),
                    success: function(res){
                        $('#respuesta1').html(res);
                    },
                    error: function(res){
                        alert("Problemas al tratar de enviar el formulario");
                    }
                });
            });
        </script>
        </div>
    <?php
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////
    function modificar_empleado(){
        
        ?>
        
        <form id="form_inactivar_empleado" method="POST">
            <fieldset>
                <legend>Activar o Inactivar cuenta del empleado/administrador:</legend>
                <label>Identificación:</label><br>
                <input type="text" id="consultar_identificacion" name="consultar_identificacion"><br><br>
                <button type="button" id="Enviar2">Continuar</button>
                <input type="reset" value="Limpiar">
            </fieldset>
        </form>
        <div id="respuesta2"></div>
        <script>
            $('#Enviar2').click(function(){
                $.ajax({
                    url:'../PHP/consulta2.php',
                    type:'POST',
                    data: $('#form_inactivar_empleado').serialize(),
                    success: function(res){
                        $('#respuesta2').html(res);
                    },
                    error: function(res){
                        alert("Problemas al tratar de enviar el formulario");
                    }
                });
            });
        </script>
        <?php
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////

    function ver_cuentas_empleado(){
        ?>
        <form id="form_ver_empleados" method="POST">
            <fieldset>
                <legend>Información completa de cuentas</legend>
                <button type="button" id="Enviar3">Ver Información</button>
            </fieldset>
        </form>
        <div id="respuesta3"></div>
        <script>
            $('#Enviar3').click(function(){
                $.ajax({
                    url:'../PHP/consulta3.php',
                    type:'POST',
                    data: $('#form_ver_empleados').serialize(),
                    success: function(res){
                        $('#respuesta3').html(res);
                    },
                    error: function(res){
                        alert("Problemas al tratar de enviar el formulario");
                    }
                });
            });
        </script>
    <?PHP
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////

    function registrar_producto(){
        ?>
        <form id="form_registrar_producto" method="POST">
            <fieldset>
            <legend>Registrar producto</legend>
                <label>Código:</label><br>
                <input type="text" id="registrar_codigo" name="registrar_codigo"><br><br>
                <label>Nombre:</label><br>
                <input type="text" id="registrar_nombre" name="registrar_nombre"><br><br>
                <label>Precio:</label><br>
                <input type="number" id="registrar_precio" name="registrar_precio"><br><br>
                <label>Descripción:</label><br>
                <textarea id="registrar_descripcion" name="registrar_descripcion" rows="4" cols="50"></textarea><br><br>
                <label>Proveedor:</label><br>
                <input list="nom_proveedor" name="nom_proveedor">
                    <datalist id="nom_proveedor">
                    <?php
                        if(existencia_de_la_conexion()){
                            require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
                        }
                        $conexion = conectar();                     //Obtenemos la conexion
                        
                        //Consulta a la base de datos en la tabla provvedor
                        $consulta = mysqli_query($conexion, "SELECT `nombre_proveedor` FROM `proveedor` ORDER BY `nombre_proveedor` ASC") or die ("Error al consultar: proveedores");

                        while (($fila = mysqli_fetch_array($consulta))!=NULL){
                            // traemos los proveedores existentes en la base de datos
                            $BD_nombre_proveedor = $fila['nombre_proveedor'];
                            echo "<option value=".$BD_nombre_proveedor."></option>";
                        }
                        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
                    ?>
                    </datalist><br><br>
                    
                <button type="button" id="Enviar4">Registrar</button>
                <input type="reset" value="Limpiar">
            </fieldset>
        </form>
        <div id="respuesta4"></div>
        <script>
            $('#Enviar4').click(function(){
                $.ajax({
                    url:'../PHP/consulta4.php',
                    type:'POST',
                    data: $('#form_registrar_producto').serialize(),
                    success: function(res){
                        $('#respuesta4').html(res);
                    },
                    error: function(res){
                        alert("Problemas al tratar de enviar el formulario");
                    }
                });
            });
        </script>
    <?PHP
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    function registrar_proveedor(){
        ?>
        <form id="form_registrar_proveedor" method="POST">
            <fieldset>
            <legend>Agregar nuevo proveedor</legend>
                <label>Nombre:</label><br>
                <input type="text" id="registrar_nombre" name="registrar_nombre"><br><br>
                <label>Dirección:</label><br>
                <textarea id="registrar_direccion" name="registrar_direccion" rows="4" cols="50"></textarea><br><br>
                <label>Teléfono:</label><br>
                <textarea id="registrar_telefono" name="registrar_telefono" rows="4" cols="50"></textarea><br><br>                  
                <button type="button" id="Enviar5">Registrar</button>
                <input type="reset" value="Limpiar">
            </fieldset>
        </form>
        <div id="respuesta5"></div>
        <script>
            $('#Enviar5').click(function(){
                $.ajax({
                    url:'../PHP/consulta5.php',
                    type:'POST',
                    data: $('#form_registrar_proveedor').serialize(),
                    success: function(res){
                        $('#respuesta5').html(res);
                    },
                    error: function(res){
                        alert("Problemas al tratar de enviar el formulario");
                    }
                });
            });
        </script>
    <?PHP
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    function modificar_producto(){
        ?>
        <form id="form_modificar_producto" method="POST">
            <fieldset>
                <legend>Consulta producto</legend>
                <input type="text" id="codigo_producto" name="codigo_producto"><br><br>
                                  
                <button type="button" id="Enviar6">Consultar</button>
                <input type="reset" value="Limpiar">
            </fieldset>
        </form>
        <div id="respuesta6"></div>
        <script>
            $('#Enviar6').click(function(){
                $.ajax({
                    url:'../PHP/consulta6.php',
                    type:'POST',
                    data: $('#form_modificar_producto').serialize(),
                    success: function(res){
                        $('#respuesta6').html(res);
                    },
                    error: function(res){
                        alert("Problemas al tratar de enviar el formulario");
                    }
                });
            });
        </script>
    <?PHP
    }
?>