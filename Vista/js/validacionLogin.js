$(document).ready(function () {

    $("#formLogin").validate({
        rules: {
            usnombreLogin: {
                required: true
            },
            uspassLogin: {
                required: true
            },
            captchaLogin: {
                captchaLoginSinExpirar: {captchaLoginSinExpirar: true},
                required: true,
                captchaLoginCorrecto: {captchaLoginCorrecto: true}
            }
        },
        messages: {
            usnombreLogin: {
                required: "Ingrese su usuario"
            },
            uspassLogin: {
                required: "Ingrese su contraseña"
            },
            captchaLogin: {
                required: "Complete el captcha"
            }
        },
        errorElement: "span",

        errorPlacement: function (error, element) {

            var elementosRepetidos2 = document.querySelectorAll(".captcha-incorrecto");
            elementosRepetidos2.forEach(function(elemento2) {
                elemento2.remove();
            });

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

            // Obtiene el valor de uspassLogin del formulario
            var uspassLoginValue = $("#uspassLogin").val();
            // Aplica la función MD5 a la cadena
            var uspass = CryptoJS.MD5(uspassLoginValue).toString();
            var usnombre = $("#usnombreLogin").val();

            var formData = {
                'usnombreLogin': usnombre,
                'uspassLogin': uspass
            };
            
            $.ajax({ 
                url: "accion/accionLogin.php",
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
                        console.log("rol leido :"+ respuesta.rol)
                        console.log(respuesta.resultado);
                        $(form).find('.is-valid').removeClass('is-valid');
                        $("#formLogin")[0].reset();
                        $("#imgCaptchaLogin").attr("src", "accion/captchaLogin.php?r=" + Math.random());
                        alert(respuesta.mensaje);
                        $("#modalLogin").modal("hide");
                       
                        if(respuesta.rol == 1){
                            window.location.href = "../administrador/homeAdministrador.php";  
                        } else if (respuesta.rol == 2){
                            window.location.href = "../deposito/homeDeposito.php";
                        }else{
                            window.location.href = "../cliente/homeCliente.php";
                        }
                     
                    } else {
                        console.log(respuesta.resultado);
                        $(form).find('.is-valid').removeClass('is-valid');
                        $("#imgCaptchaLogin").attr("src", "accion/captchaLogin.php?r=" + Math.random());
                        alert(respuesta.mensaje);
                        
                    }

                },
                error: function(xhr, textStatus, errorThrown) {
                    //called when there is an error
                    console.error("Error en la solicitud Ajax: " + textStatus + " - " + errorThrown);
                    console.log(xhr.responseText);//muestra en la consola del navegador todos los errores
                    //console.error(xhr);
                    //console.error(textStatus);
                    //console.error(errorThrown);
                }
            });
        }
    });

    $("#actualizarCaptchaLogin").on("click", function() {
        $("#imgCaptchaLogin").attr("src", "accion/captchaLogin.php?r=" + Math.random());
    });
});

jQuery.validator.addMethod("captchaLoginSinExpirar", function (value, element) {
    return this.optional(element) || captchaLoginSinExpirar(value);
}, "El captcha ha expirado, por favor actualícelo");

jQuery.validator.addMethod("captchaLoginCorrecto", function (value, element) {
    return this.optional(element) || captchaLoginCorrecto(value);
}, "El captcha ingresado es incorrecto");

function captchaLoginSinExpirar(value){

    var formData = {'captchaLogin': value};
    var ruta = "accion/captchaLoginSinExpirar.php";
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
        },
        error: function(xhr, textStatus, errorThrown) {
            console.error("Error en la solicitud Ajax: " + textStatus + " - " + errorThrown);
            console.log(xhr.responseText);
        }

        });

    return resultado;
}

function captchaLoginCorrecto(value){

    var formData = {'captchaLogin': value};
    var ruta = "accion/captchaLoginCorrecto.php";
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