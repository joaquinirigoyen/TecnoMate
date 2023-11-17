<?php
// Incluyo clase tcpdf.php de la librería
require_once('../../../Utiles/librerias/tcpdf/tcpdf.php');

// Incluyo clases y ABM (de respaldo)
require_once('../../../Modelo/Conector/BaseDatos.php');
require_once('AbmCompraTest.php');
require_once('CompraTest.php');
require_once('UsuarioTest.php');
require_once('AbmUsuarioTest.php');
require_once('CompraItemTest.php');
require_once('AbmCompraItemTest.php');
require_once('ProductoTest.php');
require_once('AbmProductoTest.php');
require_once('CompraEstadoTest.php');
require_once('AbmCompraEstadoTest.php');
require_once('CompraEstadoTipoTest.php');
require_once('AbmCompraEstadoTipoTest.php');

// ------------------------------ OBTENCIÓN DE DATOS DE LA COMPRA ------------------------------ //

// Obtengo la compra
$objCompra = new AbmCompraTest();
$param = ["idcompra" => 1];
$compra = $objCompra->buscar($param);

// Usuario de la compra
$objUsuario = new AbmUsuarioTest();
$param = ["idusuario" => 2];
$usuario = $objUsuario->buscar($param);

// Obtengo ítems de la compra
$objCompraItem = new AbmCompraItemTest();
$param = ["idcompra" => 3];
$compraItem = $objCompraItem->buscar($param);

// Obtengo productos de la compra
$objProducto = new AbmProductoTest();
$param = ["tipo" => "Mates"];
$productos = $objProducto->buscar($param);

// Chequeo estado de la compra
$objCompraEstadoTipo = new AbmCompraEstadoTipoTest();
$param = ["idcompraestadotipo" => 2];
$compraEstado = $objCompraEstadoTipo->buscar($param);

// ------------------------------ CREACIÓN DEL PDF ------------------------------ //
// Creo un nuevo objeto tcpdf
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', true);

$pdf->setPrintHeader(false); //Deshabilito el header
$pdf->setPrintFooter(false); //Deshabilito el footer

// Creo una pagina
$pdf->AddPage();

// Seteo la fuente en general
$pdf->SetFont('helvetica', '', 18);

// Genero código html como string dentro de la variable $html
$html = "";

// Agrego hojas de estilo al pdf
// $html .= '<style>' . file_get_contents('ruta') . '</style>';

// Mando el formato realizado arriba para que sea escrito dentro del pdf
$pdf->writeHTML($html);

// Mando el documento a un destino dado
$pdf->Output("si" . '_CV.pdf', 'I');