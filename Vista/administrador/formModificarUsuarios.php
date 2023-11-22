<?php
include_once("../../configuracion.php");
$tituloPagina = "TechnoMate | Administrador";
include_once '../estructura/headSeguro.php';
include_once '../estructura/navSeguro.php';


$idUsuario = data_submitted();
$objUsuario = new AbmUsuario();
$usuario = $objUsuario->buscar($idUsuario);


/* $objSesion = new Session();

if ($objSesion->validar()){
    if($_SESSION['rol'] == 1){
        include_once '../estructura/secciones/nav-bar-2.php';
    } else {
        header('Location: home.php');
    }
    
} else {
    header('Location: home.php');
} */
?>
<div class="container" style="padding: 50px;">
    <form name="actualizarUsuario" id="actualizarUsuario" method="POST" action="Accion/modificarUsuarios.php"
        class="needs-validation" novalidate>
        <h3>Ingrese los nuevos datos a modificar</h3>
        <br>

        <div class="contenedor-dato">
            <label for="idusuario" class="form-label">ID de usuario</label>
            <input type="text" name="idusuario" id="idusuario" class="form-control"
                value="<?php echo $usuario[0]->getIdUsuario() ?>" readonly></input>
        </div>
        <br>

        <div class="contenedor-dato">
            <label for="usnombre" class="form-label">Nombre de usuario</label>
            <input type="text" name="usnombre" id="usnombre" class="form-control"
                value="<?php echo $usuario[0]->getUsNombre() ?>"></input>
        </div>
        <br>

        <div class="contenedor-dato">
            <label for="usmail" class="form-label">Email</label>
            <input type="text" name="usmail" id="usmail" class="form-control"
                value="<?php echo $usuario[0]->getUsMail() ?>"></input>
        </div>
        <br>

        <div class="contenedor-dato">
            <label for="uspass" class="form-label">Contraseña</label>
            <input type="password" name="uspass" id="uspass" class="form-control"></input>
        </div>
        <br>

        <div class="d-grid mb-3 gap-2">
            <input type="submit" value="Editar" class="btn text-white  btn-dark"></input>
        </div>
    </form>
    <a href="./listarUsuarios.php"><input type="submit" value="Cancelar" class="btn text- white btn-danger">
        </input></a>
</div>

<?php
include_once '../estructura/footer.php';
?>