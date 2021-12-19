<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();
    mysqli_set_charset($conexion,"uft8");

    $cliente = $_POST['cliente'];
    $fecha = $_GET['cliente'];
    $id_pago = $_GET['cliente'];
    $id_empleado = $_GET['cliente'];
    $precio_total = $_GET['cliente'];

    //Creamos la factura
    $insertar = mysqli_query($conexion, "INSERT INTO `facturacion`(`name_cliente`, `fecha`, `id_modo_pago1`, `id_empleado1`, `precio_total`, `estado`) 
    VALUES ($cliente,[value-3],[value-4],[value-5],[value-6],'ACTIVO')") or die ("Error al consultar: agregar nuevo usuario");
    
    mysqli_free_result($insertar); //Libero consulta

    //Registramos cada uno de los prodcutos en esa factura
?>