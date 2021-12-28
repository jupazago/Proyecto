<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>$.ajaxPrefilter(function( options, originalOptions, jqXHR ) {    options.async = true; });</script>
<script type="text/javascript" src="../JavaScript/funciones.js"></script>

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
                echo $fila['user'];
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
                <legend>Registrar empleado/administrador:</legend>
                <label>Nombre:</label><br>
                <input type="text" id="registrar_nombre" name="registrar_nombre" class="w3-inputs"><br>
                <label>Identificación:</label><br>
                <input type="number" id="registrar_identificacion" name="registrar_identificacion" class="w3-inputs"><br>
                <label>Dirección:</label><br>
                <input type="text" id="registrar_direccion" name="registrar_direccion" class="w3-inputs"><br>
                <label>Teléfono:</label><br>
                <input type="text" id="registrar_telefono" name="registrar_telefono" class="w3-inputs"><br>
                <label>Usuario:</label><br>
                <input type="text" id="registrar_usuario" name="registrar_usuario" class="w3-inputs"><br>
                <label>Clave:</label><br>
                <input type="text" id="registrar_clave" name="registrar_clave" class="w3-inputs"><br>
                <label>Tipo de Cuenta:</label><br>
                <input list="tipo_cuenta" name="tipo_cuenta" class="w3-inputs">
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
                    
                <button type="button" id="Enviar" class="w3-btn w3-teal" onclick="document.getElementById('respuesta15').style.display='block'">Registrar</button><br><br>
                <input type="reset" value="Limpiar" class="w3-btn w3-teal" onclick="document.getElementById('respuesta15').style.display='none'">
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
                <input type="text" id="consultar_identificacion" name="consultar_identificacion"  class="w3-inputs"><br><br>
                <button type="button" id="Enviar2" class="w3-btn w3-teal" onclick="document.getElementById('respuesta15').style.display='block'">Continuar</button><br><br>
                <input type="reset" value="Limpiar" class="w3-btn w3-teal" onclick="document.getElementById('respuesta15').style.display='none'">
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
                <button type="button" id="Enviar3" class="w3-btn w3-teal">Ver Información</button>
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
                <input type="text" id="registrar_codigo" name="registrar_codigo" class="w3-inputs"><br><br>
                <label>Nombre:</label><br>
                <input type="text" id="registrar_nombre" name="registrar_nombre" class="w3-inputs"><br><br>
                <label>Precio:</label><br>
                <input type="number" id="registrar_precio" name="registrar_precio" class="w3-inputs"><br><br>
                <label>Descripción:</label><br>
                <textarea id="registrar_descripcion" name="registrar_descripcion" rows="4" cols="50" class="w3-inputs"></textarea><br><br>
                <label>Proveedor:</label><br>
                <input list="nom_proveedor" name="nom_proveedor"  class="w3-inputs">
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
                    
                <button type="button" id="Enviar4" class="w3-btn w3-teal" onclick="document.getElementById('respuesta15').style.display='block'">Registrar</button><br><br>
                <input type="reset" value="Limpiar" class="w3-btn w3-teal" onclick="document.getElementById('respuesta15').style.display='none'">
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
                <input type="text" id="registrar_nombre" name="registrar_nombre" class="w3-inputs"><br><br>
                <label>Dirección:</label><br>
                <textarea id="registrar_direccion" name="registrar_direccion" rows="4" cols="50" class="w3-inputs"></textarea><br><br>
                <label>Teléfono:</label><br>
                <textarea id="registrar_telefono" name="registrar_telefono" rows="4" cols="50" class="w3-inputs"></textarea><br><br>                  
                <button type="button" id="Enviar5" class="w3-btn w3-teal" onclick="document.getElementById('respuesta15').style.display='block'">Registrar</button><br><br>
                <input type="reset" value="Limpiar" class="w3-btn w3-teal" onclick="document.getElementById('respuesta15').style.display='none'">
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
                <legend>Producto a modificar</legend>
                <label>Código:</label><br>
                <input type="text" id="codigo_producto" name="codigo_producto" class="w3-inputs"><br><br>
                                  
                <button type="button" id="Enviar6" class="w3-btn w3-teal" onclick="document.getElementById('respuesta15').style.display='block'">Consultar</button><br><br>
                <input type="reset" value="Limpiar" class="w3-btn w3-teal" onclick="document.getElementById('respuesta15').style.display='none'">
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
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    function menu_de_ventas(){
        ?>
        </script>
        <form id="form_ventas" method="POST">
            <fieldset>
                <legend>Ventas</legend>
                <input type="text" id="codigo_producto" name="codigo_producto" required class="w3-inputs"><br><br>         
                <button type="button" id="Enviar7" class="w3-btn w3-teal">Consultar</button>
            </fieldset>
        </form>

        <form id="form_ventas_2" method="POST">
            <table border="1" id="tablaprueba" width="100%"> 
                <thead width="100%">
                    <tr>
                        <th>Tabla</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td>Total</td>
                        <td class="final"></td>
                    </tr>
                </tfoot>
                <tbody id="tbodyform">
                <tr id="respuesta7" name="total">
                    
                </tr>
                </tbody>
            </table>


        <div id="precios_totales"></div>
        <br><br>
            <label>Cliente:</label><br>
            <input type="text" class="nom_clientee w3-inputs" id="nom_cliente" name="nom_cliente">
            <br><br>
        </form>
        <button class="w3-btn w3-green" id="facturacion">Generar factura</button>
        <script>
            $('#Enviar7').click(function(){
                $.ajax({
                    url:'../PHP/consulta7.php',
                    type:'POST',
                    data: $('#form_ventas').serialize(),
                    success: function(res){
                        $('#respuesta7').append(res);   //Append para agregar nuevo
                    },
                    error: function(res){
                        alert("Problemas al tratar de enviar el formulario productos en facturación");
                    }
                });
            });

            foco_input();
        </script>
        <script>
            /*
            $('#facturacion').click(function(){
                $.ajax({
                    url:'../PHP/facturacion.php',
                    type:'POST',
                    data: $('#form_ventas_2').serialize(),
                    success: function(res){
                        $('#respuesta7').append(res);   //Append para agregar nuevo
                    },
                    error: function(res){
                        alert("Problemas al tratar de enviar el formulario de facturación");
                    }
                });
            });

            foco_input();
            */
        </script>
<?PHP
    }
////////////////////////////////////////////////////////////////////////////////////////////////////
function registrar_cliente(){
    ?>
    </script>
    <form id="form_registrar_cliente" method="POST">
            <fieldset>
            <legend>Agregar nuevo Cliente</legend>
                <label>Nombre:</label><br>
                <input type="text" id="registrar_nombre" name="registrar_nombre" class="w3-inputs"><br><br>
                <label>Identificación:</label><br>
                <input type="text" id="registrar_identificacion" name="registrar_identificacion" class="w3-inputs"><br><br>
                <label>Dirección:</label><br>
                <textarea id="registrar_direccion" name="registrar_direccion" rows="4" cols="50" class="w3-inputs"></textarea><br><br>                  
                <label>Teléfono:</label><br>
                <textarea id="registrar_telefono" name="registrar_telefono" rows="4" cols="50" class="w3-inputs"></textarea><br><br>                  
                <button type="button" id="Enviar8" class="w3-btn w3-teal" onclick="document.getElementById('respuesta15').style.display='block'">Registrar</button><br><br>
                <input type="reset" value="Limpiar" class="w3-btn w3-teal" onclick="document.getElementById('respuesta15').style.display='none'">
            </fieldset>
        </form>

    <div id="respuesta8"></div>
    <script>
        $('#Enviar8').click(function(){
            $.ajax({
                url:'../PHP/consulta8.php',
                type:'POST',
                data: $('#form_registrar_cliente').serialize(),
                success: function(res){
                    $('#respuesta8').html(res); 
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
function modificar_datos_empleado(){
    ?>
        <form id="form_modificar_empleado" method="POST">
            <fieldset>
                <legend>Consulta datos</legend>
                <label>Identificación:</label><br>
                <input type="text" id="identi_empleado" name="identi_empleado" class="w3-inputs"><br><br>
                                  
                <button type="button" id="Enviar9" class="w3-btn w3-teal" onclick="document.getElementById('respuesta15').style.display='block'">Consultar</button><br><br>
                <input type="reset" value="Limpiar" class="w3-btn w3-teal" onclick="document.getElementById('respuesta15').style.display='none'">
            </fieldset>
        </form>
        <div id="respuesta9"></div>
        <script>
            $('#Enviar9').click(function(){
                $.ajax({
                    url:'../PHP/consulta9.php',
                    type:'POST',
                    data: $('#form_modificar_empleado').serialize(),
                    success: function(res){
                        $('#respuesta9').html(res);
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
function modificar_pass_empleado(){
    ?>
        <form id="form_modificarpass_empleado" method="POST">
            <fieldset>
                <legend>Cambio de Contraseña</legend>
                <label>Identificación:</label><br>
                <input type="text" id="identi_empleado" name="identi_empleado" class="w3-inputs"><br><br>
                                  
                <button type="button" id="Enviar10" class="w3-btn w3-teal" onclick="document.getElementById('respuesta15').style.display='block'">Consultar</button><br><br>
                <input type="reset" value="Limpiar" class="w3-btn w3-teal" onclick="document.getElementById('respuesta15').style.display='none'">
            </fieldset>
        </form>
        <div id="respuesta10"></div>
        <script>
            $('#Enviar10').click(function(){
                $.ajax({
                    url:'../PHP/consulta10.php',
                    type:'POST',
                    data: $('#form_modificarpass_empleado').serialize(),
                    success: function(res){
                        $('#respuesta10').html(res);
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
function consultar_producto(){
    ?>
        <form id="form_consultar_producto" method="POST">
            <fieldset>
                <legend>Consulta producto</legend>
                <label>Código:</label><br>
                <input type="text" id="codigo_producto" name="codigo_producto" class="w3-inputs"><br><br>
                                  
                <button type="button" id="Enviar11" class="w3-btn w3-teal" onclick="document.getElementById('respuesta15').style.display='block'">Consultar</button><br><br>
                <input type="reset" value="Limpiar" class="w3-btn w3-teal" onclick="document.getElementById('respuesta15').style.display='none'">
            </fieldset>
        </form>
        <div id="respuesta11"></div>
        <script>
            $('#Enviar11').click(function(){
                $.ajax({
                    url:'../PHP/consulta11.php',
                    type:'POST',
                    data: $('#form_consultar_producto').serialize(),
                    success: function(res){
                        $('#respuesta11').html(res);
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
function consultar_proveedor(){
    ?>
        <form id="form_consultar_proveedor" method="POST">
            <fieldset>
                <legend>Consulta Proveedor</legend>
                <label>Nombre:</label><br>
                <input list="nombre_proveedor1" name="nombre_proveedor1" class="w3-inputs">
                <datalist id="nombre_proveedor1">
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
                                  
                <button type="button" id="Enviar12" class="w3-btn w3-teal" onclick="document.getElementById('respuesta12').style.display='block'">Consultar</button><br><br>
                <input type="reset" value="Limpiar" class="w3-btn w3-teal" onclick="document.getElementById('respuesta12').style.display='none'">
            </fieldset>
        </form>
        <div id="respuesta12"></div>
        <script>
            $('#Enviar12').click(function(){
                $.ajax({
                    url:'../PHP/consulta12.php',
                    type:'POST',
                    data: $('#form_consultar_proveedor').serialize(),
                    success: function(res){
                        $('#respuesta12').html(res);
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


<?PHP
//////////////////////////////////////////////////////////////////////////////////////////////////////////
function modificar_proveedor(){
    ?>
        <form id="form_modificar_proveedor" method="POST">
            <fieldset>
                <legend>Proveedor a modificar</legend>
                <label>Nombre:</label><br>
                <input list="nombre_proveedor1" name="nombre_proveedor1" class="w3-inputs">
                <datalist id="nombre_proveedor1">
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
                                  
                <button type="button" id="Enviar13" class="w3-btn w3-teal" onclick="document.getElementById('respuesta13').style.display='block'">Consultar</button><br><br>
                <input type="reset" value="Limpiar" class="w3-btn w3-teal" onclick="document.getElementById('respuesta13').style.display='none'">
            </fieldset>
        </form>
        <div id="respuesta13"></div>
        <script>
            $('#Enviar13').click(function(){
                $.ajax({
                    url:'../PHP/consulta13.php',
                    type:'POST',
                    data: $('#form_modificar_proveedor').serialize(),
                    success: function(res){
                        $('#respuesta13').html(res);
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

<?PHP
//////////////////////////////////////////////////////////////////////////////////////////////////////////
function consultar_cliente(){
    ?>
        <form id="form_consultar_cliente" method="POST">
            <fieldset>
                <legend>Consulta Proveedor</legend>
                <label>Nombre:</label><br>
                <input list="nombre_cliente1" name="nombre_cliente1" class="w3-inputs">
                <datalist id="nombre_cliente1">
                    <?php
                        if(existencia_de_la_conexion()){
                            require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
                        }
                        $conexion = conectar();                     //Obtenemos la conexion
                        
                        //Consulta a la base de datos en la tabla provvedor
                        $consulta = mysqli_query($conexion, "SELECT `nombre_cliente` FROM `cliente` ORDER BY `nombre_cliente` ASC") or die ("Error al consultar: proveedores");

                        while (($fila = mysqli_fetch_array($consulta))!=NULL){
                            // traemos los proveedores existentes en la base de datos
                            $BD_nombre_cliente = $fila['nombre_cliente'];
                            echo "<option value=".$BD_nombre_cliente."></option>";
                        }
                        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
                    ?>
                    </datalist><br><br>
                                  
                <button type="button" id="Enviar14" class="w3-btn w3-teal" onclick="document.getElementById('respuesta14').style.display='block'">Consultar</button><br><br>
                <input type="reset" value="Limpiar" class="w3-btn w3-teal" onclick="document.getElementById('respuesta14').style.display='none'">
            </fieldset>
        </form>
        <div id="respuesta14"></div>
        <script>
            $('#Enviar14').click(function(){
                $.ajax({
                    url:'../PHP/consulta14.php',
                    type:'POST',
                    data: $('#form_consultar_cliente').serialize(),
                    success: function(res){
                        $('#respuesta14').html(res);
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

<?PHP
//////////////////////////////////////////////////////////////////////////////////////////////////////////
function modificar_cliente(){
    ?>
        <form id="form_modificar_cliente" method="POST">
            <fieldset>
                <legend>Proveedor a modificar</legend>
                <label>Nombre:</label><br>
                <input list="nombre_cliente1" name="nombre_cliente1" class="w3-inputs">
                <datalist id="nombre_cliente1">
                    <?php
                        if(existencia_de_la_conexion()){
                            require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
                        }
                        $conexion = conectar();                     //Obtenemos la conexion
                        
                        //Consulta a la base de datos en la tabla provvedor
                        $consulta = mysqli_query($conexion, "SELECT `nombre_cliente` FROM `cliente` ORDER BY `nombre_cliente` ASC") or die ("Error al consultar: proveedores");

                        while (($fila = mysqli_fetch_array($consulta))!=NULL){
                            // traemos los proveedores existentes en la base de datos
                            $BD_nombre_cliente = $fila['nombre_cliente'];
                            echo "<option value=".$BD_nombre_cliente."></option>";
                        }
                        mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
                    ?>
                    </datalist><br><br>
                                  
                <button type="button" id="Enviar15" class="w3-btn w3-teal" onclick="document.getElementById('respuesta15').style.display='block'">Consultar</button><br><br>
                <input type="reset" value="Limpiar" class="w3-btn w3-teal" onclick="document.getElementById('respuesta15').style.display='none'">
            </fieldset>
        </form>
        <div id="respuesta15"></div>
        <script>
            $('#Enviar15').click(function(){
                $.ajax({
                    url:'../PHP/consulta15.php',
                    type:'POST',
                    data: $('#form_modificar_cliente').serialize(),
                    success: function(res){
                        $('#respuesta15').html(res);
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
