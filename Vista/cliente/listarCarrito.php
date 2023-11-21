<?php
include_once "../../../configuracion.php";


if(isset($_POST['nombre'])){

  $param['idusuario']= $_POST['id'];

  $productos=new AbmProductos();
  $listaProd =  $productos->buscar($param);
}

?>
<div class="container-fluid" style="padding: 50px;">

<?php


echo "<h4>Mi carrito</h4>";
echo "<table class='table table-striped table-hover'>";
echo "<th>Nombre Producto</th>
<th>Precio</th>
<th>Cantidad</th>";

foreach($listaProd  as $producto){
    echo "<tr>
    <td>".$producto->getUsNombre()."</td>
    <td>".$producto->getUsDetalle()."</td>
    <td><button class='btn text-white btn-dark' data-bs-toggle='modal' data-bs-target='#modalModificacion' tabindex='-1'><a style='text-decoration: none;' href='formModificarUsuarios.php?idusuario= ". $usuario->getIdusuario() . "'>Datos</a></button>
    <button class='btn text-white btn-dark' data-bs-toggle='modal' data-bs-target='#modalModificacion' tabindex='-1'><a style='text-decoration: none;' href='formModificarRoles.php?idusuario= ". $usuario->getIdusuario() . "'>Roles</a></button>
    </td>
    </tr>";
}
echo "</table>";
?>

<a href="./homeAdministrador.php"><input type="submit" value="Volver" class="btn text- white btn-dark">
    </input></a>
</div>

<?php
include_once '../estructura/footer.php';
?>