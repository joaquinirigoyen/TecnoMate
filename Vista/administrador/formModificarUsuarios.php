<?php
include_once("../../configuracion.php");
$tituloPagina = "TechnoMate | Administrador";
include_once '../estructura/headSeguro.php';
include_once '../estructura/navSeguro.php';

$idUsuario = data_submitted();
$objUsuario = new AbmUsuario();
$usuario = $objUsuario->buscar($idUsuario);

?>

<div class="container" style="padding: 50px;">
<div class=" text-center w-50 p-3">
    <h5 style="text-color: black" id="respuesta"></h5>
</div>
    <form id="actualizarUsuario">
        <h4>Deshabilitar o cambiar datos</h4>
        <br>

        <div class="contenedor-dato">
            <label for="idusuario" class="form-label">ID de usuario</label>
            <input type="text"  id="elusuario" class="form-control" value="<?php echo $usuario[0]->getIdUsuario() ?>" readonly></input>
        </div>
        <br>

        <div class="contenedor-dato">
            <label for="usnombre" class="form-label">Nombre de usuario</label>
            <input type="text"  id="elnombre" class="form-control" value="<?php echo $usuario[0]->getUsNombre() ?>"></input>
        </div>
        <br>

        <div class="contenedor-dato">
            <label for="usmail" class="form-label">Email</label>
            <input type="text"  id="elmail" class="form-control" value="<?php echo $usuario[0]->getUsMail() ?>"></input>
        </div>
        <br>

        <div class="contenedor-dato">
            <label for="uspass" class="form-label">Contraseña</label> <input type="password" id="lapass" class="form-control"></input>
        </div>
        <br>
        <div class="contenedor-dato">
            <label for="uspass" class="form-label"><strong>Eliminar(Si/No)</strong></label>
            <input type="text" id="habilitado" class="form-control"></input>
        </div>
        <br>
        <div  class="d-grid gap-2 col-6 mx-auto">
            <input type="submit" value="Actualizar" class="btn text-white  btn-dark"></input>
        </div>     
    </form>
    <a href="./listarUsuarios.php"><input type="submit" value="Volver a lista" class="btn text- white  btn-warning">
</div>

<?php
include_once '../estructura/footer.php';
?>
<script>

$(document).ready(function(){

    $('#actualizarUsuario').submit(function(e){
        const postDate = {
            id: $('#elusuario').val(),
            nombreUs: $('#elnombre').val(),
            pass: $('#lapass').val(),
            email: $('#elmail').val(),
            borrar: $('#habilitado').val()
        };
          // console.log(postDate);
     $.post('Accion/modificarUsuarios.php', postDate ,function (respuesta){
       // console.log(respuesta);
      // window.location.href='listarUsuarios.php';
       $('#respuesta').html(respuesta);
    
       
       $('#actualizarUsuario').trigger('reset');
     });
      e.preventDefault();
    });

});
</script>