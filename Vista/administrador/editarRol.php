<?php
include_once("../../configuracion.php");
$tituloPagina = "TechnoMate | Administrador";
include_once '../estructura/headSeguro.php';
include_once '../estructura/navSeguro.php';

$idrol=$_REQUEST['idRol'];
$objRol=new AbmRol();
$param['idrol']=$idrol ;
$rol = $objRol->buscar($param);
?>
<div class="contenido-pagina ">
    
    <div class=" text-center w-50 p-3">
       <h5  id="respuesta"></h5>
    </div>
<div class="container  " >
    <div class="card text-center w-50 mb-3 "> 
            <div class="card-header text-bg-dark mb-3">
                  <h5> Modificar rol</h5>
             </div>
       <div class="card-body">
         <form name="actualizarRol" id="actualizarRol" method="POST" action="Accion/actualizarRol.php" class="needs-validation" novalidate>
                <label for="idrol" class="col-form-label">ID Rol</label>
                  <input type="text" name="idrol" id="idrol" class="form-control  form-control-sm" value="<?php echo  $rol[0]->getIdRol() ?>" readonly></input>
         
                <br>

                 <label for="rodescripcion" class="col-form-label">Descripcion</label>
                  <input type="text" name="rodescripcion" id="rodescripcion" class="form-control form-control-sm" value="<?php echo $rol[0]->getRolDescripcion()  ?>"></input>
    
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