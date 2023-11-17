function abrirModal(idmenu) {
    // var idmenu = document.getElementById('$idmenu');
    console.log('anda esto');
    // Mostramos el modal de advertencia
    $('#modalMenu').modal('show');

    // Configuramos el evento para el botón "Aceptar" dentro del modal
    $('#aceptar').on('click', function() {
        console.log('Botón Aceptar del modal presionado');
        // Aquí puedes realizar la acción que deseas al presionar Aceptar
        // Por ejemplo, puedes redirigir a la página formEditarMenu.php con el idmenu
        window.location.href = 'Accion/deshabilitarMenu.php?idmenu=' + idmenu;
    });
}

