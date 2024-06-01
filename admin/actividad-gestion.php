<?php
include ('check/login.php');
check_login();

if (isset($_GET['blockid'])) {

    $bid = intval($_GET['blockid']);

    $sql = "UPDATE actividad SET disponible = 0 WHERE idActividad =:bid";

    $query = $dbh->prepare($sql);
    $query->bindParam(':bid', $bid, PDO::PARAM_STR);
    $query->execute();

    echo "<script>window.alert('La Actividad ha sido INHABILITADA');</script>";

}

if (isset($_GET['raid'])) {

    $raid = intval($_GET['raid']);

    $sql = "UPDATE actividad SET disponible = 1 WHERE idActividad =:raid";

    $query = $dbh->prepare($sql);
    $query->bindParam(':raid', $raid, PDO::PARAM_STR);
    $query->execute();

    echo "<script>window.alert('La Actividad ha sido REACTIVADA');</script>";

}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>EscAppe Admin - Gestion ACTIVIDAD</title>
    <meta charset="UTF-8">
    <meta name="author" content="JaviER Fdez.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- <link href="css/personal-admin.min.css" rel="stylesheet"> -->
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

                <?php if ($_SESSION['perfil'] == "admin") { ?>

                    <div class="container-fluid" id="container-wrapper">

                        <h3 class="m-0 font-weight-bold text-primary">Gestiona ACTIVIDADES publicadas</h3><br>

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="card mb-4">

                                    <div class="table-responsive p-3">

                                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">

                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Actividad</th>
                                                    <!-- <th>Categoría</th> -->
                                                    <th>Localización</th>
                                                    <th>Mín. Plazas</th>
                                                    <th>Reservas Confirmadas</th>
                                                    <th>Plazas Libres</th>
                                                    <th>Máx. Plazas</th>
                                                    <th>EUROS</th>
                                                    <!-- <th>Creada</th> -->
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php

                                                $sql = "SELECT * FROM actividad WHERE idOfertante = :idofert";

                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':idofert', $_SESSION['adminid'], PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;

                                                if ($query->rowCount() > 0) {

                                                    foreach ($results as $result) { ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo htmlentities($cnt); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo htmlentities($result->nombreActividad); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo htmlentities($result->localizacion); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo htmlentities($result->minPlazas); ?>
                                                            </td>
                                                            <!-- Reservas Confirmadas -->
                                                            <td>
                                                                <?php
                                                                $fechas = explode(",", $result->fechasHora, -1);
                                                                $plazasComas = explode(",", $result->plazasOcupadas, -1);
                                                                foreach ($fechas as $index => $result2) {
                                                                    echo date('d-m-Y H:i', strtotime($fechas[$index])) . ' <i style="font-size:12px;color:green" class="fas">&#xf101;</i> ' . $plazasComas[$index] . "<br/>";
                                                                }
                                                                ?>
                                                            </td>
                                                            <!-- Plazas Libres -->
                                                            <td>
                                                                <?php
                                                                // $fechas = explode(",", $result->fechasHora,-1);
                                                                // $plazasComas = explode(",", $result->plazasOcupadas,-1);
                                                                foreach ($fechas as $index => $result2) {
                                                                    echo date('H:i', strtotime($fechas[$index])) . "<i style='font-size:12px;color:green' class='fas'>&#xf101;</i>" . $result->maxPlazas - $plazasComas[$index] . "<br/>";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php echo htmlentities($result->maxPlazas); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo htmlentities($result->tarifa); ?>
                                                            </td>
                                                            <td>
                                                                <a class="btn btn-primary btn-sm btn-info"
                                                                    href="actividad-update.php?aid=<?php echo htmlentities($result->idActividad); ?>"
                                                                    role="button">Editar
                                                                </a>

                                                                <?php if ($result->disponible == 1) { ?>
                                                                    <a class="btn btn-primary btn-sm btn-warning" role="button"
                                                                        href="actividad-gestion.php?blockid=<?php echo $result->idActividad; ?>"
                                                                        onclick="return confirm('Realmente quieres INHABILITAR esta Actividad?')">Inhabilitar
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <a class="btn btn-primary btn-sm btn-succes" role="button"
                                                                        href="actividad-gestion.php?raid=<?php echo $result->idActividad; ?>"
                                                                        onclick="return confirm('Realmente quieres REACTIVAR esta Actividad?')">Reactivar
                                                                    </a>
                                                                <?php } ?>

                                                                <a class="btn btn-primary btn-sm btn-danger" role="button"
                                                                    href="actividad-delete.php?delid=<?php echo htmlentities($result->idActividad); ?>"
                                                                    onclick="return confirm('Realmente quieres ELIMINAR esta Actividad?')">Borrar
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $cnt = $cnt + 1;
                                                    }
                                                } ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } else if ($_SESSION['perfil'] == "sadmin") { ?>

                        <div class="container-fluid" id="container-wrapper">

                            <div class="row">

                                <div class="col-lg-12">

                                    <div class="card mb-4">

                                        <div
                                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                                            <h1 class="h3 mb-0 text-gray-800">Gestionar ACTIVIDADES</h1>

                                        </div>

                                        <div class="table-responsive p-3">

                                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">

                                                <thead class="thead-light">

                                                    <tr>
                                                        <th>#</th>
                                                        <th>Actividad</th>
                                                        <th>Categoría</th>
                                                        <th>Localización</th>
                                                        <th>Precio EUR</th>
                                                        <th>Creada</th>
                                                        <th>Acción</th>
                                                    </tr>

                                                </thead>

                                                <tbody>
                                                    <?php

                                                    $idbidder = $_SESSION['adminid'];

                                                    $sql = "SELECT * FROM actividad";

                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $cnt = 1;

                                                    if ($query->rowCount() > 0) {

                                                        foreach ($results as $result) { ?>
                                                            <tr>
                                                                <td>
                                                                <?php echo htmlentities($cnt); ?>
                                                                </td>
                                                                <td>
                                                                <?php echo htmlentities($result->nombreActividad); ?>
                                                                </td>
                                                                <td>
                                                                <?php echo htmlentities($result->categoria); ?>
                                                                </td>
                                                                <td>
                                                                <?php echo htmlentities($result->localizacion); ?>
                                                                </td>
                                                                <td>
                                                                <?php echo htmlentities($result->tarifa); ?>
                                                                </td>
                                                                <td>
                                                                <?php echo date('d-m-Y', strtotime($result->fechaPublicada)) . "<br/>"; ?>
                                                                <?php echo date('H:i', strtotime($result->fechaPublicada)); ?>
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-primary btn-sm btn-info"
                                                                        href="actividad-update.php?aid=<?php echo htmlentities($result->idActividad); ?>"
                                                                        role="button">Editar
                                                                    </a>
                                                                <?php if ($result->disponible == 1) { ?>
                                                                        <a class="btn btn-primary btn-sm btn-warning" role="button"
                                                                            href="actividad-gestion.php?blockid=<?php echo htmlentities($result->idActividad); ?>"
                                                                            onclick="return confirm('Realmente quieres INHABILITAR esta Actividad?')">Inhabilitar
                                                                        </a>
                                                                <?php } else { ?>
                                                                        <a class="btn btn-primary btn-sm btn-succes" role="button"
                                                                            href="actividad-gestion.php?raid=<?php echo htmlentities($result->idActividad); ?>"
                                                                            onclick="return confirm('Realmente quieres REACTIVAR esta Actividad?')">Reactivar
                                                                        </a>
                                                                <?php } ?>

                                                                    <a class="btn btn-primary btn-sm btn-danger" role="button" 
                                                                        href="actividad-delete.php?delid=<?php echo htmlentities($result->idActividad); ?>"
                                                                        onclick="return confirm('Realmente quieres ELIMINAR esta Actividad?')">Borrar
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            $cnt = $cnt + 1;
                                                        }
                                                    } ?>

                                                </tbody>
                                            </table>
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

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <?php include ('includes/logout-modal.php'); ?>
    <?php include ('includes/quit-modal.php'); ?>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/personal-admin.min.js"></script>

    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
            $('#dataTableHover').DataTable();
        });
    </script>

</body>

</html>