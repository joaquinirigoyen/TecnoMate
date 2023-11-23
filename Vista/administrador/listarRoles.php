<?php
include_once("../../configuracion.php");

$tituloPagina = "TechnoMate | Administrador";
include_once '../estructura/headSeguro.php';
include_once '../estructura/navSeguro.php';


/* $objSesion = new Session();

if ($objSesion->validar()){
    if($_SESSION['rol'] == 1){
        include_once '../estructura/secciones/nav-bar-2.php';
    } else {
        header('Location: home.php');
    }
} else {
    header('Location: home.php');
} */

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
        echo "<tr>
        <td>".$rol->getIdRol()."</td>
        <td>".$rol-> getRolDescripcion()."</td>
        <td><button class='btn text-white btn-dark'  href='formModificarRol.php?idusuario= ".$rol->getIdRol()."'>modificar</a></button>
        </td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "<h4>No hay Role cargados en la Base de Datos";
}

?>

    <a href="./gestionMenu.php"><input type="submit" value="Volver" class="btn btn-warning">
        </input></a>
</div>
</div>

<?php
include_once '../estructura/footer.php';
?>