<?php
    //Incluir el archivo que contiene las funciones del lenguaje PHP
    require_once("../PHP/funciones.php");

    if(existencia_de_la_conexion()){
        require_once("../PHP/conexion.php");    //Hacer conexion con la base de datos
    }
    $conexion = conectar();
    mysqli_set_charset($conexion,"uft8");



    $ides			= array();
    $ides			= $_POST["ides"];			#Oportunidades (array)
    
    $precio			= array();
    $precio 		= $_POST["precios"];
    
    $canti 			= array();
    $canti			= $_POST["cantidades"];

    $precio_final 			= $_POST["total"];
    $cliente 			    = $_POST["nom_cliente"];
    

    //Creamos la factura
    $insertar = mysqli_query($conexion, "INSERT INTO `facturacion`(`name_cliente`, `fecha`, `id_modo_pago1`, `id_empleado1`, `precio_total`, `estado`) 
    VALUES ($cliente,date('Y-m-d H:i:s'),1,1,$precio_final,'ACTIVO')") or die ("Error al consultar: agregar nueva factura");
    
    mysqli_free_result($insertar); //Libero consulta

    //Registramos cada uno de los prodcutos en esa factura
?>