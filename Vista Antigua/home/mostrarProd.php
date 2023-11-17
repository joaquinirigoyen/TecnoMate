<?php
$texto = $_GET["nombre"];
$tituloPagina = "TechnoMate | " . $texto;
include_once '../estructura/secciones/head.php';
include_once("../../configuracion.php");

$datos = data_submitted();

$objSesion = new Session();

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

$objProduc = new AbmProducto();

// Obtener los elementos de navegación
// Obtiene el nombre del textO DEL MENU SELECCIONADO


$tipoDeProduc = $texto;
$param['tipo'] =  $tipoDeProduc;
$listaProd = $objProduc->buscar($param);
//print_r( $listaProd); 
echo "<div class='contenido-pagina'>";
echo "<div class='container'>";
echo "<div class='row '>";


for ($i = 0; $i < count($listaProd); $i++) {
    echo "<div class='col'>";
    echo "<div class='p-3 d-flex justify-content-center align-items-center'>";
    echo "<div class='card text-center sombraCarta' style='width: 18rem;'>";
    echo "<img class='card-img-top' style='height: 16rem;' src='" . $listaProd[$i]->getImagenProducto() . "' alt='" . $listaProd[$i]->getProNombre() . "'>";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title'>" . $listaProd[$i]->getProNombre() . "</h5>";
    echo "<p class='card-text'>Precio: $" . $listaProd[$i]->getProDetalle() . "</p>";
?>
    <button type='button' class='btn' onclick='enviar( <?php echo $listaProd[$i]->getIdProducto() ?>)' data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='bi bi-cart-plus-fill text-start'></i></button>

    <!-- Modal detalle carrito-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detalle del Producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="mostrar"></div>
            </div>
        </div>
    </div>

<?php
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
//  <i class='bi bi-cart-plus-fill text-start'></i>
echo "</div>";
echo "</div>";
echo "</div>";

if ($objSesion->validar()){
    include_once '../accionesDeCuenta/configuracionCuenta.php';

    if(count($_SESSION['colroles']) > 1){
        include_once '../accionesDeCuenta/cambiarRol.php';
    }
    
} else {
    require_once("../login/login.php");
    require_once("../crearCuenta/formCrearCuenta.php"); 
}

include_once '../estructura/secciones/footer.php';

?>

<script>
    var resultado = document.getElementById("mostrar");

    function enviar(codigo) {
        // location.href="detalle.php?codigo="+codigo;
        var xmlhttp;
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                resultado.innerHTML = xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET", "detalle.php?codigo=" + codigo, true);
        xmlhttp.send();

    }
</script>