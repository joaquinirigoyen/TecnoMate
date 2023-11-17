
<!-- Crea un modal con un formulaario para crear una cuenta -->

<div class="modal fade" id="modalCrearCuenta" data-bs-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crear una Cuenta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="formCrearCuenta" id="formCrearCuenta" method="POST" class="needs-validation" novalidate>
          
          <div class="contenedor-dato">
            <label for="usnombreCrearCuenta" class="form-label">Nombre usuario</label>
            <input type="text" class="form-control" id="usnombreCrearCuenta" name="usnombreCrearCuenta">
          </div>
          <br>

          <div class="contenedor-dato">
            <label for="usemailCrearCuenta" class="form-label">Email</label>
            <input type="text" class="form-control" id="usmailCrearCuenta" name="usmailCrearCuenta" placeholder="nombre@mail.com">
          </div>
          <br>

          <div class="contenedor-dato">
            <label for="captchaCrearCuenta" class="form-label">Captcha</label>
            <input type="text" class="form-control" id="captchaCrearCuenta" name="captchaCrearCuenta">
          </div>

          <br>
          <div class="contenedor-dato input-group">
            <img src="../../Control/captchaCrearCuenta.php" id="imgCaptchaCrearCuenta" alt="Imagen de captcha" class="img-fluid rounded-start" style="width: 75%;">
            <button class="btn btn-secondary" type="button" id="actualizarCaptchaCrearCuenta" name="actualizarCaptchaCrearCuenta" style="width: 25%;"><i class="bi bi-arrow-clockwise"></i></button>
          </div>

          <br>
          <div class="d-grid mb-3 gap-2">
            <button type="submit" name="botonCrearCuenta" id="botonCrearCuenta" class="btn text-white  btn-dark">REGISTRARME</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <div class="d-grid gap-2 col-6 mx-auto">
          <a class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalLogin" tabindex="-1" data-bs-toggle="modal">Iniciar Sesión</a>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="../estructura/js/validacionCrearCuenta.js"></script>
