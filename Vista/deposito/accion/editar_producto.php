<?php
    include_once '../../../configuracion.php';
    $datos = data_submitted();
    $objCompra = new AbmCompra();
    $objEstado = new AbmCompraEstado();
    
    $arayCompra = $objCompra->buscar($datos);//array
    $compra = $arayCompra[0];//objCompra
    
    $param['idcompra'] = $compra->getIdCompra();

?>