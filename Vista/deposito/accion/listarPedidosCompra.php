<?php
include_once '../../configuracion.php';

// Creo objeto usuario y los listo
$objUsuario = new AbmUsuario();
$colUsuarios = $objUsuario->buscar("");

// Guardo id del primer usuario (Moya) para ver sus compras
$idUsuario = $colUsuarios[0]->getIdUsuario();
$param = ['idusuario' => $idUsuario]; 

// Creo objeto compra y las listo
$objCompra = new AbmCompra();

// Busco las compras vinculadas a Moya
$colCompras = $objCompra->buscar($param);

// Cuento la cantidad de compras que devolvió la búsqueda
$n = count($colCompras);

if ($n >= 1){
    echo "Tiene ".$n." compras.";
} else {
    echo "No tiene ninguna compra.";
}

// Guardo id de la primer compra de Moya
$idCompra = $colCompras[0]->getIdCompra();
$param2 = ['idcompra' => $idCompra];

// Busco la colección de compraItem del idCompra
$objCompraItem = new AbmCompraItem();
$colCompraItem = $objCompraItem->buscar($param2);

$objProducto = new AbmProducto();

for ($i = 0; count($colCompraItem); $i++){

    $param3['idproducto'] = $colCompraItem[$i]->getIdProducto();
    $colProducto = $objProducto->buscar($param3);
    $producto = $colProducto[0]->getProNombre();
    echo "El usuario: ".$colUsuarios[0]->getUsNombre()."En su compra con id: ".$param2." compro un: ".$producto;
}

/* Creo objeto producto y los listo
$objProducto = new AbmProducto();
$colProductos = $objProducto->buscar("");

// Creo objeto compraitem para buscar la compra vinculada a Moya
$objCompraItem = new AbmCompraItem();
$colCompraItem = $objCompraItem->buscar($param);
print_r($colCompraItem);*/

