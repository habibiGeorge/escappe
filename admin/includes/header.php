<nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">

    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto">

        <!-- BUSCADOR -->
        <li class="nav-item dropdown no-arrow">

            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <!-- ICONO LUPA -->
                <i class="fas fa-search fa-fw"></i>
            </a>

            <!-- INICIO FORMULARIO BUSCADOR DESPLEGABLE -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-1 small" placeholder="Buscar..."
                            aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- FIN BUSCADOR DESPLEGABLE (Formulario) -->
        </li>
        <!-- FIN BUSCADOR -->

        <!-- Barra de separación -->
        <div class="topbar-divider d-none d-sm-block"></div>

        <li class="nav-item dropdown no-arrow">

            <?php
            // Para mostrar la foto del admin
            $aid = $_SESSION['adminid'];

            $sql = "SELECT * FROM ofertante WHERE idOfertante=:aid";

            $query = $dbh->prepare($sql);
            $query->bindParam(':aid', $aid, PDO::PARAM_STR);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);

            if ($query->rowCount() > 0) {

                foreach ($results as $row) {
                    ?>
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <?php
                        if ($row->foto == "") {
                            ?>
                            <img class="img-profile rounded-circle" src="images/perfil/nobody.jpg" style="max-width: 60px">
                            <?php
                        } else {
                            ?>
                            <img class="img-profile rounded-circle" src="images/perfil/<?php echo $row->foto; ?>"
                                style="max-width: 60px">
                            <?php
                        } ?>

                        <span class="ml-2 d-none d-lg-inline text-white small">
                            <?php echo $row->nombreUsuario; ?>
                        </span>
                    </a>
                    <?php
                }
            } ?>

            <!-- Perfil / Cambiar contraseña / Modal Salir -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                <a class="dropdown-item" href="ofertante-perfil.php">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Editar Perfil
                </a>

                <a class="dropdown-item" href="ofertante-cambia-pass.php">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>Cambia Contraseña
                </a>

                <a class="dropdown-item" href="" data-toggle="modal" data-target="#ofertanteQuitID">
                    <i class="fa fa-user-times mr-2 text-gray-400" aria-hidden="true"></i>Darse de Baja
                </a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="" data-toggle="modal" data-target="#ofertanteLogoutID">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Salir
                </a>
            </div>

        </li>
    </ul>
</nav>