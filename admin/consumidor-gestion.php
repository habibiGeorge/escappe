<?php
include ('check/login.php');
check_login();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>EscAppe Admin - Gestion CONSUMIDOR</title>
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

                        <h3 class="m-0 font-weight-bold text-primary">Gestiona CONSUMIDORES</h3><br>

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="card mb-4">

                                    <div class="table-responsive p-3">

                                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">

                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre</th>
                                                    <th>Teléfono</th>
                                                    <th>Email</th>
                                                    <th>Registrado</th>
                                                    <th>Actualizado</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                <?php

                                                $sql = "SELECT DISTINCT idConsumidor FROM 
                                            (SELECT DISTINCT idConsumidor FROM reserva WHERE idOfertante = :admid 
                                            UNION SELECT DISTINCT idConsumidor FROM demanda WHERE idOfertante = :admid) t";

                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':admid', $_SESSION['adminid'], PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;

                                                if ($query->rowCount() > 0) {

                                                    foreach ($results as $result) {

                                                        // $idConsumer = $result->idConsumidor;
                                                        $sql3 = "SELECT * FROM consumidor WHERE idConsumidor =:iduser";

                                                        $query3 = $dbh->prepare($sql3);
                                                        $query3->bindParam(':iduser', $result->idConsumidor, PDO::PARAM_STR);
                                                        $query3->execute();
                                                        $results3 = $query3->fetchAll(PDO::FETCH_OBJ);

                                                        if ($query3->rowCount() > 0) {

                                                            foreach ($results3 as $result3) { ?>
                                                                <tr>
                                                                    <td>
                                                                        <?php echo htmlentities($cnt); ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo htmlentities($result3->apenom); ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo htmlentities($result3->telefono); ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo htmlentities($result3->emailConsumidor); ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo htmlentities($result3->fechaRegistro); ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo htmlentities($result3->fechActualizado); ?>
                                                                    </td>
                                                                    <?php
                                                            }
                                                        }
                                                        ?>
                                                            <td>
                                                                <script>
                                                                    function confirmaBorrar(consumidor) {
                                                                        let consu = consumidor;
                                                                        if (window.confirm('¿Seguro que quieres ELIMINAR este CONSUMIDOR?') == true) {
                                                                            window.location = "consumidor-delete-if.php?delid=" + consu;
                                                                        }
                                                                    }
                                                                </script>
                                                                <button type="button" class="btn btn-primary btn-sm btn-danger"
                                                                    onclick="confirmaBorrar(<?php echo $result->idConsumidor; ?>)">Borrar
                                                                </button>
                                                            </td>
                                                        </tr>

                                                        <?php $cnt = $cnt + 1;
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

                <?php } else if ($_SESSION['perfil'] == "sadmin") { ?>

                        <div class="container-fluid" id="container-wrapper">

                            <div class="row">

                                <div class="col-lg-12">

                                    <div class="card mb-4">

                                        <div
                                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h1 class="h3 mb-0 text-gray-800">Gestionar CONSUMIDORES</h1>
                                        </div>

                                        <div class="table-responsive p-3">

                                            <table class="table align-items-center table-flush table-hover" id="dataTableHover">

                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>ApeNom</th>
                                                        <th>Teléfono</th>
                                                        <th>Email</th>
                                                        <th>Registrado</th>
                                                        <th>Actualizado</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    <?php

                                                    $sql = "SELECT DISTINCT * FROM consumidor";

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
                                                                <?php echo htmlentities($result->apenom); ?>
                                                                </td>
                                                                <td>
                                                                <?php echo htmlentities($result->telefono); ?>
                                                                </td>
                                                                <td>
                                                                <?php echo htmlentities($result->emailConsumidor); ?>
                                                                </td>
                                                                <td>
                                                                <?php echo date('d-m-Y', strtotime($result->fechaRegistro)) . "<br/>";
                                                                echo date('H:i', strtotime($result->fechaRegistro)); ?>

                                                                </td>
                                                                <td>
                                                                <?php 
                                                                if ($result->fechActualizada) {
                                                                    echo date('d-m-Y', strtotime($result->fechActualizado)) . "<br/>" . date('H:i', strtotime($result->fechActualizado));;
                                                                } else {
                                                                    echo "- - - ";
                                                                }
                                                                ?>
                                                                </td>

                                                                <td>
                                                                    <script>
                                                                        function confirmaBorrar(consumidor) {
                                                                            let consu = consumidor;
                                                                            if (window.confirm('¿Seguro que quieres ELIMINAR este CONSUMIDOR?') == true) {
                                                                                window.location = "consumidor-delete.php?delid=" + consu;
                                                                            }
                                                                        }
                                                                    </script>
                                                                    <button type="button" class="btn btn-primary btn-sm btn-danger"
                                                                        onclick="confirmaBorrar(<?php echo $result->idConsumidor; ?>)">Borrar
                                                                    </button>
                                                                </td>
                                                            </tr>

                                                        <?php $cnt = $cnt + 1;
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

                <?php } ?>
            </div>

            <?php include ('includes/footer.php'); ?>
        </div>
    </div>

    <?php include ('includes/logout-modal.php'); ?>
    <?php include ('includes/quit-modal.php'); ?>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/personal-admin.min.js"></script>

    <!-- <script src="vendor/datatables/jquery.dataTables.min.js"></script> -->
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