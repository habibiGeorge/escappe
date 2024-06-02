<?php
// session_start();
include ('includes/dbconnection.php');
include ('check/login.php');
check_login();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>EscAPPe - Admin</title>
    <meta charset="UTF-8">
    <meta name="author" content="JaviER Fdez.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/personal-admin.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon/sole_ico.png" type="image/x-icon">
</head>

<body id="page-top">

    <div id="wrapper">

        <?php include ('includes/sidebar.php'); ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include ('includes/header.php'); ?>

                <!-- Perfil ADMIN -->
                <?php if ($_SESSION['perfil'] == "admin") { ?>

                    <div class="container-fluid" id="container-wrapper">

                        <h3 class="m-0 font-weight-bold text-primary">Panel de Control</h3><br>

                        <div class="row">

                            <div class="col-xl-3 col-md-6 mb-4">
                                <a href="actividad-gestion.php" id="dashlink">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                        Total de Actividades Publicadas</div>

                                                    <?php

                                                    $sql3 = "SELECT * FROM actividad WHERE idOfertante =:admid";

                                                    $query3 = $dbh->prepare($sql3);
                                                    $query3->bindParam(':admid', $_SESSION['adminid'], PDO::PARAM_STR);
                                                    $query3->execute();
                                                    $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
                                                    $cuentActividades = $query3->rowCount();
                                                    ?>

                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo htmlentities($cuentActividades); ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-primary color-actividad"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-xl-3 col-md-6 mb-4">
                                <a href="actividad-gestion.php" id="dashlink">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                        Actividades que alcanzan el Máximo de Reservas</div>

                                                    <?php

                                                    $cuentActividadesMax = 0;

                                                    foreach ($results3 as $contenido3) {

                                                        $arrayDePlazas[] = $contenido3->plazasOcupadas;

                                                        foreach ($arrayDePlazas as $contenido2) {
                                                            if (str_contains($contenido2, $contenido3->maxPlazas . ",")) {
                                                                $cuentActividadesMax = $cuentActividadesMax + 1;
                                                            }
                                                        }

                                                    }
                                                    ?>

                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo $cuentActividadesMax; ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-primary color-actividad-max"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-xl-3 col-md-6 mb-4">
                                <a href="actividad-gestion.php" id="dashlink">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                        Actividades con mínimo de Reservas para realizarse</div>

                                                    <?php

                                                    $cuentActividadesMin = 0;

                                                    foreach ($results3 as $contenido3) {

                                                        // $arrayDePlazas2[] = $contenido3->plazasOcupadas;
                                                        $arrayDePlazas2 = explode(",", $contenido3->plazasOcupadas,-1);
                                                        foreach ($arrayDePlazas2 as $index => $contenido4) {
                                                            // if (str_contains($contenido4, $contenido3->minPlazas . ",")) {
                                                            if ($contenido4 >= $contenido3->minPlazas) {
                                                                $cuentActividadesMin = $cuentActividadesMin + 1;
                                                            }
                                                        }

                                                    }
                                                    ?>

                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo htmlentities($cuentActividadesMin); ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-primary color-actividad-min"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-xl-3 col-md-6 mb-4">
                                <a href="reserva-gestion.php" id="dashlink">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                        Total de Reservas recibidas
                                                    </div>

                                                    <?php

                                                    $sql1 = "SELECT idReserva FROM reserva WHERE idOfertante=:admid";

                                                    $query1 = $dbh->prepare($sql1);
                                                    $query1->bindParam(':admid', $_SESSION['adminid'], PDO::PARAM_STR);
                                                    $query1->execute();
                                                    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                                    $cuentaReservas = $query1->rowCount();
                                                    ?>

                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo htmlentities($cuentaReservas); ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fa fa-calendar fa-2x text-primary" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-xl-3 col-md-6 mb-4">
                                <a href="consumidor-gestion.php" id="dashlink">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                        Total de Consumidores distintos a atender
                                                    </div>

                                                    <?php

                                                    $sql = "SELECT DISTINCT idConsumidor FROM reserva WHERE idOfertante = :admid
                                            UNION SELECT DISTINCT idConsumidor FROM demanda WHERE idOfertante = :admid";

                                                    $query = $dbh->prepare($sql);
                                                    $query->bindParam(':admid', $_SESSION['adminid'], PDO::PARAM_STR);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $consumidoresAtender = $query->rowCount();
                                                    ?>

                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?php
                                                        echo htmlentities($consumidoresAtender);
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-users fa-2x text-info color-consumidor"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-xl-3 col-md-6 mb-4">
                                <a href="demanda-gestion.php" id="dashlink">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                        Total de Demandas recibidas
                                                    </div>

                                                    <?php

                                                    $sql1 = "SELECT idDemanda FROM demanda WHERE idOfertante=:admid";

                                                    $query1 = $dbh->prepare($sql1);
                                                    $query1->bindParam(':admid', $_SESSION['adminid'], PDO::PARAM_STR);
                                                    $query1->execute();
                                                    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                                    $cuentaDemandas = $query1->rowCount();
                                                    ?>

                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php echo htmlentities($cuentaDemandas); ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fab fa-fw fa-wpforms fa-2x text-primary color-demanda"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        </a>
                    </div>

                    <!-- Perfil SUPER ADMIN -->
                <?php } else if ($_SESSION['perfil'] == "sadmin") { ?>

                        <div class="container-fluid" id="container-wrapper">

                            <h3 class="h3 mb-0 text-gray-800">Panel de Control</h3><br>

                            <div class="row mb-3">

                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                        TOTAL de ACTIVIDADES Publicadas
                                                    </div>

                                                    <?php

                                                    $sql3 = "SELECT idActividad FROM actividad";

                                                    $query3 = $dbh->prepare($sql3);
                                                    $query3->execute();
                                                    $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
                                                    $cuentActividades = $query3->rowCount();
                                                    ?>

                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <?php echo htmlentities($cuentActividades); ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-calendar fa-2x text-primary color-actividad"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                        Total de OFERTANTES registrados
                                                    </div>

                                                    <?php

                                                    $sql = "SELECT idOfertante FROM ofertante WHERE perfil = 'admin'";

                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $cuentaOfertantes = $query->rowCount();
                                                    ?>

                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?php
                                                        echo htmlentities($cuentaOfertantes);
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-users fa-2x text-info color-ofertante"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                        TOTAL de CONSUMIDORES registrados
                                                    </div>

                                                    <?php

                                                    $sql = "SELECT idConsumidor FROM consumidor";

                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $cuentaConsumidores = $query->rowCount();
                                                    ?>

                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?php
                                                        echo htmlentities($cuentaConsumidores);
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-users fa-2x text-info color-consumidor"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                        Total de USUARIOS con perfil SADMIN
                                                    </div>

                                                    <?php

                                                    $sql = "SELECT idOfertante FROM ofertante WHERE perfil = 'sadmin'";

                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $cuentaOfertantes = $query->rowCount();
                                                    ?>

                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?php
                                                        echo htmlentities($cuentaOfertantes);
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-users fa-2x text-info color-sadmin"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                <?php } ?>
            </div>
            <?php include ('includes/footer.php'); ?>
        </div>
    </div>

    <?php include ('includes/logout-modal.php'); ?>
    <?php include ('includes/quit-modal.php'); ?>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <script src="js/demo/chart-area-demo.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="js/personal-admin.min.js"></script>

</body>

</html>