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
                required: true,
                captchaLoginValido: {captchaLoginValido: true}
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
            $(element).removeClass("is-invalid")/*.addClass("is-valid")*/;
        }
    });

    /*Función que valida si los datos son correctos, en caso de serlo
    el usuario ingresará a su cuenta */
    $("#formLogin").submit(function(event) {

        //event.preventDefault();

        var formData = $("#formLogin").serialize();
        var ruta = "../../Control/Ajax/ajaxLogin.php";

        $.ajax({
          url: ruta,
          type: "POST",
          data: formData,
          dataType: "json",
  
          success: function(respuesta) {

            if (respuesta.validacion == "exito"){

                //Resultado de loguearse correctamente
                window.location.href = "../home/home.php";

            } else if (respuesta.validacion == "captcha") {

            }
          }
        });
    });

    $("#actualizarCaptchaLogin").on("click", function() {
        $("#imgCaptchaLogin").attr("src", "../../Control/captchaLogin.php?r=" + Math.random());
    });
});

jQuery.validator.addMethod("captchaLoginValido", function (value, element) {
    return this.optional(element) || validarCaptchaLogin(value, element);
});

function validarCaptchaLogin(value, element){

    var formData = {'captchaLogin': value};
    var ruta = "../../Control/Ajax/ajaxCaptchaLogin.php";
    
    $.ajax({

      url: ruta,
      type: "POST",
      data: formData,
      dataType: "json",

      success: function(respuesta) {

        console.log(value)
        console.log(respuesta.validacion);
        console.log(respuesta.error);

        var elementosRepetidos = document.querySelectorAll(".captcha-correcto");
        elementosRepetidos.forEach(function(elemento) {
            elemento.remove();
        });

        var elementosRepetidos2 = document.querySelectorAll(".captcha-incorrecto");
        elementosRepetidos2.forEach(function(elemento2) {
            elemento2.remove();
        });

        var elementoIdError = document.getElementById("captchaLogin-error");
        elementoIdError.remove();

        if (respuesta.validacion == "exito"){

            var contenedorMensaje = document.createElement("span");
            mensaje = "Captcha ingresado correctamente";
            contenedorMensaje.textContent = mensaje;
            $(contenedorMensaje).addClass("valid-feedback");
            $(contenedorMensaje).addClass("captcha-correcto");
            $(element).removeClass("is-invalid").addClass("is-valid");
            element.closest(".contenedor-dato").append(contenedorMensaje);

        } else if (respuesta.validacion == "expiro"){

            var contenedorMensaje = document.createElement("span");
            mensaje = "El captcha a expirado, por favor actualícelo";
            contenedorMensaje.textContent = mensaje;
            $(contenedorMensaje).addClass("invalid-feedback");
            $(contenedorMensaje).addClass("captcha-incorrecto");
            $(element).removeClass("is-valid").addClass("is-invalid");
            element.closest(".contenedor-dato").append(contenedorMensaje);

        } else if (respuesta.validacion == "incompleto"){

            var contenedorMensaje = document.createElement("span");
            mensaje = "Complete el captcha";
            contenedorMensaje.textContent = mensaje;
            $(contenedorMensaje).addClass("invalid-feedback");
            $(contenedorMensaje).addClass("captcha-incorrecto");
            $(element).removeClass("is-valid").addClass("is-invalid");
            element.closest(".contenedor-dato").append(contenedorMensaje);

        } else {

            var contenedorMensaje = document.createElement("span");
            mensaje = "Captcha ingresado incorrecto";
            contenedorMensaje.textContent = mensaje;
            $(contenedorMensaje).addClass("invalid-feedback");
            $(contenedorMensaje).addClass("captcha-incorrecto");
            $(element).removeClass("is-valid").addClass("is-invalid");
            element.closest(".contenedor-dato").append(contenedorMensaje);

        }

      }
    });
}

