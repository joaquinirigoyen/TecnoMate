<?php
include_once("../../configuracion.php");
$tituloPagina = "TechnoMate | Administrador";
include_once("../estructura/headSeguro.php");
include_once("../estructura/navSeguro.php");
?>

<div class="contenido-pagina">
    <div class="contenedor-acciones">

        <div class="accion-admin">
                <img class="imagen-accion" src="../../Archivos/Imagenes/accionAdmin1.png" alt="Crear nuevo usuario">
                <div class="informacion-accion">
                    <p>CREAR NUEVOS USUARIOS</p>
                    <button><a class="btn  text-decoration-none"  data-bs-target="#modalNuevoUsuario" tabindex="-1" data-bs-toggle="modal" >Dar Roles</a> </button>
                </div>
        </div>

        <div class="accion-admin">
                <img class="imagen-accion" src="../../Archivos/Imagenes/accionAdmin2.png"
                    alt="Actualizar información de usuario">
                <div class="informacion-accion">
                    <p class="text-center">ACTUALIZAR INFORMACIÓN DE USUARIOS, <br>
                    ASIGNAR ROLES</p>
                    <button><a class="btn  text-decoration-none" href="listarUsuarios.php">Actualizar</a> </button>
                </div>
        </div>

        <div class="accion-admin">
                <img class="imagen-accion" src="../../Archivos/Imagenes/accionAdmin3.png" alt="Crear nuevo rol">
                <div class="informacion-accion">
                    <p>CREAR NUEVOS ROLES E ÍTEMS DE MENÚ</p>
                    <button><a class="btn  text-decoration-none" href="../administrador/gestionMenu.php">Crear Roles</a> </button>
                </div>
        </div>
    </div>
</div>

<?php
include_once("../estructura/footer.php");
?>