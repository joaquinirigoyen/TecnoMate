<!-- Crea un modal con un formulaario modificar nombres de los usuarios -->

<div class="modal fade" id="modalConfiguracion" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Configuración de cuenta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="contenedor-dato">
                    <p>Usuario: <span id="nombreUsuario"></span><p>
                </div>
                <div class="contenedor-dato">
                    <p>Mail: <span id="mailUsuario"></span><p>
                </div>
                
                <hr class="modal-divider">

                <form name="formConfiguracionCuenta" id="formConfiguracionCuenta" method="POST" class="needs-validation" novalidate>
                    
                    <div class="contenedor-dato">
                        <label for="uspass" class="form-label">Ingrese su nuevo nombre de usuario</label>
                        <input type="text" class="form-control" id="usnombre" name="usnombre">
                    </div>
                    <br>

                    <div class="contenedor-dato">
                        <label for="usmail" class="form-label">Ingrese su nueva dirección de mail</label>
                        <input type="text" class="form-control" id="usmail" name="usmail">
                    </div>
                    <br>

                    <div class="contenedor-dato">
                        <label for="uspass" class="form-label">Ingrese su nueva contraseña</label>
                        <input type="password" class="form-control" id="uspass" name="uspass">
                    </div>
                    <div class="contenedor-dato">
                        <label for="uspass2" class="form-label">Repita su nueva contraseña</label>
                        <input type="password" class="form-control" id="uspass2" name="uspass2">
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <div class="d-grid gap-2 col-6 mx-auto">
                    <div class="d-grid mb-3 gap-2">
                        <button type="submit" id="realizarCambios" class="btn text-white  btn-dark">REALIZAR CAMBIOS</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../js/configuracionCuenta.js"></script>