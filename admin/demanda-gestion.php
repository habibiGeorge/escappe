<?php
include ('includes/dbconnection.php');
include ('check/login.php');
check_login();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>EscAppe Admin - Gestion DEMANDAS</title>
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
    <link href="images/favicon/sole_ico.png" rel="shortcut icon" type="image/x-icon">
</head>

<body id="page-top">

    <div id="wrapper">

        <?php include ('includes/sidebar.php'); ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include ('includes/header.php'); ?>

                <div class="container-fluid" id="container-wrapper">

                    <h3 class="m-0 font-weight-bold text-primary">Gestiona DEMANDAS recibidas</h3><br>

                    <div class="row">

                        <div class="col-lg-12">

                            <div class="card mb-4">

                                <div class="table-responsive p-3">

                                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">

                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Actividad</th>
                                                <th>Categoría</th>
                                                <th>Ubicación</th>
                                                <th>Descripción</th>
                                                <th>Material Necesario</th>
                                                <th>Fecha Hora</th>
                                                <th>Del Consumidor</th>
                                                <th>Email Consumer</th>
                                                <th>Teléfono Consumer</th>
                                                <th>Realizada</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php

                                            $sql = "SELECT * FROM demanda WHERE idOfertante =:idadmin";

                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':idadmin', $_SESSION['adminid'], PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;

                                            if ($query->rowCount() > 0) {

                                                foreach ($results as $result) { ?>

                                                    <tr>
                                                        <!-- Número de Demanda -->
                                                        <td>
                                                            <?php echo htmlentities($cnt); ?>
                                                        </td>
                                                        <!-- Nombre de la Actividad -->
                                                        <td>
                                                            <?php echo htmlentities($result->nombreActividad); ?>
                                                        </td>
                                                        <!-- Categoría de la Actividad -->
                                                        <td>
                                                            <?php echo htmlentities($result->categoria); ?>
                                                        </td>
                                                        <!-- Ubicación de la Actividad -->
                                                        <td>
                                                            <?php echo htmlentities($result->ubicacion); ?>
                                                        </td>
                                                        <!-- Descripción de la Actividad -->
                                                        <td>
                                                            <?php echo htmlentities($result->descripcion); ?>
                                                        </td>
                                                        <!-- Material necesario de la Actividad -->
                                                        <td>
                                                            <?php echo htmlentities($result->materialNecesario); ?>
                                                        </td>
                                                        <!-- Fechas de la Actividad -->
                                                        <td>
                                                            <?php echo date('d-m-Y', strtotime($result->fechaHora)) . "<br/>" . date('H:i', strtotime($result->fechaHora)); ?>
                                                        </td>

                                                        <?php

                                                        $sql2 = "SELECT * FROM consumidor WHERE idConsumidor = :idconsumer";

                                                        $query2 = $dbh->prepare($sql2);
                                                        $query2->bindParam(':idconsumer', $result->idConsumidor, PDO::PARAM_STR);
                                                        $query2->execute();
                                                        $results2 = $query2->fetchAll(PDO::FETCH_OBJ);

                                                        if ($query2->rowCount() > 0) {
                                                            foreach ($results2 as $result2) {
                                                                ?>
                                                                <!-- Nombre y apellidos del Consumidor -->
                                                                <td>
                                                                    <?php
                                                                    echo htmlentities($result2->apenom);
                                                                    ?>
                                                                </td>
                                                                <!-- Email del Consumidor -->
                                                                <td>
                                                                    <?php
                                                                    echo htmlentities($result2->emailConsumidor);
                                                                    ?>
                                                                </td>
                                                                <!-- Teléfono del Consumidor -->
                                                                <td>
                                                                    <?php
                                                                    echo htmlentities($result2->telefono);
                                                                    ?>
                                                                </td>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        <!-- Fecha de realización de la Demanda -->
                                                        <td>
                                                            <?php echo date('d-m-Y', strtotime($result->fechaRealizada)) . "<br/>" . date('H:i', strtotime($result->fechaRealizada)); ?>
                                                        </td>

                                                        <td>
                                                            <a class="btn btn-primary btn-sm btn-info" role="button"
                                                                href="demanda-detalle.php?did=<?php echo htmlentities($result->idDemanda); ?>"
                                                                onclick="">Detalles
                                                            </a>
                                                            <a class="btn btn-primary btn-sm btn-danger" role="button"
                                                                href="demanda-delete.php?deldid=<?php echo htmlentities($result->idDemanda); ?>"
                                                                onclick="return confirm('Realmente quieres ELIMINAR esta DEMANDA?')">Borrar
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include ('includes/footer.php'); ?>

        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <?php include ('includes/logout-modal.php'); ?>
    <?php include ('includes/quit-modal.php'); ?>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- <script src="vendor/datatables/jquery.dataTables.min.js"></script> -->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/personal-admin.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
            $('#dataTableHover').DataTable();
        });
    </script>

</body>

</html>