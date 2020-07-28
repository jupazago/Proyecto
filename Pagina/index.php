<?php
try {
    //Verificar si existe el archivo de conexion
    if(!file_exists('../PHP/conexion.php')){
        throw new Exception ('File conexion no existe',1);  //NO existe, captura excepcion
    }else{

        require_once("../PHP/conexion.php");                //SI Existe, continuar
    }

} catch (Exception $excepcion) {
    //Captura de excepcion y su respectivo codigo
    echo 'Excepción capturada: ' .  $excepcion->getMessage(), "<br>";
	echo 'Código: ' . $excepcion->getCode(), "<br>";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>
    ¡Go Perroculos!
</body>
</html>