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
  <span class="w3-bar-item w3-right">Assistance</span>
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
        <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont11')"><i class="fa fas fa-user-plus fa-fw"></i>  Nuevo empleado</a>
        <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont12')"><i class="fa fa-cogs fa-fw"></i>  Activar/Inactivar cuentas</a>
        <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont13')"><i class="fa fa-vcard fa-fw"></i>  Informacion completa de cuentas</a>
        <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont14')"><i class="fa fa-cog fa-fw"></i>  Modificar datos</a>
        <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont15')"><i class="fa fa-cogs fa-fw"></i>  Cambiar contraseña</a>
        </div>
    </div> 


    <div>
        <button class="w3-button w3-block w3-left-align" onclick="AcordeonBar('contenedor2')">Cliente
        <i class="fa fa-caret-down"></i>
        </button>
        <div class="w3-hide w3-white w3-card" id="contenedor2">
        <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont21')"><i class="fa fas fa-user-plus fa-fw"></i>  Nuevo cliente</a>
        <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont22')"><i class="fa fas fa-cogs fa-fw"></i>  Modificar datos</a>
        <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont23')"><i class="fa fas fa-search fa-fw"></i>  Consultar información</a>
        </div>
    </div> 


    <div>
        <button class="w3-button w3-block w3-left-align" onclick="AcordeonBar('contenedor3')">Producto
        <i class="fa fa-caret-down"></i>
        </button>
        <div class="w3-hide w3-white w3-card" id="contenedor3">
        <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont31')"><i class="fa fa-plus-square fa-fw"></i>  Nuevo producto</a>
        <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont32')"><i class="fa fa-search fa-fw"></i>  Consultar producto</a>
        <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont33')"><i class="fa fa-cog fa-fw"></i>  Actualizar producto</a>
        </div>
    </div> 


    <div>
        <button class="w3-button w3-block w3-left-align" onclick="AcordeonBar('contenedor4')">Proveedor
        <i class="fa fa-caret-down"></i>
        </button>
        <div class="w3-hide w3-white w3-card" id="contenedor4">
        <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont41')"><i class="fa fa-plus-square fa-fw"></i>  Nuevo proveedor</a>
        <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont42')"><i class="fa fa-search fa-fw"></i>  Consultar proveedor</a>
        <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont43')"><i class="fa fa-cogs fa-fw"></i>  Actualizar proveedor</a>
        </div>
    </div> 
   
    <a class="w3-bar-item w3-button w3-hover-teal" onclick="ocultarDivs('cont1')"><i class="fa fa-shopping-cart fa-fw"></i>  Ventas</a>
    
    


    
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

  <div id="cont11" style="display:none;">
        <div class="w3-container">
            <?php
            registrar_empleado();
            ?>
        </div>
    </div>

    <div id="cont12" style="display:none;">
        <div class="w3-container">
            <?php
                modificar_empleado();
            ?>
        </div>
    </div>

    <div id="cont13" style="display:none;">
        <div class="w3-container">
            <?php
                ver_cuentas_empleado();
            ?>
        </div>
    </div>

    <div id="cont14" style="display:none;">
        <div class="w3-container">
            <?php
                //modificar datos
            ?>
        </div>
    </div>

    <div id="cont15" style="display:none;">
        <div class="w3-container">
            <?php
                //Cambiar contraseña
            ?>
        </div>
    </div>

    <?php //------------------------------------------------------- ?>

    <div id="cont21" style="display:none;">
        <div class="w3-container">
            <?php
            registrar_cliente();
            ?>
        </div>
    </div>
    <div id="cont22" style="display:none;">
        <div class="w3-container">
            <?php
                //modificar
            ?>
        </div>
    </div>
    <div id="cont23" style="display:none;">
        <div class="w3-container">
            <?php
                //consultar
            ?>
        </div>
    </div>









    <?php //------------------------------------------------------- ?>

    <div id="cont31" style="display:none;">
        <div class="w3-container">
            <?php
                registrar_producto();
            ?>
        </div>
    </div>

    <div id="cont32" style="display:none;">
        <div class="w3-container">
            <?php
                //consultar
            ?>
        </div>
    </div>



    <div id="cont33" style="display:none;">
        <div class="w3-container">
            <?php
                modificar_producto();
            ?>
        </div>
    </div>


    <?php //------------------------------------------------------- ?>


    <div id="cont41" style="display:none;">
        <div class="w3-container">
            <?php
                registrar_proveedor();
            ?>
        </div>
    </div>
    <div id="cont42" style="display:none;">
        <div class="w3-container">
            <?php
                //consultar
            ?>
        </div>
    </div>
    <div id="cont43" style="display:none;">
        <div class="w3-container">
            <?php
                //actualizar
            ?>
        </div>
    </div>














    <?php //------------------------------------------------------- ?>

    <div id="cont1" style="display:none;">
        <div class="w3-container">
            <?php
            menu_de_ventas();
            ?>
        </div>
    </div>

    

    

    

    

    

    
</div>

  

  
  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <p>Powered by <u>Jupazago</u></p>
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
    document.getElementById('cont11').style.display='none'
    document.getElementById('cont12').style.display='none'
    document.getElementById('cont13').style.display='none'
    document.getElementById('cont14').style.display='none'
    document.getElementById('cont15').style.display='none'

    document.getElementById('cont21').style.display='none'
    document.getElementById('cont22').style.display='none'
    document.getElementById('cont23').style.display='none'

    document.getElementById('cont31').style.display='none'
    document.getElementById('cont32').style.display='none'
    document.getElementById('cont33').style.display='none'

    document.getElementById('cont41').style.display='none'
    document.getElementById('cont42').style.display='none'
    document.getElementById('cont43').style.display='none'

    document.getElementById('cont1').style.display='none'



    switch(no_ocultar) {
        //Empleado
        case "cont11":
            document.getElementById('cont11').style.display='block'
            break;
        case "cont12":
            document.getElementById('cont12').style.display='block'
            break;
        case "cont13":
            document.getElementById('cont13').style.display='block'
            break;
        case "cont14":
            document.getElementById('cont14').style.display='block'
            break;
        case "cont15":
            document.getElementById('cont15').style.display='block'
            break;


        //Cliente
        case "cont21":
            document.getElementById('cont21').style.display='block'
            break;
        case "cont22":
            document.getElementById('cont22').style.display='block'
            break;
        case "cont23":
            document.getElementById('cont23').style.display='block'
            break;

        //Producto
        case "cont31":
            document.getElementById('cont31').style.display='block'
            break;
        case "cont32":
            document.getElementById('cont32').style.display='block'
            break;
        case "cont33":
            document.getElementById('cont33').style.display='block'
            break;

        //Proveedor
        case "cont41":
            document.getElementById('cont41').style.display='block'
            break;
        case "cont42":
            document.getElementById('cont42').style.display='block'
            break;
        case "cont43":
            document.getElementById('cont43').style.display='block'
            break;

        //otros
        case "cont1":
            document.getElementById('cont1').style.display='block'
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