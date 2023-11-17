<?php
$tituloPagina = "TechnoMate | Administrador";
include_once '../estructura/head.php';
include("../estructura/nav-bar-1.php");
require_once("../../Modelo/Conector/BaseDatos.php");
include_once("../../configuracion.php");

?>
<div class="contenido-pagina">
    <h5>ROL NUEVO</h5>
    <form name="formLogin" id="formLogin" method="POST" class="needs-validation" action="Accion/crearNuevoRol.php">

        <div class="contenedor-dato">
            <label for="nombreUsuario" class="form-label">Ingrese Id del Rol (un numero)</label>
            <input type="text" class="form-control" id="idrol" name="idrol">
        </div>
        <br>
        <div class="contenedor-dato">
            <label for="emailUsuario" class="form-label">Descripcion del Rol</label>
            <input type="text" class="form-control" id="rodescripcion" name="rodescripcion" >
        </div>
        
        <input type="submit" class="btn btn-outline-secondary" value="Crear usuario"></input>
</div>


<?php
include_once '../estructura/secciones/footer.php';
?>