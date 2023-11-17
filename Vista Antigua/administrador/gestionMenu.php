<?php
$tituloPagina = "TechnoMate | Administrador";
include_once '../estructura/secciones/head.php';
include("../estructura/secciones/nav-bar-1.php");
require_once("../../Modelo/Conector/BaseDatos.php");
include_once("../../configuracion.php");

$objMenu = new AbmMenu();
$listMenu = $objMenu->buscar(null);

?>
<script src="../estructura/js/menus.js"></script>
<div class="contenido-pagina">
    <button><i class="bi bi-database-fill-add"></i></button>
    <?php 
    if (count($listMenu)>0){
        echo '<table class="table">
        <thead >
            <tr>  
              <th><strong>IdMenu</strong></th>
              <th><strong>menombre</strong></th>
              <th><strong>medescripcion</strong></th>
              <th><strong>idPadre Nacimiento</strong></th>
              <th><strong>meDesabhilitado</strong></th>
              <th><strong>Acciones</strong></th>
        
            </tr>
        </thead>
        <tbody>';
        foreach($listMenu as $objM){
            $idMenuPadre = 'null';
            $deshabilitado = 'null';
            $idmenu = $objM->getIdMenu();
            if ($objM->getMenuPadre() != NULL){
                $idMenuPadre = $objM->getMenuPadre()->getIdMenu();
            }
            if ($objM->getMeDeshabilitado() != NULL){
                $deshabilitado = $objM->getMeDeshabilitado();
            }
            echo '<tr>';
            echo '<td>'.$idmenu.'</td>';
            echo '<td>'.$objM->getMeNombre().'</td>';
            echo '<td>'.$objM->getMeDescripcion().'</td>';
            echo '<td>'.$idMenuPadre.'</td>';
            echo '<td>'.$deshabilitado.'</td>';
            echo '<td>'.'<button class="btn text-white btn-dark"><a href="formEditarMenu.php?idmenu='.$idmenu.'">Editar</a></button>'.
            '<button class="btn btn-danger" id="borrar" onclick="abrirModal('. $idmenu .')">Borrar</button>'
            .'</td>';
            echo '</tr>'; 
        }
        echo'</tbody>
        </table>';      
    }else{
        echo '<h4>No se han cargado menus.</h4>';  
        }
    ?>
</div>

<!-- Modal -->
<div class="modal fade" id="modalMenu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">
            Seguro que desea realizar un borrado?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>No se borrara permanentemente de la base de datos sino que se le realizara un borrado logico</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" id="aceptar">Entendido</button>
      </div>
    </div>
  </div>
</div>
