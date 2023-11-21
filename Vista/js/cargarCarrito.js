$(document).ready(function() {

$('#formProductos').submit( function(e) {//captura  el form del produccto por su id
   /*console.log('enviando');
   e.preventDefaul();*/
   const posData ={
    id:$('#id').val(),
    nombre: $('#nombre').val(),
    precio: $('#precio').val(),
    cantidad: $('#cantidad').val()
   };
   $.post('listarCarrito.php', posData, function(respuesta){
    console.log(respuesta);
   });
   e.preventDefaul();
});

});
