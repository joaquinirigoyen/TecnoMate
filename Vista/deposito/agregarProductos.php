<!-- Crea un modal con un formulario para agregar productos -->

<div class="modal fade" id="modalNuevoProducto" data-bs-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ingrese los siguientes datos del Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form name="formCrearProducto" id="formCrearProducto" method="POST" class="needs-validation" novalidate>
          
          <div class="contenedor-dato">
          <label for="pronombre" class="form-label">Nombre del producto</label>
            <input type="text" class="form-control" id="pronombre" name="pronombre" requerid>
          </div>
          <br>
          <div class="contenedor-dato">
                <label for="prodetalle" class="form-label">Precio del poducto</label>
                <input type="text" class="form-control" id="prodetalle" name="prodetalle" placeholder="" required>
          </div>
          <br>
          
          <div class="contenedor-dato">
          <label for="procantstock"  class="form-label">Cantidad de Stock</label>
                <input type="number" class="form-control" id="procantstock" name="procantstock" placeholder="" required>
          </div>
          <br>

          <div class="contenedor-dato">
                <label for="tipo" class="form-label">Tipo</label>
                <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Mates/Yerbas/Bombillas/Termos/SETS" required>
          </div>
          <br>
          <div class="contenedor-dato">
          <label for="formFile" class="form-label">Cargar url imagen </label>
          <input class="form-control"   placeholder="data:image/jpeg;base64"  id="imagenproducto"  name="imagenproducto" required>
          </div>
          <div class="d-grid mb-3 gap-2">
          <button  type="submit" class="btn text-white  btn-dark">Cargar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="../js/altaProducto.js"></script>