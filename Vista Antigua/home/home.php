<?php
include_once '../../configuracion.php';
$datos = data_submitted();

$objSesion = new Session();

$tituloPagina = "TechnoMate | Inicio";
include_once '../estructura/secciones/head.php';

if ($objSesion->validar()){
    if($_SESSION['rol'] == 3){
        include_once '../estructura/secciones/nav-bar-2.php';
    } else if ($_SESSION['rol'] == 2){
        header('Location: homeDeposito.php');
    } else if ($_SESSION['rol'] == 1){
        header('Location: homeAdministrador.php');
    } else {
        include_once '../estructura/secciones/nav-bar-1.php';
    }
} else {
    include_once '../estructura/secciones/nav-bar-1.php';
}

?>

<div class="contenido-pagina">
    <div class="carrusel">
        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                    class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../../Archivos/Imagenes/inicio1.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../../Archivos/Imagenes/inicio2.png" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>

<div>
    <?php
        if ($objSesion->validar()){
            include_once '../accionesDeCuenta/configuracionCuenta.php';

            if(count($_SESSION['colroles']) > 1){
                include_once '../accionesDeCuenta/cambiarRol.php';
            }
            
        } else {
            require_once("../login/login.php");
            require_once("../crearCuenta/formCrearCuenta.php"); 
        }
    ?>
</div>

<?php

include_once '../estructura/secciones/footer.php';
?>