<?php 
include_once "../../../configuracion.php"; 
$tituloPagina = "TechnoMate | Inicio";
$objAbmcompra = new AbmCompra();
$listacompra = $objAbmcompra->buscar(null);
if(count($listacompra)>0){
  ?>
  <table class="table table-light table-striped text-center table-hover" cellspacing="0" width="100%">
    <thead>
      <tr>
          <th scope="col">ID Compra</th>
          <th scope="col">ID Compra Estado</th>
          <th scope="col">Fecha Incio</th>
          <th scope="col">Fecha Fin</th>
          <th scope="col">Estado De La Compra</th>
          <th scope="col">ID Estado</th>
          <th scope="col">Nombre Usuario</th>
          <th scope="col">Id Usuario</th>
          <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php
        foreach ($listacompra as $objCompra) {                         
          $idcompra=$objCompra->getIdCompra();
          $param["idcompra"] = $idcompra;

          $objCompraEstado= new AbmCompraEstado();
          $estado=$objCompraEstado->buscar($param);
          $ultimo = count($estado);

          if($ultimo > 0){
            $estadoCompra=$estado[$ultimo -1]->getObjCompraEstadoTipo()->getDescripcion();
            $idEstadoCompra = $estado[$ultimo -1]->getObjCompraEstadoTipo()->getIdCompraEstadoTipo();
            $idcompraestado=$estado[$ultimo -1]->getIdCompraEstado();
            $idusuarioc=$estado[0]->getObjCompra()->getObjUsuario()->getIdUsuario();
            $usnombre=$estado[0]->getObjCompra()->getObjUsuario()->getUsNombre();
            $fechaInicio = $estado[$ultimo -1]->getCeFechaIni();
            $fechaFin = $estado[$ultimo -1]->getCeFechaFin();
            // if ($estado[0]->getCeFechaFin() != NULL){
            //   $fechaFin = $estado[0]->getCeFechaFin();
            // }
            echo '<tr>
                <th scope="row">'.$idcompra.'</th>';
                echo '<td>'.$idcompraestado.'</td>';
                echo '<td>'.$fechaInicio.'</td>';
                echo '<td>'.$fechaFin.'</td>';
                echo '<td>'.$estadoCompra.'</td>';
                echo '<td>'.$idEstadoCompra.'</td>';
                echo '<td>'.$usnombre.'</td>';
                echo '<td>'.$idusuarioc.'</td>';
                echo '<td>'?><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick=" cargarCompra(<?php echo  $idcompra?>,<?php echo  $idcompraestado?>,<?php echo  $idusuarioc?>,<?php echo $idEstadoCompra?>);">Revisar</button> 
                <?php 
                echo'</td>';
            echo'</tr>';
          }
        }
        //fin foreach
    echo '</tbody>
  </table>';
}
else{
    echo "<h3>No tiene compras registradas </h3>";
}
      ?>
<!-- Button trigger modal -->

<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Compra </h5>
          <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="listarCompras();"></button> -->
      </div>
      <div class="modal-body">
        <section class="shopping-cart dark">
          <div class="container">
            <div id="contenido"class="content">
    
            </div>
        </section>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="listarCompras();">Cerrar</button>
      </div>
    </div>
  </div>
</div>