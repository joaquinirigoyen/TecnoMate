<?php
include_once("../../configuracion.php");
$texto = 'mis compras';
$tituloPagina = "TechnoMate | " . $texto;
include_once("../estructura/headSeguro.php");
include_once("../estructura/navSeguro.php");

$objCompra = new AbmCompra();
$objProducto = new AbmProducto();
$objUsuario = new AbmUsuario(); 
$objAbmCompraEstado = new AbmCompraEstado();
$objAbmCompraItem = new AbmCompraItem();

//valida la session
$param["idusuario"] = $_SESSION['idusuario'];
echo $_SESSION['idusuario'];
//busca el usuario por id
$usuario = $objUsuario->buscar($param);

// busca las compras del usuario
$comprasUsuario = $objCompra->buscar($usuario);


?>

<div class="contenido-pagina">
    <h2>Historial de compras del Cliente <?php echo $usuario[0]->getUsNombre()?></h2>
    <table class="table table-striped table-bordered nowrap" id="tabla">
        <thead >
            <tr>  
              <th><strong>Producto</strong></th>
              <th><strong>Precio</strong></th>
              <th><strong>fecha</strong></th>
              <th><strong>Estado</strong></th>
              <th><strong>Acciones</strong></th>
            </tr>
        </thead>

        <tbody>
        <?php 
        if (count($comprasUsuario)>0){
            // saca el id de las compras, ColEstados arreglos de arreglos = matriz porq en el buscar le devuelve el arreglo
            $param["cefechafin"] = "NULL";
            for ($i=0; $i <count($comprasUsuario) ; $i++) { 
                $colIdCompra [] = $comprasUsuario[$i]->getIdCompra();
                $param["idcompra"] = $comprasUsuario[$i]->getIdCompra();
                $colEstados [] = $objAbmCompraEstado->buscar($param);
            }
            
            
            $colComprasEstado = $objAbmCompraEstado->buscar($param);
            //id de compra a travez del compra estado
            for($i=0; $i < count($colComprasEstado); $i++){
                $idCompra = $colComprasEstado[$i]->getObjCompra()->getIdCompra();
                $colIdCompra[] = $idCompra;
              
            }
            

            //recorre los id compras
            for($i=0; $i < count($colIdCompra); $i++){
                $param2["idcompra"] = $colIdCompra[$i];

                $colComprasItems = $objAbmCompraItem->buscar($param2);
                
                for($j=0; $j < count($colComprasItems); $j++){
                    $objTipo = $colEstados[$j][0]->getObjCompraEstadoTipo();
                    $detalle = $objTipo->getDescripcion();
                    echo '<tr>';
                    echo '<td>'.$nombreProducto = $colComprasItems[$j]->getObjProducto()->getProNombre().'</td>';
                    echo '<td>'.'$'.$nombreProducto = $colComprasItems[$j]->getObjProducto()->getProDetalle().'</td>';
                    echo '<td>'.$comprasUsuario[$i]->getCoFecha().'</td>';
                    echo '<td>'.$detalle.'</td>';
                    echo '<td>'.'deshabilitado'.'</td>';
                    echo '</tr>'; 
                }
        
            }

        }
        else{
            echo 'No Realizaste compras por este momento';
        } 
        ?>
        </tbody>
    </table>
</div>

<?php
include_once("../estructura/footer.php");
?>