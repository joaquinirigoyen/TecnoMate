<?php
include_once("../../configuracion.php");
$tituloPagina = "TechnoMate | Administrador";
include_once '../estructura/headSeguro.php';
include_once '../estructura/navSeguro.php';

?>
<div class="container p-3" >

    <form name="formLogin" id="formLogin" method="POST" class="needs-validation" action="Accion/crearNuevoRol.php">
    <div class="card w-50 mb-3 " >
    <div class="row g-0">
    <h5 class="text-center p-3">ROL NUEVO</h5>
    <div class="col-md-8">
 
      <div class="card-body">
            <label for="nombreUsuario" class="col-form-label">Ingrese Id del Rol (un numero)</label>
            <input type="text" class="form-control form-control-sm" id="idrol" name="idrol">
        <br>
            <label for="emailUsuario" class="col-form-label">Descripcion del Rol</label>
            <input type="text" class="form-control form-control-sm" id="rodescripcion" name="rodescripcion">
            <br>
        
            <input type="submit" class="btn btn-outline-secondary" value="Crear usuario"></input>
        </div>
        </div>
        </div>
     </div>
    </div>
   </form>

</div>


<?php
include_once '../estructura/footer.php';
?>