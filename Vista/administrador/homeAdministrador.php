<?php
include_once("../../configuracion.php");
$tituloPagina = "TechnoMate | Administrador";
include_once("../estructura/headSeguro.php");
include_once("../estructura/navSeguro.php");
?>

<div class="contenido-pagina">
    <div class="contenedor-acciones">

        <div class="accion-admin">
            <a data-bs-target="#modalNuevoUsuario" tabindex="-1" data-bs-toggle="modal">
                <img class="imagen-accion" src="../../Archivos/Imagenes/accionAdmin1.png" alt="Crear nuevo usuario">
                <div class="informacion-accion">
                    <p>CREAR NUEVOS USUARIOS</p>
                </div>
            </a>
        </div>

        <div class="accion-admin">
            <a href="listarUsuarios.php">
                <img class="imagen-accion" src="../../Archivos/Imagenes/accionAdmin2.png"
                    alt="Actualizar información de usuario">
                <div class="informacion-accion">
                    <p>ACTUALIZAR INFORMACIÓN DE USUARIOS</p>
                </div>
            </a>
        </div>

        <div class="accion-admin">
            <a href="../administrador/gestionMenu.php">
                <img class="imagen-accion" src="../../Archivos/Imagenes/accionAdmin3.png" alt="Crear nuevo rol">
                <div class="informacion-accion">
                    <p>CREAR NUEVOS ROLES E ÍTEMS DE MENÚ</p>
                </div>
            </a>
        </div>
    </div>
</div>

<?php
include_once("../estructura/footer.php");
?>