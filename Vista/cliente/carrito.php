<?php
include_once("../../configuracion.php");
$session =new Session();

$total=0;
echo"<h3>Mi carrito</h3>";
  
  if (isset($_SESSION['carrito'])){

    foreach($_SESSION['carrito'] as $indice => $arreglo){
      echo"<hr>Producto" .$indice. "<br>";

      $total += $arreglo['cant'] * $arreglo['precio'];
      foreach($arreglo as $key => $value){
        echo $key .":".$value."<br>";
      }
      echo '<a href="carrito.php?item='.$indice.'&accion=sumar">Agregar</a>';
      echo '<a href="carrito.php?item='.$indice.'&accion=restar">Restar</a>';
      echo '<a href="carrito.php?item='.$indice.'&accion=eliminar">Eliminar Item</a>';;
    }
    echo"<h3> Total de compra:$ " .$total."</h3>";
    echo '<a href="homeCliente.php"> Volver</a>';
    echo'<a href="finalizarCompra.php">Finalizar compra</a>';
    //echo <a href="carrito.php?vaciar=true">Vaciar Carrito</a>';
  }else{
    echo "<script>alert('El carrito esta vacio');</script>";
    //header("location:mostrarProductos.php");
  }



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
?>
