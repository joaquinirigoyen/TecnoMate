<?php
include_once("../../configuracion.php");
$tituloPagina = "TechnoMate | Administrador";
include_once '../estructura/headSeguro.php';
include_once '../estructura/navSeguro.php';

?>
<div class="contenido-pagina ">
<div class="alert alert-success" id="respuesta" role="alert">

</div>
<div class="container p-3" >
      
    <form name="formLogin" id="formLogin" method="POST" class="needs-validation" action="Accion/crearNuevoRol.php">
    <div class="card text-center w-50 mb-3 " >
          <div class="card-header text-bg-dark mb-3">
                <h5> ROl NUEVO</h5>
          </div>
 
         <div class="card-body">
                 <label for="nombreUsuario" class="col-form-label">Ingrese Id del Rol (un numero)</label>
                 <input type="text" class="form-control form-control-sm" id="idrol" name="idrol">
                    <br>
                 <label for="emailUsuario" class="col-form-label">Descripcion del Rol</label>
                 <input type="text" class="form-control form-control-sm" id="rodescripcion" name="rodescripcion">
                  <br>
                  <div class="card-footer text-body-secondary">
                    <input type="submit" class="btn btn-dark" value="Crear Rol"></input>
                  </div>   
           </div>
     </div>
   </form>

</div>
</div>

<?php
include_once '../estructura/footer.php';
?>