<?php
$tituloPagina = "TechnoMate | Administrador";
include_once '../estructura/head.php';
include("../estructura/nav-bar-1.php");
require_once("../../Modelo/Conector/BaseDatos.php");
include_once("../../configuracion.php");

?>
<div class="contenido-pagina">
    <h5>USUARIO NUEVO</h5>
    <form name="formLogin" id="formLogin" method="POST" class="needs-validation" action="Accion/altaUsuario.php">

        <div class="contenedor-dato">
            <label for="nombreUsuario" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario">
        </div>
        <br>
        <div class="contenedor-dato">
            <label for="emailUsuario" class="form-label">Email</label>
            <input type="text" class="form-control" id="emailUsuario" name="emailUsuario" >
        </div>
        <div class="contenedor-dato">
            <label for="passUsuario" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="passUsuario" name="passUsuario">
        </div>
        <div class="contenedor-dato">
            <label for="passUsuario" class="form-label">Repita contraseña</label>
            <input type="password" class="form-control" id="passUsuario2" name="passUsuario">
        </div>
        <div class="contenedor-dato">
            <label for="passUsuario" class="form-label">Asignar Rol</label>
            <input type="checkbox" name="Cliente" id="cliente" value="Cliente">Cliente
            <input type="checkbox" name="Deposito" id="deposito" value="Deposito">Deposito
            <input type="checkbox" name="Admin" id="admin" value="Admin">Administrador
        </div>
        <input type="submit" class="btn btn-outline-secondary" value="Crear usuario"></input>
</div>


<?php
include_once '../estructura/secciones/footer.php';
?>