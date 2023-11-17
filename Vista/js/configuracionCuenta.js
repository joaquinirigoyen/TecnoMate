function actualizarDatosUsuario(){

    var nombreUsuarioElem = document.getElementById("nombreUsuario");
    var mailUsuarioElem = document.getElementById("mailUsuario");
    console.log("Estoy en la función");

    $.ajax({ 
        url: "../../Control/Ajax/actualizarDatosUsuario.php",
        type: "POST",
        dataType: "json",
        //data: formData,
        async: false,

        complete: function(xhr, textStatus) {
            //se llama cuando se recibe la respuesta (no importa si es error o éxito)
            console.log("La respuesta regreso");
        },
        success: function(respuesta, textStatus, xhr) {
            //se llama cuando tiene éxito la respuesta
            if (respuesta.resultado == "exito"){
                nombreUsuarioElem.innerHTML = respuesta.usnombre;
                mailUsuarioElem.innerHTML = respuesta.usmail;

            } else {
                console.log(respuesta.resultado + ", " + respuesta.mensaje);                
            }

        },
        error: function(xhr, textStatus, errorThrown) {
            //called when there is an error
            console.error("Error en la solicitud Ajax: " + textStatus + " - " + errorThrown);
            console.error(xhr.responseText);
        }
    });
}

$(document).ready(function () {

    $("#realizarCambios").on("click", function() {

        var nombreUsuarioElem = document.getElementById("nombreUsuario");
        var mailUsuarioElem = document.getElementById("mailUsuario");
        
        var usnombreValue = document.getElementById("usnombre").value;
        var usmailValue = document.getElementById("usmail").value;
        var uspassValue = document.getElementById("uspass").value;
        var uspass2Value = document.getElementById("uspass2").value;

        if(usnombreValue != ""){

            formData = {"usnombre": usnombreValue};

            $.ajax({ 
                url: "../../Control/Ajax/cambiarUsNombre.php",
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
                        nombreUsuarioElem.innerHTML = usnombreValue;
                        alert(respuesta.mensaje);
                        location.reload();
        
                    } else {
                        console.log(respuesta.resultado + ", " + respuesta.mensaje);
                        alert(respuesta.mensaje);
                    }
        
                },
                error: function(xhr, textStatus, errorThrown) {
                    //called when there is an error
                    console.error("Error en la solicitud Ajax: " + textStatus + " - " + errorThrown);
                    console.error(xhr.responseText);
                }
            });
        }

        if(usmailValue != ""){

            formData = {"usmail": usmailValue};

            $.ajax({ 
                url: "../../Control/Ajax/cambiarUsMail.php",
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
                        mailUsuarioElem.innerHTML = usmailValue;
                        alert(respuesta.mensaje);
        
                    } else {
                        console.log(respuesta.resultado + ", " + respuesta.mensaje);
                        alert(respuesta.mensaje);
                    }
        
                },
                error: function(xhr, textStatus, errorThrown) {
                    //called when there is an error
                    console.error("Error en la solicitud Ajax: " + textStatus + " - " + errorThrown);
                    console.error(xhr.responseText);
                }
            });
        }

        if (uspassValue != ""){
            if (uspass2Value != ""){
                if (uspassValue == uspass2Value){
                    if (uspassValue.length >= 6){

                        uspassValue = CryptoJS.MD5(uspassValue).toString()
                        formData = {"uspass": uspassValue};

                        $.ajax({ 
                            url: "../../Control/Ajax/cambiarUsPass.php",
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
                                    alert(respuesta.mensaje);
                    
                                } else {
                                    console.log(respuesta.resultado + ", " + respuesta.mensaje);
                                    alert(respuesta.mensaje);
                                }
                    
                            },
                            error: function(xhr, textStatus, errorThrown) {
                                //called when there is an error
                                console.error("Error en la solicitud Ajax: " + textStatus + " - " + errorThrown);
                                console.error(xhr.responseText);
                            }
                        });

                    } else {
                        alert("Las contraseña ingresada debe tener al menos 6 carácteres.");
                    }
                } else {
                    alert("Las contraseñas ingresadas no coinciden.");
                }
            } else {
                alert("Debe confirmar 2 veces su nueva contraseña si desea cambiarla.");
            }
        }

        $("#formConfiguracionCuenta")[0].reset();

    });

});