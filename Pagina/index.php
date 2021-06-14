<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <script type="text/javascript" src="../JavaScript/funciones.js"></script>
    <LINK REL=StyleSheet HREF="../CSS/estilo_login.css">
</head>
<body>
<div class="login">
    <form name="formulario_iniciar_sesion" action="menu2.php" method='post'>
        <h1>Iniciar Sesión</h1>
        <input type="text" name="u" required placeholder="Usuario"/>
        <input type="password" name="p" required placeholder="Contraseña"/>
        <br><br>
        <input type="submit" class="btn btn-primary btn-block btn-large" value="Iniciar Sesión" id="enviar">
    </form>
</div>
</body>
</html>