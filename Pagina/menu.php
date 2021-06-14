<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <script>$.ajaxPrefilter(function( options, originalOptions, jqXHR ) {    options.async = true; });</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
    <script type="text/javascript" src="../JavaScript/funciones.js"></script>
    <LINK REL=StyleSheet HREF="../CSS/estilos.css">

</head>
<body>
<div class="w3-container w3-green">

  <h4>Bienvenido 
    <?php
        //Incluir el archivo que contiene las funciones del lenguaje PHP
        require_once("../PHP/funciones.php");
        //Desactivar Desactivar toda notificación de error
        error_reporting(0);
        $usuario     =      $_POST['u'];
        $clave       =      $_POST['p'];

        $tipo_de_cuenta = iniciar_sesion($usuario, $clave);

        echo " - ".$tipo_de_cuenta;
        // Notificar todos los errores de PHP
        error_reporting(-1);
    ?>

</div>

<div class="w3-container">
  <table class="w3-table">
    <tr>
      <td>
        <div class="w3-container">
          <div class="w3-card">
            <div class="w3-container">
              <button onclick="document.getElementById('cont1').style.display='block'" class="w3-button w3-black">
              Contenedor #1</button>
              <br>
              <br>
            </div>
          </div>
          <br>
        </div>
      </td>
      <td>
        <div class="w3-container">
          <div class="w3-card">
            <div class="w3-container">
              <button onclick="document.getElementById('cont2').style.display='block'" class="w3-button w3-black">
              edward haragan</button>
              <br>
              <br>
            </div>
          </div>
          <br>
        </div>
      </td>
      <td>
        <div class="w3-container">
          <div class="w3-card">
            <div class="w3-container">
              <button onclick="document.getElementById('cont3').style.display='block'" class="w3-button w3-black">
              Abrir</button>
              <br>
              <br>
            </div>
          </div>
          <br>
        </div>
      </td>
    </tr>
    <tr>
    <td>
        <div class="w3-container">
          <div class="w3-card">
            <div class="w3-container">
              <button onclick="document.getElementById('cont4').style.display='block'" class="w3-button w3-black">
              Abrir</button>
              <br>
              <br>
            </div>
          </div>
          <br>
        </div>
      </td>
      <td>
        <div class="w3-container">
          <div class="w3-card">
            <div class="w3-container">
              <button onclick="document.getElementById('cont5').style.display='block'" class="w3-button w3-black">
              Abrir</button>
              <br>
              <br>
            </div>
          </div>
          <br>
        </div>
      </td>
      <td>
        <div class="w3-container">
          <div class="w3-card">
            <div class="w3-container">
              <button onclick="document.getElementById('cont6').style.display='block'" class="w3-button w3-black">
              Abrir</button>
              <br>
              <br>
            </div>
          </div>
          <br>
        </div>
      </td>
    </tr>
    <tr>
    <td>
        <div class="w3-container">
          <div class="w3-card">
            <div class="w3-container">
              <button onclick="document.getElementById('cont7').style.display='block'" class="w3-button w3-black">
              Abrir</button>
              <br>
              <br>
            </div>
          </div>
          <br>
        </div>
      </td>
      <td>
        <div class="w3-container">
          <div class="w3-card">
            <div class="w3-container">
              <button onclick="document.getElementById('cont8').style.display='block'" class="w3-button w3-black">
              Abrir</button>
              <br>
              <br>
            </div>
          </div>
          <br>
        </div>
      </td>
      <td>
        <div class="w3-container">
          <div class="w3-card">
            <div class="w3-container">
              <button onclick="document.getElementById('cont9').style.display='block'" class="w3-button w3-black">
              Abrir</button>
              <br>
              <br>
            </div>
          </div>
          <br>
        </div>
      </td>
    </tr>
  </table>
</div>

















<div id="cont1" class="w3-modal">
    <div class="w3-modal-content">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('cont1').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <h3>Registrar Empleado</h3>
      </header>
      <div class="w3-container">
        <?php
          registrar_cliente();
        ?>
      </div>
      <div class="w3-container w3-green">
        ...
      </div>
    </div>
</div>

<div id="cont2" class="w3-modal">
    <div class="w3-modal-content">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('cont2').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <h2>Mensaje 2</h2>
      </header>
        <?php
          menu_de_ventas();
        ?>
      <div class="w3-container w3-teal">
        <p>...</p>
      </div>
    </div>
</div>







    <?php
        //registrar_empleado();
        //modificar_empleado();
        //ver_cuentas_empleado();
        //registrar_producto();
        //registrar_proveedor();
        //modificar_producto();
        //menu_de_ventas();
        //registrar_cliente();
    ?>
</body>
</html>

<script>
$('#tbodyform')
.on('input', '.cantidad', function() {
    
    var $input = $(this), // input.cantidad
        cantidad = parseInt($input.val(), 10), // valor de input.cantidad
        $tr = $input.closest('tr'), // fila del input.canitdad
        precio = parseInt($tr.find('.precio').text(), 10), // valor del span.precio
        $total = $tr.find('.total'); // elemento span.total
    
    $total.text(precio * cantidad); // reseteamos el valor del span.total
});

setInterval('multi()',500);

function multi() {
    var data = [];

    $("td.total").each(function(){
    data.push(parseFloat($(this).text()));
    });


    var suma = data.reduce(function(a,b){ return a+b; },0);

    console.log(suma);
    $('.final').html(suma);
}
</script>