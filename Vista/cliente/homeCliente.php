<?php
include_once("../../configuracion.php");
$tituloPagina = "TechnoMate | Inicio";
include_once("../estructura/headSeguro.php");
$objSesion = new Session();

if ($objSesion->validar()){
    if($_SESSION['rol'] == 3){
        include_once '../estructura/navSeguro.php';
    } else {
        header('Location: home.php');
    }
    
} else {
    header('Location: home.php');
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

<?php
include_once("../estructura/footer.php");
?>