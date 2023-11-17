<?php

class Producto {
    public $idProducto;
    public $prodNombre;
    public $prodDetalle;
    public $prodCantStock;

    public function __construct($idProducto, $prodNombre, $prodDetalle, $prodCantStock) {
        $this->idProducto = $idProducto;
        $this->prodNombre = $prodNombre;
        $this->prodDetalle = $prodDetalle;
        $this->prodCantStock = $prodCantStock;
    }

    public function getNombre(){
        return $this->prodNombre;
    }
}

class AbmProductoTest {
    public $productos;

    public function __construct() {

    }

    function getProductById($id) {
        foreach ($this->productos as $producto) {
            if ($producto->idProducto === $id) {
                return $producto;
            }
        }
        return null; // Si no se encuentra el producto
    }

    /**
     * @return array
     */
    public function getProductArray($tipoProducto) {
    $arregloRetorno = [];
    $productos = [];
    array_push($productos, new Producto(1, "Mate", "Detalles del producto 1", 20));
    array_push($productos, new Producto(2, "Mate", "Detalles del producto 2", 20));
    array_push($productos, new Producto(3, "Mate", "Detalles del producto 3", 20));
    array_push($productos, new Producto(4, "Mate", "Detalles del producto 4", 20));
    array_push($productos, new Producto(5, "Mate", "Detalles del producto 5", 20));
        foreach ($productos as $producto){
            if ($producto->getNombre() == $tipoProducto){
                array_push($arregloRetorno, $producto);
        }
    }
    print_r($arregloRetorno);
        return $arregloRetorno;
    } 
}
