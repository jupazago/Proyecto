<?php

    $consultar_identi      = $_POST['consultar_identificacion'];

    

    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();
    mysqli_set_charset($conexion,"uft8");
    
    $encontrado = false;

    $consulta = mysqli_query($conexion, "SELECT `identificacion_empleado`,`id_login1`,`estado` FROM `empleado`") or die ("Error al consultar: verificación de documento");
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        // verificamos la existencia del usuario
        if($fila['identificacion_empleado']==$consultar_identi){
            //como existe, pasamos a hacer su Update respectivo
            mysqli_free_result($consulta);
            $id_login_para_actualizar = $fila['id_login1'];  //Capturamos su id_login

            //Desactivar Desactivar toda notificación de error
            error_reporting(0);
            
            if($fila['estado']=='ACTIVO'){
                
                //como el documento existe, pasará a inactivarse
                //INACTIVAR EMPLEADO
                $consulta = mysqli_query($conexion, "UPDATE `empleado` SET `estado`='INACTIVO' WHERE `identificacion_empleado`='$consultar_identi'") or die ("Error al consultar: comprobación de documento");
                mysqli_free_result($consulta);

                //INACTIVAR SU CUENTA
                $consulta = mysqli_query($conexion, "UPDATE `login` SET `estado`='INACTIVO' WHERE `id_login`='$id_login_para_actualizar'") or die ("Error al consultar: comprobación de cuenta");
                mysqli_free_result($consulta);
                echo "<br>Inactivado con éxito <br>";
                break;

            }elseif ($fila['estado']=='INACTIVO') {
                //como el documento existe, pasará a inactivarse
                //ACTIVAR EMPLEADO
                $consulta = mysqli_query($conexion, "UPDATE `empleado` SET `estado`='ACTIVO' WHERE `identificacion_empleado`='$consultar_identi'") or die ("Error al consultar: comprobación de documento");
                mysqli_free_result($consulta);

                //ACTIVAR SU CUENTA
                $consulta = mysqli_query($conexion, "UPDATE `login` SET `estado`='ACTIVO' WHERE `id_login`='$id_login_para_actualizar'") or die ("Error al consultar: comprobación de cuenta");
                mysqli_free_result($consulta);
                echo "<br>Activado con éxito <br>";
                break;
            }
            // Notificar todos los errores de PHP
            error_reporting(-1);
        }
    }
    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------ 
    
?>