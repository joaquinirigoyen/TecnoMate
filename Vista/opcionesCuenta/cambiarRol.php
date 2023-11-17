<!-- Crea un modal con un formulaario modificar nombres de los usuarios -->

<div class="modal fade" id="modalCambiarRol" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CAMBIAR ROLES</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form name="formCambiarRol" id="formCambiarRol" method= "POST" class="needs-validation" novalidate>
                <div class="modal-body">
                    <div class="contenedor-dato">
                        <input type="radio" id="opcion1" name="cambiarRol" value="1">
                        <label for="opcion1">ADMINISTRADOR</label>
                    </div>
                    <br>
                    <div class="contenedor-dato">
                        <input type="radio" id="opcion2" name="cambiarRol" value="2">
                        <label for="opcion2">DEPOSITO</label>
                    </div>
                    <br>
                    <div class="contenedor-dato">
                        <input type="radio" id="opcion3" name="cambiarRol" value="3">
                        <label for="opcion3">CLIENTE</label>
                    </div>
                    <div class="modal-footer">
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <div class="d-grid mb-3 gap-2">
                                <button type="submit" id="realizarCambios" class="btn text-white  btn-dark">CAMBIAR</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../js/cambiarRol.js"></script>