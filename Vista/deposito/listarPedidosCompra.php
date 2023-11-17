<?php
include_once '../../configuracion.php';

//CREO EL ABM COMPRA ESTADO
$objAbmCompraEstado = new AbmCompraEstado();

//LISTO TODAS LAS COMPRAS QUE SU FECHA FIN SEA NULA
$param["cefechafin"] = "NULL";
$colComprasEstado = $objAbmCompraEstado->buscar($param);

for($i=0; $i < count($colComprasEstado); $i++){
    $idCompra = $colComprasEstado[$i]->getObjCompra()->getIdCompra();
    $colIdCompra[] = $idCompra;
    echo "Las compras sin finalizar tienen el id: ".$idCompra."<br>";
}
echo "<br><br>colIdCompra";
print_r($colIdCompra);
echo "<br><br>";
// $colIdCompra tiene una colección de IDS de compra sin fecha fin

//-----------------------------------------------------------------------------------

//Creo una colección de arreglos de objetos compraItem que cumplen la conidicón del idcompra
$objAbmCompraItem = new AbmCompraItem();

for($i=0; $i < count($colIdCompra); $i++){

    $param2["idcompra"] = $colIdCompra[$i];
    $colComprasItems = $objAbmCompraItem->buscar($param2);

    echo "La compra sin finalizar con el id: ".$colIdCompra[$i]." tiene los siguientes productos <br>";

    for($j=0; $j < count($colComprasItems); $j++){

        echo $nombreProducto = $colComprasItems[$j]->getObjProducto()->getProNombre(). "<br>";
        
    }
    echo "<br><br>";
}