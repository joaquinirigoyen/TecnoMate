<!-- Crea un modal con un formulaario para iniciar sesion-->

<div class="modal fade" id="modalLogin" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="logologin">
                    <img src="../../Archivos/Imagenes/logoBlanco.png" alt="Logo de la empresa" width="110" class="logologin">
                </div>
            </div>
                <h5 class="modal-title ">Iniciar sesión</h5>
                <div class="modal-body">

                <form name="formLogin" id="formLogin" method="POST" class="needs-validation" novalidate>

                    <div class="contenedor-dato">
                        <!-- <label for="usnombreLogin" class="form-label">Usuario</label> -->
                        <input type="text" class="form-control" id="usnombreLogin" name="usnombreLogin" placeholder="Usuario">
                    </div>
                    <br>
                    <div class="contenedor-dato">
                        <!-- <label for="uspassLogin" class="form-label">Contraseña</label> -->
                        <input type="password" class="form-control" id="uspassLogin" name="uspassLogin" placeholder="Contraseña">
                    </div>
                    <br>
                    <div class="contenedor-dato">
                        <!-- <label for="captchaLogin" class="form-label">Captcha</label> -->
                        <input type="text" class="form-control" id="captchaLogin" name="captchaLogin" placeholder="Captcha">
                    </div>
                    <br>
                    <div class="contenedor-dato input-group">
                        <img src="accion/captchaLogin.php" id="imgCaptchaLogin" alt="Imagen de captcha" class="img-fluid rounded-start" style="width: 75%;">
                        <button class="btn btn-secondary" type="button" id="actualizarCaptchaLogin" name="actualizarCaptchaLogin" style="width: 25%;"><i class="bi bi-arrow-clockwise"></i></button>
                    </div>
                    <br>
                    <div class="d-grid mb-3 gap-2">
                        <button type="submit" id="botonLogin" class="btn btn-dark ingresar" name="botonLogin">INGRESAR</button>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <div class="d-grid gap-2 col-6 mx-auto">
                    <a class="btn btn-outline-secondary crearcta" data-bs-toggle="modal" data-bs-target="#modalCrearCuenta" tabindex="-1" data-bs-toggle="modal">Crear Cuenta</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../js/validacionLogin.js"></script>