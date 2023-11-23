<?php
include_once("../../configuracion.php");
$tituloPagina = "TechnoMate | Administrador";
include_once '../estructura/headSeguro.php';
include_once '../estructura/navSeguro.php';

$idMenu=$_REQUEST['idmenu'];
$objMenu=new AbmMenu();
$param['idmenu']=$idMenu ;
$menu = $objMenu->buscar($param);

$deshabilitado = 'null';
if($menu[0]->getMeDeshabilitado() != NULL){
    $deshabilitado = $menu[0]->getMeDeshabilitado();
}

?>
<div class="contenido-pagina ">
    
    <div class=" text-center w-50 p-3">
       <h5  id="respuesta"></h5>
    </div>
<div class="container  " >
    <div class="card text-center w-50 mb-3 "> 
            <div class="card-header text-bg-dark mb-3">
                  <h5> Ingrese los nuevos datos a modificar</h5>
             </div>
       <div class="card-body">
         <form name="actualizarMenu" id="actualizarMenu" method="POST" action="Accion/actualizarMenu.php" class="needs-validation" novalidate>
                <label for="idmenu" class="col-form-label">ID Menu</label>
                  <input type="text" name="idmenu" id="idmenu" class="form-control  form-control-sm" value="<?php echo  $menu[0]->getIdMenu() ?>" readonly></input>
         
                <br>

                 <label for="menombre" class="col-form-label">Nombre</label>
                  <input type="text" name="menombre" id="menombre" class="form-control form-control-sm" value="<?php echo $menu[0]->getMeNombre()  ?>"></input>
        
             <br>
                 <label for="medescripcion" class="col-form-label">Descripcion</label>
                 <input type="text" name="medescripcion" id="medescripcion" class="form-control form-control-sm" value="<?php echo $menu[0]->getMeDescripcion() ?>"></input>
            
                <br>
                   <label for="idpadre" class="col-form-label">Menu Padre</label>
                   <input type="text" name="idpadre" id="idpadre" class="form-control form-control-sm" value="<?php echo  $menu[0]->getMenuPadre()->getIdMenu()  ?>"></input>
               <br>
                 <label for="medeshabilitado" class="col-form-label">Desabhilitado</label>
                 <input type="text" name="medeshabilitado" id="medeshabilitado" class="form-control" value="<?php echo $deshabilitado ?>"></input>
                <br>
                <div class="card-footer text-body-secondary">
                   <button type="submit" id="realizarCambios" class="btn text-white  btn-dark">REALIZAR CAMBIOS</button>
                </div>  
        </form>
     </div>
  </div>
  </div>
  </div>
<?php
include_once '../estructura/footer.php';
?>