<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mates</title>
</head>
<body>
    <div class="contenedor-mates">
        <?php
        // PRUEBA 1 ---------------------------------
        // Genero JSON con el ABM <-- FALTA IMPLEMENTAR
        // Prueba
        // $url = 'productos.json'; // Ruta del archivo .json

        // // Obtiene el JSON desde la URL
        // $json = file_get_contents($url);

        // // Decodifica el JSON a un array asociativo de PHP
        // $data = json_decode($json, true);


        // foreach ($data as $producto){
        //     echo "<p>".$producto['prodNombre']."</p>"; 
        // }

        // PRUEBA 2 ----------------------------------
        include_once 'AbmProd.php';
        include_once 'Producto.php';
        include_once 'BaseDatos.php';
        $objProd = new AbmProd();
        $param = ['pronombre' => "Termo"];
        $colProductos = $objProd->buscar($param = ['pronombre' => "Mate", "idproducto" => 123]);

        // $data = json_decode($colProductos, true);
        // echo $data;

          foreach ($colProductos as $producto){
            echo "<p>".$producto->getProDetalle()."</p>"; 
        }


        ?>
</div>
</body>
</html>