$(document).ready(function () {

    $("#formCrearCuenta").validate({
        rules: {
            usnombreCrearCuenta: {
                required: true,
                //nombre            //valor que debe tener
                nombreNoRepetido: {nombreNoRepetido: true}
            },
            usmailCrearCuenta: {
                required: true,
                mailValido: {mailValido: true}
            },
            captchaCrearCuenta: {
                captchaCrearCuentaSinExpirar: {captchaCrearCuentaSinExpirar: true},
                required: true,
                captchaCrearCuentaCorrecto: {captchaCrearCuentaCorrecto: true}
            }
        },
        messages: {
            usnombreCrearCuenta: {
                required: "Ingrese su usuario"
            },
            usmailCrearCuenta: {
                required: "Ingrese su dirección de mail"
            },
            captchaCrearCuenta: {
                required: "Complete el captcha"
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
                url: "../../Control/Ajax Antiguo/crearCuenta.php",
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
                        console.log("El resultado de la consulta es: " + respuesta.resultado);

                    } else {
                        console.log(respuesta.resultado);
                    }

                    $(form).find('.is-valid').removeClass('is-valid');
                    $("#formCrearCuenta")[0].reset();
                    $("#imgCaptchaCrearCuenta").attr("src", "../../Control/captchaCrearCuenta.php?r=" + Math.random());
                    alert(respuesta.mensaje);
                    //$("#modalCrearCuenta").modal("hide");

                },
                error: function(xhr, textStatus, errorThrown) {
                    //called when there is an error
                    console.error("Error en la solicitud Ajax: " + textStatus + " - " + errorThrown)
                    console.log(xhr.responseText);//muestra en la consola del navegador todos los errores
                }
            });
        }
    });

    $("#actualizarCaptchaCrearCuenta").on("click", function() {
        $("#imgCaptchaCrearCuenta").attr("src", "../../Control/captchaCrearCuenta.php?r=" + Math.random());
    });
});

jQuery.validator.addMethod("nombreNoRepetido", function (value, element) {
    return this.optional(element) || nombreNoRepetido(value);
}, "Nombre de usuario en uso");

jQuery.validator.addMethod("mailValido", function (value, element) {
    return this.optional(element) || (/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value));
}, "Mail ingresado no válido");

jQuery.validator.addMethod("captchaCrearCuentaSinExpirar", function (value, element) {
    return this.optional(element) || captchaCrearCuentaSinExpirar(value);
}, "El captcha ha expirado, por favor actualícelo");

jQuery.validator.addMethod("captchaCrearCuentaCorrecto", function (value, element) {
    return this.optional(element) || captchaCrearCuentaCorrecto(value);
}, "El captcha ingresado es incorrecto");


function nombreNoRepetido(value){

    var formData = {'usnombreCrearCuenta': value};//array en formato json. value es el dato recibido desde el formulario
    var ruta = "../../Control/Ajax Antiguo/nombreNoRepetido.php";
    var resultado = false;

    $.ajax({

        url: ruta,
        type: "POST",
        data: formData,
        dataType: "json",
        async: false,

        success: function(respuesta) {

            if (respuesta.validacion == "exito"){
                resultado = true;
            }
        }

    });

    return resultado;
}

function captchaCrearCuentaSinExpirar(value){

    var formData = {'captchaCrearCuenta': value};
    var ruta = "../../Control/Ajax Antiguo/captchaCrearCuentaSinExpirar.php";
    var resultado = false;
        
    $.ajax({

        url: ruta,
        type: "POST",
        data: formData,
        dataType: "json",
        async: false,

        success: function(respuesta) {

            if (respuesta.validacion == "exito"){
                resultado = true;
            }
        }

    });

    return resultado;
}

function captchaCrearCuentaCorrecto(value){

    var formData = {'captchaCrearCuenta': value};
    var ruta = "../../Control/Ajax Antiguo/captchaCrearCuentaCorrecto.php";
    var resultado = false;
        
    $.ajax({

        url: ruta,
        type: "POST",
        data: formData,
        dataType: "json",
        async: false,

        success: function(respuesta) {

            if (respuesta.validacion == "exito"){
                resultado = true;
            }
        }

    });

    return resultado;
}

/*
console.log("Este es un mensaje de registro normal");
Se utiliza para imprimir mensajes de registro normales. 
Los mensajes aparecerán en la consola sin ningún resaltado especial y 
se consideran información general o mensajes de depuración.

console.error("Esto es un mensaje de error");
Se utiliza para imprimir mensajes de error. En muchas consolas de desarrollo, 
los mensajes de error se resaltan en rojo o de alguna manera diferente para indicar que hay un problema.

console.warn("Esto es una advertencia");
Se utiliza para imprimir advertencias. Similar a console.error, 
pero suele tener un resaltado amarillo en algunas consolas.

console.info("Esto es un mensaje informativo");
Se utiliza para imprimir mensajes informativos. Similar a console.log, 
pero puede tener un formato o resaltado específico en algunas consolas.

console.debug("Esto es un mensaje de depuración");
Se utiliza para imprimir mensajes de depuración. No todos los navegadores lo admiten, 
y su comportamiento puede variar.
*/

/**
 * GUARDAR ESTA FUNCIÓN, DEVUELVE LOS ERRORES
 *
function nombreNoRepetido2(value) {

    var formData = {'usnombreCrearCuenta': value};
    var ruta = "../../Control/Ajax/nombreNoRepetido.php";

    console.log("Previo al Ajax");

    return $.ajax({
        url: ruta,
        type: "POST",
        data: formData,
        dataType: "json"
    }).then(function(respuesta) {
        console.log("Hubo éxito en la consulta Ajax");
        console.log(respuesta.validacion);
        return respuesta.validacion === "exito";
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Error en la solicitud Ajax: " + textStatus + " - " + errorThrown);
        return false;
    });
}

// Ejemplo de uso
nombreNoRepetido("nombreUsuario").then(function(resultado) {
    console.log(resultado);
});*/

/*
Manejo de Promesas vs. Devoluciones de llamada:
La primera estructura utiliza promesas (then y fail), lo que facilita 
el manejo de código asíncrono y encadenamiento de operaciones.
La segunda estructura utiliza devoluciones de llamada directas (complete, success, error), 
que es un enfoque más antiguo y puede llevar a un código más anidado en situaciones complejas.
*/