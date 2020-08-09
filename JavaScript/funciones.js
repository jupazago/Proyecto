$('#enviar').click(function(){
    var usuario = document.getElementById('formulario_usuario'.value);
    var clave = document.getElementById('formulario_clave'.value);

    var ruta = "usua="+usuario+"&clav="+clave;

    $.ajax({
        url:'http://localhost/proyecto/PHP/consulta.php',
        type:'POST',
        data: ruta,
    })
    .done(function(){
        $('#respuesta').html(res);
    })
});