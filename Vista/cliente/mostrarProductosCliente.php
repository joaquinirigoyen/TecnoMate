<?php
include_once("../../configuracion.php");
include_once("../estructura/headSeguro.php");
include_once("../estructura/navSeguro.php");
$texto = $_GET["nombre"];
$tituloPagina = "TechnoMate | " . $texto;
$datos = data_submitted();


$tituloPagina = "TechnoMate | Productos";




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
    //$formId = "formProd" . $i; //
    echo "<div class='col'>";
    echo "<div class='p-3 d-flex justify-content-center align-items-center'>";
    echo "<div class='card text-center sombraCarta' style='width: 18rem;'>";
    echo "<img class='card-img-top' style='height: 16rem;' src='" . $listaProd[$i]->getImagenProducto() . "' alt='" . $listaProd[$i]->getProNombre() . "'>";
    echo "<div class='card-body'>";

    echo "<h5 class='card-title'>" . $listaProd[$i]->getProNombre() . "</h5>";
    echo "<p class='card-text'>Precio: $" . $listaProd[$i]->getProDetalle() . "</p>";   
    echo "<p class='card-text'>Stock disponible:" . $listaProd[$i]->getProCantstock() . "</p>";  
?>
    
<button type='button' class='btn' onclick='enviar(<?php echo $listaProd[$i]->getIdProducto()?>)'><i class='bi bi-cart-plus-fill text-start'></i></button>
    
    </div>
    
<?php
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
//  <i class='bi bi-cart-plus-fill text-start'></i>
echo "</div>";
echo "</div>";
echo "</div>";

include_once("../estructura/footer.php");
?>
<script>

function enviar(codigo) {
    location.href="detalleProducto.php?codigo="+codigo;
}
</script>
