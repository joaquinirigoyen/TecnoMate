$(document).ready(function () {//cada vez que hay na modificacion en el html se activa

    $("#formCrearProducto").validate({//valida lo que esta dentro del formulario
        rules: {//por cada name/id se coloca lo que quiere validar
            pronombre: {
                required: true //este campo es requerido
            },
            prodetalle: {
                required: true
          
            },
            procantstock: {
                required: true
            },
            tipo: {
                required: true
          
            },
            imagenproducto: {
                required: true
            }
        },
        messages: {//mensaje que se quiere mostrar
            pronombre: {
                required: "Complete este campo"
            }
          
        },
        errorElement: "span",


        //a los campos del formularios incorrectos los coloca en rojo y muestra un mensaje de invalidez
        // a los formularios correctos los pinta de verde
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

        //cuando los campos estan validos, ejecuta el codigo de adentro
        submitHandler: function(form){

            //Variable que toma el formulario y los pasa a formato json con .serialize
            var formData = $(form).serialize()
            
            //funcion ajax que permite mandar informacion desde js a php
            $.ajax({ 
                //parametros
                url: "../../Control/Ajax/altaProducto.php", //donde mandar los datos
                type: "POST", // que tipo de formato se manda la informacion (POST/GET)
                dataType: "json",//el tipo de formato en el que se espera una respuesta(ver prueba.php y pruebajson.php en ajax antigue)
                data: formData,//los datos del formulario que uno va a mandar en formato json
                async: false,//le dice al ajax que no sea asincronico. Espera a la respuesta antes de seguir ejecutando codigo

                //casos
                complete: function(xhr, textStatus) {
                    //se llama cuando se recibe la respuesta (no importa si es error o éxito)
                    console.log("La respuesta regreso");
                },
                //cuando se formo correctamente el json ejecuta el codigo de adentro(respuesta es el json que se formo)
                success: function(respuesta, textStatus, xhr) {
                    //se llama cuando tiene éxito la respuesta
                    if (respuesta.resultado == "exito"){//esta verificando que el arreglo respuesta en formato json en el indice resultado sea igual a exito
                        console.log(respuesta.resultado);

                        alert("Carga realizada con exito");
                        $("#modalNuevoProducto").modal("hide");

                    } else {
                        console.log(respuesta.resultado);
                    }
                    //esto hace una validacion (no es necesario)
                    $(form).find('.is-valid').removeClass('is-valid');//busca la clase y la remueve
                    $("#formCrearProducto")[0].reset();//vuelve todos los valores del formulario a cero

                },

                //xhr: un arreglo medio raro. Muestra errores
                //textStatus: estado. muestra que fallo
                error: function(xhr, textStatus, errorThrown) {
                    //called when there is an error
                    console.error("Error en la solicitud Ajax: " + textStatus + " - " + errorThrown)
                    console.log(xhr.responseText);//muestra en la consola del navegador todos los errores
                }
            });
        }
    });
});
