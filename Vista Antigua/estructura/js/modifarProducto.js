$(document).ready(function () {

    $("#formCrearProducto").validate({
        rules: {
            pronombre: {
                required: true
            },
            prodetalle: {
                required: true
          
            },
            procantstock: {
                required: true
            },
            tipo: {
                required: true
          
            }
        },
        messages: {
            pronombre: {
                required: "Complete este campo"
            }
          
        },
        errorElement: "span",

        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".contenedor-dato").append(error);
        },
        highlight: function (element) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid").addClass("is-valid");
        },

        submitHandler: function(form){

            var formData = $(form).serialize()
            
            $.ajax({ 
                url: "../../Control/Ajax/modificarProducto.php",
                type: "POST",
                dataType: "json",
                data: formData,
                async: false,

                complete: function(xhr, textStatus) {
                    //se llama cuando se recibe la respuesta (no importa si es error o éxito)
                    console.log("La respuesta regreso");
                },
                success: function(respuesta, textStatus, xhr) {
                    //se llama cuando tiene éxito la respuesta
                    if (respuesta.resultado == "exito"){
                        console.log(respuesta.resultado);

                        
                       alert("Actualizacion realizada con exito");
                        $("#formCrearProducto").form("hide");

                    } else {
                        console.log(respuesta.resultado);
                    }

                    $(form).find('.is-valid').removeClass('is-valid');
                    $("#formCrearProducto")[0].reset();

                },
                error: function(xhr, textStatus, errorThrown) {
                    //called when there is an error
                    console.error("Error en la solicitud Ajax: " + textStatus + " - " + errorThrown)
                }
            });
        }
    });
});
