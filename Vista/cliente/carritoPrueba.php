<?php
include_once("../../configuracion.php");

$datos = data_submitted();


//print_r($datos);
 $paramProd['idproducto']=$datos['id'];
 $objAbmProducto = new AbmProducto(); 
 $arregloProd=$objAbmProducto-> buscar($param["idproducto"]);


 $parametros["idusuario"] = $_SESSION['idusuario'];

 $objUsuario = new AbmUsuario(); 
 $usuario =$objUsuario->buscar($parametros);

 $objetoCompra = new AbmCompra($param);
 $comprActiva = $objetoCompra->buscarCarritoAbierto($parametros);

 $paramIte['idusuario']=$datos['id'];
 $paramIte['idcompra']=$comprActiva;
 $paramIte['cicantidad']=$datos['cantidad'];

  if(  $comprActiva != null){
    $objItem = new AbmCompraItem();
    $altaItem =$objItem->alta($paramIte);
  }else{

      $fechaAlta = date('Y-m-d H:i:s');
      $param['idusuario']=$datos['id'];
      $param["cofecha"] =$fechaAlta;
      $objetoCompra->alta( $param);

      $paramIte['idcompra']=$objetoCompra->getIdCompra(); 

      $altaItem =$objItem->alta($paramIte);

  }

 





// ESTO LO PUSE PORQUE CUANDO TENES LA CANTIDAD PODES CARGAR LA COMPRA ITEM
/*
CREATE TABLE `compraitem` (
    `idcompraitem` bigint(20) UNSIGNED NOT NULL,
    `idproducto` bigint(20) NOT NULL,
    `idcompra` bigint(20) NOT NULL,
    `cicantidad` int(11) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  
  -- Volcado de datos para la tabla compraitem // cambiar los idproducto
  
  INSERT INTO `compraitem` (`idcompraitem`, `idproducto`, `idcompra`, `cicantidad`) VALUES
  (1, 123, 1, 1),
  (2, 234, 2, 1),
  (3, 345, 3, 1),
  (4, 456, 4, 1);
*/


/*$valor=$datos['precio'];
$cantidad=$datos['cantidad'];

$total=$valor * $cantidad;*/
?>


<div class="container" id="divCarrito">
    <table class="table table-bordered">
        <thead>
            <th>Id Producto</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th></th>
        </thead>
        <tbody>
               <td><?php echo $datos['id'] ?></td>
               <td><?php echo $datos['nombre'] ?></td>
               <td>$<?php echo $datos['precio'] ?></td>
               <td><?php echo $datos['cantidad'] ?></td>
               <th>$<?php echo $total?></th>
        </tbody>
    </table>
</div>