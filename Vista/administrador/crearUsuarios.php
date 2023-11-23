<?php
include_once("../../configuracion.php");
$tituloPagina = "TechnoMate | Administrador";
include_once '../estructura/headSeguro.php';
include_once '../estructura/navSeguro.php';
?>
<div class="contenido-pagina ">
<div class=" text-center w-50 p-3">
    <h5  id="respuesta"></h5>
</div>
<div class="container p-3 " >
  <div class="card text-center w-50 mb-3 "> 
    <div class="card-header text-bg-dark mb-3">
          <h5> USUARIO NUEVO</h5>
    </div>
    <div class="card-body">
    <form id="formAltaUs">
            <label for="nombreUsuario" class="col-form-label">Usuario</label>
            <input type="text" class="form-control form-control-sm" id="nomUsuario" required >
            <br>
            <label for="passUsuario" class="col-form-label">Contraseña</label>
            <input type="password" class="form-control form-control-sm" id="passUsuario" required >
            <label for="email" class="col-form-label">Email</label>
            <input  class="form-control form-control-sm" id="email" >
         
            <div class="contenedor-dato">
            <label for="passUsuario" class="col-form-label">Asignar Rol con numero "(1)Administrador,(2)Deposito, (3)Cliente"</label>
            <input type="text" class="form-control form-control-sm" id="rol" required>
            </div>
            <div class="card-footer text-body-secondary">
                <button type="submit" class="btn btn-dark" id="enviar">Crear usuario</button>
            </div>   
         </form>
     </div>
  </div>

</div>
</div>
<?php
include_once '../estructura/footer.php';
?>
<script>

$(document).ready(function(){

    $('#formAltaUs').submit(function(e){

        const postDate = {
            nombreUs: $('#nomUsuario').val(),
            pass: $('#passUsuario').val(),
            email: $('#email').val(),
            rol: $('#rol').val()
        };
     $.post('Accion/altaUsuario.php', postDate ,function (respuesta){
       // console.log(respuesta);
            $('#respuesta').html(respuesta)
       
        $('#formAltaUs').trigger('reset');
      });
      e.preventDefault();
    });

});
</script>