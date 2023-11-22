<?php
include_once("../../configuracion.php");
$texto = 'Mi Carrito';
$tituloPagina = "TechnoMate | " . $texto;
include_once("../estructura/headSeguro.php");
//include_once("../estructura/navSeguro.php"); este nav me esta gerando errores.....
$session =new Session();
$total=0;

echo"<div class='container p-3'>";

echo"<h2 class='text-center'>Mi carrito</h2>";

  if (isset($_SESSION['carrito'])){

    foreach($_SESSION['carrito'] as $indice => $arreglo){
      echo"<table class='table table-hover table-bordered'>
      <thead class='table-dark'>
      <th colspan='4'scope='col' class='text-center'>Producto" .$indice. "</td>
      </thead>
      </table>";

      $total += $arreglo['cant'] * $arreglo['precio'];//calcular el total
      echo '<table class=" table table-light">';
      foreach($arreglo as $key => $value){
        echo '<tr>';
           echo '<th>'.$key .'</th>';
          echo '<td >' . $value . '</td>';
        echo '</tr>';
      }
      echo '</table>';
      echo ' <div class="container text-center">
              <div class="row align-items-center">
                <div class="col">
                <a href="carrito.php?item='.$indice.'&accion=sumar"><i class="bi bi-plus-circle-fill" style="font-size: 20px; color: black"></i></a>
               </div>
              <div class="col">
              <a href="carrito.php?item='.$indice.'&accion=restar"><i class="bi bi-dash-square-fill" style="font-size: 20px; color: black"></i></a>
             </div>
            <div class="col">
            <a href="carrito.php?item='.$indice.'&accion=eliminar"><i class="bi bi-trash3-fill" style="font-size: 20px; color: red"></i></a>
             </div>
          </div>
        </div>';
    }
    echo"<table class='table table-hover table-bordered'>
    <thead class='table-secondary'>
    <th colspan='4'scope='col' class='text-center'>Total de compra:$ " .$total. "</td>
    </thead>
    </table>";
    echo'<div class="d-grid gap-2 d-md-flex justify-content-md-end">';
    echo '<a href="homeCliente.php"> <button type="button" class="btn btn-outline-secondary btn-lg me-md-2">Seguir Comprando</button></a>';
    echo'<a href="finalizarCompra.php"><button type="button" class="btn btn-success btn-lg">Finalizar compra</button></a>
    </div>';
    //echo <a href="carrito.php?vaciar=true">Vaciar Carrito</a>';
  }else{
   echo "<div class='alert alert-danger' role='alert'>
    Carrito vacio.
  </div>";
  }
  echo"</div>";


  if(isset($_REQUEST['item'])){
    $producto=$_REQUEST['item'];
    $accion=$_REQUEST['accion'];
    $cantidad = $_SESSION['carrito'][$producto]['cant'];
    $precio = $_SESSION['carrito'][$producto]['precio'];
    if ($accion == "sumar") {
      $cantidad++;
      $_SESSION['carrito'][$producto]['cant'] = $cantidad;
    } else if ($accion == "restar") {
      if ($cantidad > 1) {
        $cantidad--;
        $_SESSION['carrito'][$producto]['cant'] = $cantidad;
      }
    }else if ($accion == "eliminar") {
        unset($_SESSION['carrito'][$producto]);
      }
      $total += $cantidad * $precio;
     header("location: carrito.php");
  }

include_once("../estructura/footer.php");
?>

