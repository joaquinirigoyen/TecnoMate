$(document).ready(function () {

    var value = $("#nombreEnElFormulario").val();
    var ruta = "../../Control/Ajax/crearNuevoProducto.php";
    var resultado = false;

    $.ajax({

        url: ruta,
        type: "POST",
        data: value,
        dataType: "json",
        async: false,

        success: function(respuesta) {

            if (respuesta.validacion == "exito"){
                resultado = true;
            }
        }

    });
});