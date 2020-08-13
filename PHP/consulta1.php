<?php

    $insert_name        = strtoupper($_POST['registrar_nombre']);   //Convertir todo a mayusculas
    $insert_identi      = $_POST['registrar_identificacion'];
    $insert_direccion   = $_POST['registrar_direccion'];
    $insert_telefono    = $_POST['registrar_telefono'];
    $insert_user        = str_replace(' ', '', $_POST['registrar_usuario']);    //Eliminar todos los espacios en blanco
    $insert_pass        = $_POST['registrar_clave'];
    $insert_tipo_cuenta = $_POST['tipo_cuenta'];
    

    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();
    mysqli_set_charset($conexion,"uft8");
    
    //Desactivar Desactivar toda notificación de error
    error_reporting(0);

    //Verificacion de datos correctos
    //------identificación
    //------usuario
    $verificacion=array(true, true);

    $consulta = mysqli_query($conexion, "SELECT `identificacion_empleado` FROM `empleado` WHERE `estado`='ACTIVO'") or die ("Error al consultar: comprobación de documento");
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        // verificamos la existencia del documento de identidad
        if($fila['identificacion_empleado']==$insert_identi){
            echo "Ya existe una persona registrada con ese documento";
            $verificacion[0]=false;
            break;
        }
    }
    mysqli_free_result($consulta); //Liberar espacio de consulta cuando ya no es necesario
    $consulta = mysqli_query($conexion, "SELECT `user` FROM `login` WHERE `estado`='ACTIVO'") or die ("Error al consultar: comprobación de usuarios");
    while (($fila = mysqli_fetch_array($consulta))!=NULL){
        // verificamos la existencia del usuario
        if($fila['user']==$insert_user){
            echo "Ya existe una persona registrada con ese Usuario";
            $verificacion[1]=false;
            break;
        }
    }
    mysqli_free_result($consulta);

    if($verificacion[0]==true && $verificacion[1]==true){
        //Proceso INSERT nuevo empleado y su respectivo usuario
        
        $insertar = mysqli_query($conexion, "INSERT INTO `login`(`user`, `pass`, `id_tipo_usuario1`, `estado`) VALUES ('$insert_user', '$insert_pass', '$insert_tipo_cuenta', 'ACTIVO')") or die ("Error al consultar: agregar nuevo usuario");
        mysqli_free_result($insertar);
        
        $consulta = mysqli_query($conexion, "SELECT `id_login` FROM `login` WHERE `user` = '$insert_user'") or die ("Error al consultar: comprobación del usuario");
        while ( $fila = mysqli_fetch_array($consulta)) {
            $BD_id_login = $fila['id_login'];
            break;
        }
        mysqli_free_result($consulta);

        $insertar = mysqli_query($conexion, "INSERT INTO `empleado`(`nombre_empleado`, `identificacion_empleado`, `id_login1`, `direccion_empleado`, `telefono_empleado`, `estado`) VALUES ('$insert_name', '$insert_identi', '$BD_id_login', '$insert_direccion', '$insert_telefono', 'ACTIVO')") or die ("Error al consultar: agregar nuevo empleado");
        mysqli_free_result($insertar);
        
        echo "<br>Inscripción exitosa <br>";
        echo "Usuario: ". $insert_user."<br>";
        echo "Clave:   ". $insert_pass."<br>";
        
    }else{
        echo "<br>Falla al Registrar<br>";
    }

    mysqli_close($conexion);     //---------------------- Cerrar conexion ------------------
    // Notificar todos los errores de PHP
    error_reporting(-1);

?>