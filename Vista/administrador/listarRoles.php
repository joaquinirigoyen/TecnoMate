<?php
include_once("../../configuracion.php");

$tituloPagina = "TechnoMate | Administrador";
include_once '../estructura/headSeguro.php';
include_once '../estructura/navSeguro.php';


$objRol = new AbmRol();
$colRol = $objRol->buscar("");


?>
<div class="contenido-pagina ">

<div class="container p-3">

    <?php
    if (!empty($colRol)){
      
    echo "<h4 class='text-center text-white bg-black p-3' >Listado de roles</h4>";
    echo "<table class='table table-striped table-hover'>";
    echo "<th>#</th>
    <th>Descripcion </th>
    <th>Accion</th>";

    foreach($colRol as $rol){

        $idrol= $rol->getIdRol();
       
        echo "<tr>
        <td>".$idrol."</td>
        <td>".$rol-> getRolDescripcion()."</td>
        <td> <a class='btn text-white btn-dark text-decoration-none' href='editarRol.php?idRol=".$idrol."'>Editar</a>

        </tr>";
    }
    echo "</table>";
} else {
    echo "<h4>No hay Role cargados en la Base de Datos";
}

?>

    <a href="gestionMenu.php"><input type="submit" value="Volver" class="btn btn-warning">
        </input></a>
</div>
</div>

<?php
include_once '../estructura/footer.php';
?>