
<?php
include_once("../../configuracion.php");

$datos = data_submitted();
$texto = $datos["nombre"];

$tituloPagina = "TechnoMate | " . $texto;

include_once("../estructura/headSeguro.php");
include_once("../estructura/navSeguro.php");

?>

<<link rel="stylesheet" href="../vista/css/bootstrap/4.5.2/bootstrap.min.css">
<div class="container border border-secondary principal mt-3 pt-3">
   <h3 class="text-center">Mi Carrito</h3>
    <div class="row text-muted m-0">
        <?php 
        
          $datos = data_submitted();

          $objUsuario = new AbmUsuario(); 
            
          //valida la session 
           $param["idusuario"] = $_SESSION['idusuario'];

           //busca el usuario por id
           $usuario = $objUsuario->buscar($param);
           // print_r($usuario);
            
           // busca las compras del usuario
           $objCompra = new AbmCompra();
           $compraActiva = $objCompra->buscarCarritoAbierto($param);
           echo $compraActiva;

           $objeItem = new AbmCompraItem(); 
           $item= $objeItem->buscar( $compraActiva );

          // print_r( $item);
        
          // $parame['idproducto']= $item['idproducto'];


           $objeProd= new AbmProducto(); 
           $parametro['idproducto']=$item['idproducto'];

           $listaProducto=$objeProd->buscar($parametro); 
        
        
        if(count($listaProducto )>0){
            ?>
            <table class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad </th>
                        <th scope="col">Modificar</th>
                      
                                        
                    </tr>
                </thead>
                <tbody>
                <?php
                    
                    foreach ($listaProducto as $objProducto) {                         
                        echo '<tr>
        
                        <td>'.$objProducto->getProNombre().'</td>';
                        echo '
                        <td>'.$objProducto->getProDetalle().'</td>';
                        echo '
                        <td>'.$item->getCiCantidad().'</td>';
                    
                        echo '<td><a href="editarProducto.php?accion=editar&idproducto='.$objProducto->getIdproducto().'" class="btn  btn-dark">Editar</a></td>';
                        echo '<td><a href="accionBorradoLogico.php?accion=borradoLogico&idproducto='.$objProducto->getIdproducto().'" class="btn btn-danger">Borrar</a></td>';
                   
                           echo'</tr>';
                  
                     }
                    //fin foreach
                    echo '    </tbody>
                    </table>';
                }
                else{

                    echo "<h3>No hay productos registrados </h3>";
                }
                
                ?>
            
        
</div>
<div class="col-md-3">
            <a href="formProducto.php"class="btn btn-primary mb-4">Nuevo Producto</a>
        </div>
</div>
<div>
<?php
include ("../cargarProdCantidad.php");
include ("../../Vista/estructura/footer.php");
?>
