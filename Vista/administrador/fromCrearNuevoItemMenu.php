<?php
include_once("../../configuracion.php");
include_once '../../Control/AbmMenu.php';
include_once '../../Modelo/Conector/BaseDatos.php';
include_once ('../estructura/secciones/nav-bar-2.php');


/* $idM = data_submitted();
$objMenu = new AbmMenu();//el id menu tiene autoincrement
$menu = $objMenu->buscar($idM);

$tituloPagina = "TechnoMate | Administrador";
include_once '../estructura/secciones/head.php';

$objSesion = new Session();

$deshabilitado = 'null';
if($menu[0]->getMeDeshabilitado() != NULL){
    $deshabilitado = $menu[0]->getMeDeshabilitado();
} */



?>
<div class="contenedor-centrado" style="padding: 50px;">
    <form name="actualizarMenu" id="actualizarMenu" method="POST" action="Accion/crearNuevoItemMenu.php"
        class="needs-validation" novalidate>
        <h3>Ingrese el nuevo Item Menu</h3>
        <br>

      <!--   <div class="contenedor-dato">
            <label for="idmenu" class="form-label">ID Menu</label>
            <input type="text" name="idmenu" id="idmenu" class="form-control" readonly></input>
        </div>
        <br> -->

        <div class="contenedor-dato">
            <label for="menombre" class="form-label">Nombre</label>
            <input type="text" name="menombre" id="menombre" class="form-control"></input>
        </div>
        <br>

        <div class="contenedor-dato">
            <label for="medescripcion" class="form-label">Descripcion</label>
            <input type="text" name="medescripcion" id="medescripcion" class="form-control"></input>
        </div>
        <br>

        <div class="contenedor-dato">
            <label for="idpadre" class="form-label">Menu Padre(Null si no lo tiene)</label>
            <input type="text" name="idpadre" id="idpadre" class="form-control"></input>
        </div>
        <br>
        <div class="contenedor-dato">
            <label for="medeshabilitado" class="form-label">Desabhilitado(Colocar el formato de la fecha)</label>
            <input type="text" name="medeshabilitado" id="medeshabilitado" class="form-control"></input>
        </div>
        <br>
        <div class="modal-footer">
                <div class="d-grid gap-2 col-6 mx-auto">
                    <div class="d-grid mb-3 gap-2">
                        <button type="submit" id="realizarCambios" class="btn text-white  btn-dark">REALIZAR CAMBIOS</button>
                    </div>
                </div>
            </div>
    </form>
</div>

<?php
include_once '../estructura/secciones/footer.php';
?>