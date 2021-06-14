<!DOCTYPE html>
<html lang="es">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>


<head>
    <title>Inicio</title>
    <script>$.ajaxPrefilter(function( options, originalOptions, jqXHR ) {options.async = true;});</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script> 
    <script type="text/javascript" src="../JavaScript/funciones.js"></script>
    <LINK REL=StyleSheet HREF="../CSS/estilos.css">

</head>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right">Logo</span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="../Imagenes/avatar2.png" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Bienvenido, <strong>
      
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
      
      
      
      
      </strong></span><br>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5></h5>
  </div>
  <div class="w3-bar-block">
    <a class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Cerrar Menú</a>
    
 
    <div>
        <button class="w3-button w3-block w3-left-align" onclick="AcordeonBar('contenedor1')">Empleados/admin
        <i class="fa fa-caret-down"></i>
        </button>
        <div class="w3-hide w3-white w3-card" id="contenedor1">
        <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont3')"><i class="fa fa-users fa-fw"></i>  Nuevo empleado</a>
        <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont4')"><i class="fa fa-bank fa-fw"></i>  Activar/Inactivar cuentas</a>
        <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont5')"><i class="fa fa-search fa-fw"></i>  Informacion completa de cuentas</a>
        </div>
    </div> 


    <div>
        <button class="w3-button w3-block w3-left-align" onclick="AcordeonBar('contenedor2')">Cliente
        <i class="fa fa-caret-down"></i>
        </button>
        <div class="w3-hide w3-white w3-card" id="contenedor2">
        <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont1')"><i class="fa fa-users fa-fw"></i>  Nuevo cliente</a>
        </div>
    </div> 


    <div>
        <button class="w3-button w3-block w3-left-align" onclick="AcordeonBar('contenedor3')">Producto
        <i class="fa fa-caret-down"></i>
        </button>
        <div class="w3-hide w3-white w3-card" id="contenedor3">
        <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont6')"><i class="fa fa-bank fa-fw"></i>  Nuevo producto</a>
        <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont8')"><i class="fa fa-cog fa-fw"></i>  Consultar producto</a>
        </div>
    </div> 


    <div>
        <button class="w3-button w3-block w3-left-align" onclick="AcordeonBar('contenedor4')">Proveedor
        <i class="fa fa-caret-down"></i>
        </button>
        <div class="w3-hide w3-white w3-card" id="contenedor4">
        <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont7')"><i class="fa fa-history fa-fw"></i>  Nuevo proveedor</a>
        </div>
    </div> 
   
    <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont2')"><i class="fa fa-users fa-fw"></i>  Ventas</a>
    
    


    
<br><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Funciones</b></h5>
  </header>

  <div class="w3-row-padding w3-margin-bottom">

    <div id="cont1" style="display:none;">
        <div class="w3-container">
            <?php
            registrar_cliente();
            ?>
        </div>
        <div class="w3-container w3-green">
            ...
        </div>
    </div>

    <div id="cont2" style="display:none;">
        <div class="w3-container">
            <?php
            menu_de_ventas();
            ?>
        </div>
        <div class="w3-container w3-green">
            ...
        </div>
    </div>

    <div id="cont3" style="display:none;">
        <div class="w3-container">
            <?php
            registrar_empleado();
            ?>
        </div>
        <div class="w3-container w3-green">
            ...
        </div>
    </div>
    <div id="cont4" style="display:none;">
        <div class="w3-container">
            <?php
                modificar_empleado();
            ?>
        </div>
        <div class="w3-container w3-green">
            ...
        </div>
    </div>
    <div id="cont5" style="display:none;">
        <div class="w3-container">
            <?php
                ver_cuentas_empleado();
            ?>
        </div>
        <div class="w3-container w3-green">
            ...
        </div>
    </div>
    <div id="cont6" style="display:none;">
        <div class="w3-container">
            <?php
                registrar_producto();
            ?>
        </div>
        <div class="w3-container w3-green">
            ...
        </div>
    </div>
    <div id="cont7" style="display:none;">
        <div class="w3-container">
            <?php
                registrar_proveedor();
            ?>
        </div>
        <div class="w3-container w3-green">
            ...
        </div>
    </div>
    <div id="cont8" style="display:none;">
        <div class="w3-container">
            <?php
                modificar_producto();
            ?>
        </div>
        <div class="w3-container w3-green">
            ...
        </div>
    </div>

</div>

  

  
  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>FOOTER</h4>
    <p>Powered by Jupazago</p>
  </footer>

  <!-- End page content -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

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

function ocultarDivs(no_ocultar){
    document.getElementById('cont1').style.display='none'
    document.getElementById('cont2').style.display='none'
    document.getElementById('cont3').style.display='none'
    document.getElementById('cont4').style.display='none'
    document.getElementById('cont5').style.display='none'
    document.getElementById('cont6').style.display='none'
    document.getElementById('cont7').style.display='none'
    document.getElementById('cont8').style.display='none'

    switch(no_ocultar) {
        case "cont1":
            document.getElementById('cont1').style.display='block'
            break;
        case "cont2":
            document.getElementById('cont2').style.display='block'
            break;
        case "cont3":
            document.getElementById('cont3').style.display='block'
            break;
        case "cont4":
            document.getElementById('cont4').style.display='block'
            break;
        case "cont5":
            document.getElementById('cont5').style.display='block'
            break;
        case "cont6":
            document.getElementById('cont6').style.display='block'
            break;
        case "cont7":
            document.getElementById('cont7').style.display='block'
            break;
        case "cont8":
            document.getElementById('cont8').style.display='block'
            break;
        default:
          // code block
      }
}

function AcordeonBar(opcion) {
    var x = document.getElementById(opcion);  
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-gray";
    } else { 
        x.className = x.className.replace(" w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-gray", "");
    }
}
</script>