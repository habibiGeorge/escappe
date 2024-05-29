<?php if ($_SESSION['perfil'] == "admin") { ?>

    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon">
                <span>ESCAPPE ADMIN</span>
                <!-- <img src="../admin/images/logo/logo1_300px.png" class="img-responsive"> -->
            </div>
        </a>

        <li class="nav-item active">
            <a class="nav-link" href="dashboard.php">
                <i class="fas fa-fw fa-tachometer-alt"></i><span>Panel de Control</span>
            </a>
        </li>

        <!-- <hr class="sidebar-divider my-2"> -->

        <li class="nav-item">
            <a class="nav-link" href="actividad-nueva.php">
                <i class="fa fa-calendar-plus color-actividad" aria-hidden="true"></i>
                <!-- <i class="fab fa-fw fa-wpforms color-actividad"></i> -->
                <span>Crea ACTIVIDAD</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="actividad-gestion.php">
                <i class="fa fa-calendar color-actividad" aria-hidden="true"></i>
                <span>Gestiona ACTIVIDADES</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="reserva-gestion.php">
                <i class="fa fa-calendar text-primary" aria-hidden="true"></i>
                <span>Gestiona RESERVAS</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="consumidor-gestion.php">
                <i class="fa fa-users color-consumidor" aria-hidden="true"></i>
                <span>Gestiona CONSUMIDORES</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="demanda-gestion.php">
                <i class="fab fa-fw fa-wpforms color-demanda"></i>
                <span>Gestiona DEMANDAS</span>
            </a>
        </li>
    </ul>

<?php } else if ($_SESSION['perfil'] == "sadmin") { ?>

        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon" style="">
                    <span>ESCAPPE S_ADMIN</span>
                    <!-- <img src="images/logo/logo1_300px.png" class="img-responsive"> -->
                </div>
            </a>

            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i><span>Panel de Control</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="actividad-gestion.php">
                    <i class="fa fa-calendar color-actividad" aria-hidden="true"></i><span>Gestiona ACTIVIDADES</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="ofertante-registro.php">
                    <i class="fa fa-users color-ofertante" aria-hidden="true"></i><span>Gestiona OFERTANTES</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="consumidor-gestion.php">
                    <i class="fa fa-users color-consumidor" aria-hidden="true"></i><span>Gestiona CONSUMIDORES</span>
                </a>
            </li>

        </ul>
<?php } ?>