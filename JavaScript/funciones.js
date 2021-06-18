src="http://code.jquery.com/jquery-2.1.4.min.js";

function limpiarFormulario() {
    document.getElementById("form_ventas").reset();
}

function foco_input(){
    $("#codigo_producto").focus();  //Poner el cursor en el input
}

$(function () {
    $(document).on('click', '.borrar', function (event) {
        event.preventDefault();
        $(this).closest('tr').remove();
        $("#codigo_producto").focus();  //Poner el cursor en el input
    });
});

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
            console.log('si')
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
function obtener_detalles_factura() {
    var nombres = []

    $("td.names").each(function(){
        nombres.push($(this).text());
    });

    ///////////////////////   
    var precios = []

    $("td.precios").each(function(){
        precios.push(parseFloat($(this).text()));
    });
    ///////////////////////

    var cantidad = []

    
    $("td.total").each(function(){


        for(var i=0; i<precios.length; i++){
            var unidades = parseFloat($(this).text()) / precios[i];
        }
        cantidad.push(unidades);
    });



    console.log(nombres);
    console.log(precios);
    console.log(cantidad);
}





 /*
//funcion que realiza los calculos
function multi() {
    // obtenemos todas las filas del tbody
    var filas=document.querySelectorAll("#tablaprueba tbody tr");
 
    var total=0;
 
    // recorremos cada una de las filas
    filas.forEach(function(e) {
 
        // obtenemos las columnas de cada fila
        var columnas=e.querySelectorAll("td");
 
        // obtenemos los valores de la cantidad y importe
        var cantidad    =   parseInt(columnas[2].textContent);
        var importe     =   parseInt(columnas[3].textContent);
 
        // mostramos el total por fila
        columnas[4].textContent =   (cantidad * importe);
 
        total+=cantidad*importe;
    });
 
    // mostramos la suma total
    var filas=document.querySelectorAll("#tablaprueba tfoot tr td");
    filas[1].textContent=total;
    //$('.final').html(total);
}
/*
function multi2() {
    var lista_tabla = document.getElementById("tablaprueba");
    var final = 0;
    
    var arreglo =  document.getElementsByName("resultados");
    
    for (let i = 0; i < arreglo.length; i++) {
        var resultado = (lista_tabla.getElementsByClassName("precios")[i].value)*(lista_tabla.getElementsByClassName("cantidades")[i].value);
        document.getElementsByName("resultados")[i].value = resultado;
        //console.log(arreglo[i].value);
        final += resultado;
        
    }
    
    //console.log(lista_tabla.getElementsByClassName("precios").lenght);
    

    $('.final').html(final);


     /*

setInterval('multi()',500);

//funcion que realiza los calculos

 function multi() {
    // obtenemos todas las filas del tbody
    var filas=document.querySelectorAll("#tablaprueba tbody tr");
    var total=0;
    var contador=0;
 
    // recorremos cada una de las filas
    filas.forEach(function(e) {
 
        // obtenemos las columnas de cada fila
        var columnas=e.querySelectorAll("td");
 
        // obtenemos los valores de la cantidad y importe
        var cantidad    =   parseInt(columnas[2].textContent);
        var importe     =   parseInt(columnas[3].textContent);
 
        // mostramos el total por fila
        columnas[4].textContent=(cantidad*importe);
        contador++;
        if(contador>2){
            total+=cantidad*importe;
        }
        
    });
 
    // mostramos la suma total
    var filas= document.querySelectorAll("#tablaprueba tfoot tr td");
    //filas[1].textContent=total;
    $('.final').html(total);
}


var valor=0;
function carrito(boton){
    var contador = document.getElementById("contador").value;
    if (boton.value=='aumentar') {
        valor++
    }else if(boton.value=='disminuir' && contador>0){
        valor--
    }
    document.getElementById("contador").textContent = valor;
}*/

