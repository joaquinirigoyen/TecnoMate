
<!-- Crea un modal con un formulaario modificar nombres de los usuarios -->

<div class="modal fade" id="modalCambiarRol" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Seleccione el Rol con el que desea visualizar el sitio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="formConfiguracionCuenta" id="formConfiguracionCuenta" method="POST" class="needs-validation" novalidate>
                    
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <div class="d-grid mb-3 gap-2">
                            <button type="submit" id="cambiarRolAdministrador" class="btn text-white  btn-dark">ADMINISTRADOR</button>
                        </div>
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <div class="d-grid mb-3 gap-2">
                            <button type="submit" id="cambiarRolAdministrador" class="btn text-white  btn-dark">DEPOSITO</button>
                        </div>
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <div class="d-grid mb-3 gap-2">
                            <button type="submit" id="cambiarRolAdministrador" class="btn text-white  btn-dark">CLIENTE</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<script src="../estructura/js/configuracionCuenta.js"></script>