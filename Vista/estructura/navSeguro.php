
<!-- ____________________________________ NAV BAR 1 ________________________________ -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <div class="mx-auto">
            <img src="../../Archivos/Imagenes/logoBlanco.png" alt="Logo de la empresa" width="110">
        </div>
        <div class="container-fluid">
            <div class="container-fluid d-flex justify-content-center">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-Toggler" aria-controls="navbar-Toggler" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse menuUsuario" id="navbar-Toggler">
                <ul class="navbar-nav d-flex justify-content-center align-items-center">
                <?php

                 for ($i = 0; $i < count($listaMenu); $i++) {
                    if ($listaMenu[$i]->getMeDeshabilitado() == null) {

                        /*lee los datos de los menues cargados*/
                        $ruta = $listaMenu[$i]->getMeDescripcion();
                        $nombre = $listaMenu[$i]->getMeNombre();

                        if ($nombre == 'iconoCarrito') {/*espara que coloque el icono carrito*/
                            $nombre = "<i class='bi bi-cart-plus-fill '></i>";
                        }
                        echo '<li class="nav-item mx-2 flex-grow-1"> <a class="nav-link" aria-current="page" href=' . $ruta . '>' . $nombre . '</a> </li>'; // acomoda los menues en lista
                    }
                }
                    ?>

                    <ul class="nav menuUsuario2">
                        <li class="dropdown row">

                            <a href="#" class="text-white text-decoration-none nav-link nav-item" data-bs-toggle="dropdown">
                                <div>
                                    <span id="nombreUsuarioCuenta"><?php echo $_SESSION['usnombre']?></span>
                                    <i class="bi bi-person-fill fa-3x zoom-icon "></i>
                                    <i class="dropdown-toggle"></i>
                                </div>
                            </a>

                            <ul class=" dropdown-menu dropdown-menu-down">
                                <li><a class="text-black text-decoration-none " href=# data-bs-toggle="modal" data-bs-target="#modalConfiguracion" tabindex="-1">Configuración</a></li>
                                <?php
                                    if (count($_SESSION['colroles']) > 1){
                                        echo "<li><a class='text-black text-decoration-none' href=# data-bs-toggle='modal' data-bs-target='#modalCambiarRol' tabindex='-1'>Cambiar Rol</a></li>";
                                    }
                                ?>
                                
                                <hr class="dropdown-divider">
                                <li><a class="text-black text-decoration-none " href="../opcionesCuenta/cerrarSession.php">Cerrar Sesion</a></li>
                            </ul>
                        </li>
                    </ul>
                </ul>
            </div>
        </div>
    </div>
</nav>
<?php
    include_once("../opcionesCuenta/configuracionCuenta.php");
    if($_SESSION['colroles'] > 1){
        include_once("../opcionesCuenta/cambiarRol.php"); 
    }
?>