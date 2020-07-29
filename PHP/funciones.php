<?php

    //Funcion que verifica si existeel archivo de conexion de la base de datos
    function existencia_de_la_conexion(){
        try {
            //Verificar si existe el archivo de conexion
            if(!file_exists('../PHP/conexion.php')){
                throw new Exception ('PHP: File  -conexion-  no existe',1);  //NO existe, captura excepcion
            }else{
        
                require_once("../PHP/conexion.php");                //SI Existe, continuar y realizar la conexion
            }
        
        } catch (Exception $excepcion) {
            //Captura de excepcion y su respectivo codigo
            echo 'Capture: ' .  $excepcion->getMessage(), "<br>";
            echo 'Código: ' . $excepcion->getCode(), "<br>";
        }
    }

?>