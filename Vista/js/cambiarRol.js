document.getElementById("formCambiarRol").onsubmit = function() {

    var opcionSeleccionada = document.querySelector('input[name="cambiarRol"]:checked').value;
    console.log("La opción seleccionada es: " + opcionSeleccionada);

    formData = {opcion: opcionSeleccionada};

    $.ajax({ 
        url: "../opcionesCuenta/accion/cambiarRol.php",
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
            console.log(respuesta.resultado);

            if(respuesta.mensaje == 1){
                window.location.href = "../../administrador/homeAdministrador.php"; 
            } else if (respuesta.mensaje == 2){
                window.location.href = "../../deposito/homeDeposito.php"; 
            } else if (respuesta.mensaje == 3){
                window.location.href = "../../cliente/homeCliente.php"; 
            }

        },
        error: function(xhr, textStatus, errorThrown) {
            //called when there is an error
            console.error("Error en la solicitud Ajax: " + textStatus + " - " + errorThrown)
            console.log(xhr.responseText);//muestra en la consola del navegador todos los errores
        }
    });
};
