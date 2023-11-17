<?php
include_once("../../configuracion.php");

$tituloPagina = "TechnoMate | Administrador";
include_once '../estructura/secciones/head.php';

$objSesion = new Session();

if ($objSesion->validar()){
    if($_SESSION['rol'] == 1){
        include_once '../estructura/secciones/nav-bar-2.php';
    } else {
        header('Location: home.php');
    }
    
} else {
    header('Location: home.php');
}
?>

<div class ="contenido-pagina">
    <div class="contenedor-acciones">
        
        <div class="accion-admin">
        <a data-bs-target="#modalNuevoUsuario" tabindex="-1" data-bs-toggle="modal">
            <img class="imagen-accion" src="../../Archivos/Imagenes/accionAdmin1.png" alt="Crear nuevo usuario">
            <div class="informacion-accion">
                <p>CREAR NUEVOS USUARIOS</p>
            </div>
            </a>
        </div>
        
        <div class="accion-admin">
            <a href ="../actInfoUsuarios/listarUsuarios.php">
            <img class="imagen-accion" src="../../Archivos/Imagenes/accionAdmin2.png" alt="Actualizar información de usuario">
            <div class="informacion-accion">
                <p>ACTUALIZAR INFORMACIÓN DE USUARIOS</p>
            </div>
            </a>
        </div>

        <div class="accion-admin">
            <img class="imagen-accion" src="../../Archivos/Imagenes/accionAdmin3.png" alt="Administrar roles">
            <div class="informacion-accion">
                <p>ADMINISTRAR ROLES DE USUARIOS</p>
            </div>
        </div>

        <div class="accion-admin">
            <a href="../administrador/gestionMenu.php">
            <img class="imagen-accion" src="../../Archivos/Imagenes/accionAdmin4.png" alt="Crear nuevo rol">
            <div class="informacion-accion">
                <p>CREAR NUEVOS ROLES E ÍTEMS DE MENÚ</p>
            </div>
            </a>
        </div>
    </div>
</div>

<div>
    <?php
        if ($objSesion->validar()){
            include_once '../accionesDeCuenta/configuracionCuenta.php';
            include_once("../nuevoUsuario/formNuevoUsuario.php");

            if(count($_SESSION['colroles']) > 1){
                include_once '../accionesDeCuenta/cambiarRol.php';
            }
            
        } else {
            require_once("../login/login.php");
            require_once("../crearCuenta/formCrearCuenta.php"); 
        }
        include_once '../estructura/secciones/footer.php';
    ?>
</div>
