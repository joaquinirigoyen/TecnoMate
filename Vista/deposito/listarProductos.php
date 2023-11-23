<?php
include_once("../../configuracion.php");
$tituloPagina = "TechnoMate | Deposito";
include_once '../estructura/headSeguro.php';

$objSesion = new Session();

if ($objSesion->validar()){
    if($_SESSION['rol'] == 2){
        include_once '../estructura/navSeguro.php';
    } else {
        header('Location: homeDeposito.php');
    }
} else {
    header('Location: home.php');
}


    $objProducto = new AbmProducto();
    $colProductos = $objProducto->buscar("");

?>

<div class="container-fluid" style="padding: 50px;">

<?php

if (!empty($colProductos)){
    echo "<h4 class='text-center text-white bg-dark'>Listado de productos</h4>";
    echo "<table class='table table-striped table-hover' >";
    echo "<tr>";
    echo "<th>ID de producto</th>
     <th>Descripción</th>
    <th>Cantidad de stock</th>
    <th>Acción</th>";
     
    foreach($colProductos as $producto){
       
        echo "<tr>
          <td>".$producto->getIdProducto()."</td>
          <td>".$producto->getProNombre()."</td>
          <td>".$producto->getProCantstock()."</td>";
          //echo'<td><a href="formActualizar.php?idproducto='.$producto->getIdProducto().'" class="btn text-white btn-dark" data-bs-target="#modalActualizarDatosProd" tabindex="-1" data-bs-toggle="modal">Actualizar</a></td>';
          echo "<td><button type='button' class='btn text-white btn-dark' onclick='enviar( ". $producto->getIdProducto().")' data-bs-toggle='modal' data-bs-target='#modalActualizarDatosProd'>Actualizar</button></td>";
         echo"</tr>";
    }

    echo "</table>";
} else {
    echo "<h4>No hay productos cargados en la Base de Datos</h4>";
}
  
?>
</div>
  <!-- Modal detalle carrito-->
  <div class="modal fade" id="modalActualizarDatosProd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ACTUALIZAR DATOS DEL PRODUCTO</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="mostrar"></div>
            </div>
        </div>
    </div>

<?php
include_once ("../estructura/footer.php");
?>
<script>
    var resultado = document.getElementById("mostrar");

    function enviar(codigo) {
   // location.href="administrarProductos.php?codigo="+codigo;
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

        xmlhttp.open("GET", "administrarProductos.php?codigo="+codigo, true);
        xmlhttp.send();

    }
</script>