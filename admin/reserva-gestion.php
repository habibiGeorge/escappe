<?php
include ('check/login.php');
check_login();

// Para Cancelar Reserva
if (isset($_REQUEST['bkid'])) {

    $bid = intval($_GET['bkid']);
    $status = 2;
    $cancelby = 'admin';

    $sql = "UPDATE reserva SET estado=:status,canceladaPor=:cancelby WHERE idReserva=:bid";

    $query = $dbh->prepare($sql);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':cancelby', $cancelby, PDO::PARAM_STR);
    $query->bindParam(':bid', $bid, PDO::PARAM_STR);
    $query->execute();

    if ($query->execute()) {
        echo '<script>alert("Reserva CANCELADA satisfactoriamente")</script>';
    } else {
        echo '<script>alert("Algo no ha ido bien...")</script>';
    }
}

// Para Confirmar Reserva
if (isset($_REQUEST['bckid'])) {

    $bcid = intval($_GET['bckid']);
    $status = 1;
    // $cancelby = 'admin';

    $sql0 = "SELECT * FROM reserva WHERE idReserva=:bcid";
    
    $query0 = $dbh->prepare($sql0);
    $query0->bindParam(':bcid', $bcid, PDO::PARAM_STR);
    $query0->execute();
    $results0 = $query0->fetchAll(PDO::FETCH_OBJ);

    if ($query0->rowCount() > 0) {

        foreach ($results0 as $result0) { 
            $plazas =  $result0->nroPlazas;
            $plazas .= ",";
            $idAct = $result0->idActividad;
        }
    }

    $sql1 = "UPDATE actividad SET plazasOcupadas=:plazas WHERE idActividad=:idact";
    
    $query1 = $dbh->prepare($sql1);
    $query1->bindParam(':plazas', $plazas, PDO::PARAM_STR);
    $query1->bindParam(':idact', $idAct, PDO::PARAM_STR);
    $query1->execute();


    $sql = "UPDATE reserva SET estado=:status WHERE idReserva=:bcid";
    
    $query = $dbh->prepare($sql);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':bcid', $bcid, PDO::PARAM_STR);
    $query->execute();
    
    if ($query->execute()) {
        echo '<script>alert("Reserva CONFIRMADA satisfactoriamente")</script>';
    } else {
        echo '<script>alert("Algo ha ido mal...")</script>';
    }

}
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
    <link rel="shortcut icon" href="images/favicon/sole_ico.png" type="image/x-icon">
</head>

<body id="page-top">

    <div id="wrapper">

        <?php include ('includes/sidebar.php'); ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include ('includes/header.php'); ?>

                <div class="container-fluid" id="container-wrapper">

                    <h3 class="m-0 font-weight-bold text-primary">Gestiona RESERVAS recibidas</h3><br>

                    <div class="row">

                        <div class="col-lg-12">

                            <div class="card mb-4">

                                <div class="table-responsive p-3">

                                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">

                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Actividad</th>
                                                <th>Fecha Hora</th>
                                                <th>Plazas solicitadas</th>                                                
                                                <th>Comentarios</th>
                                                <th>Del Consumidor:</th>                                                
                                                <th>Teléfono</th>
                                                <th>Email</th>
                                                <th>Realizada</th>
                                                <th>Estado</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $idadmin = $_SESSION['adminid'];

                                            $sql = "SELECT * FROM reserva WHERE idOfertante =:idadmin";
                                            
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':idadmin', $idadmin, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;

                                            if ($query->rowCount() > 0) {

                                                foreach ($results as $result) {

                                                    $idActivity = $result->idActividad;
                                                    $idConsumer = $result->idConsumidor;

                                                    $sql1 = "SELECT * FROM actividad WHERE idActividad =:idactivity";
                                                    
                                                    $query1 = $dbh->prepare($sql1);
                                                    $query1->bindParam(':idactivity', $idActivity, PDO::PARAM_STR);
                                                    $query1->execute();
                                                    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                                    if ($query1->rowCount() > 0) {
                                                        foreach ($results1 as $result1) {
                                                            $actividadName = $result1->nombreActividad;
                                                        }
                                                    }

                                                    $sql3 = "SELECT * FROM consumidor WHERE idConsumidor =:iduser";
                                                    
                                                    $query3 = $dbh->prepare($sql3);
                                                    $query3->bindParam(':iduser', $idConsumer, PDO::PARAM_STR);
                                                    $query3->execute();
                                                    $results3 = $query3->fetchAll(PDO::FETCH_OBJ);

                                                    if ($query3->rowCount() > 0) {
                                                        foreach ($results3 as $result3) {
                                                            $nombreApllidos = $result3->apenom;
                                                            $tlfn = $result3->telefono;
                                                            $email = $result3->emailConsumidor;
                                                        }
                                                    }

                                                    ?>
                                                    <tr>
                                                        <!-- Nro -->
                                                        <td>
                                                            <?php echo $cnt; ?>
                                                        </td>
                                                        <!-- Nombre de Actividad -->
                                                        <td>
                                                            <?php echo $actividadName; ?>
                                                        </td>
                                                        <!-- Fecha Hora -->
                                                        <td>
                                                            <?php echo date('d-m-Y',strtotime($result->fechaHora))."<br/>".date('H:i',strtotime($result->fechaHora)); ?>
                                                        </td>
                                                        <!-- Nro Reservas -->
                                                        <td>
                                                            <?php echo $result->nroPlazas; ?>
                                                        </td>
                                                        <!-- Comentarios -->
                                                        <td>
                                                            <?php echo htmlentities($result->comentarios); ?>
                                                        </td>
                                                        <!-- Del Consumidor -->
                                                        <td>
                                                            <?php echo $nombreApllidos; ?>
                                                        </td>                                                        
                                                        <!-- Teléfono -->
                                                        <td>
                                                            <?php echo $tlfn; ?>
                                                        </td>
                                                        <!-- Email -->
                                                        <td>
                                                            <?php echo $email; ?>
                                                        </td>
                                                        <!-- Fecha Realizada -->
                                                        <td>
                                                            <?php echo date('d-m-Y',strtotime($result->fechaRealizada))."<br/>".date('H:i',strtotime($result->fechaRealizada)); ?>
                                                        </td>
                                                        
                                                        <td>
                                                            <?php if ($result->estado == 0) {
                                                                echo "<span style='color:#ffa426'><b>Pendiente de confirmar</b></span>";
                                                            }
                                                            if ($result->estado == 1) {
                                                                echo "<span style='color:#00ff00'><b>Confirmada</b></span>";
                                                            }
                                                            if ($result->estado == 2 && $result->canceladaPor == 'admin') {
                                                                echo "<span style='color:#0000ff'>Canceleda por Ofertante </span>" . date('d-m-Y',strtotime($result->fechActualizada))."<br/>".date('H:i',strtotime($result->fechActualizada));
                                                            }
                                                            if ($result->estado == 2 && $result->canceladaPor == 'usuario') {
                                                                echo "<span style='color:#ff0000'>Cancelada por Consumidor </span>" . date('d-m-Y',strtotime($result->fechActualizada))."<br/>".date('H:i',strtotime($result->fechActualizada));

                                                            }
                                                            ?>
                                                        </td>

                                                        <?php if ($result->estado == 2) { ?>
                                                            <td>
                                                                <!-- Cancelada<br> -->
                                                                <button type="button" class="btn btn-danger"
                                                                    onclick="confirmaEliminar()">Borrar
                                                                </button>
                                                            </td>
                                                        <?php } else if ($result->estado == 1) { ?>
                                                                <td>
                                                                    <!-- Confirmada<br> -->
                                                                    <button type="button" class="btn btn-outline-danger"
                                                                        onclick="confirmaEliminar()">Borrar
                                                                    </button>
                                                                </td>
                                                        <?php } else { ?>
                                                                <td>
                                                                    <a class="btn btn-denger" role="button"
                                                                    href="reserva-gestion.php?bkid=<?php echo htmlentities($result->idReserva); ?>"
                                                                    onclick="return confirm('Realmente quieres CANCELAR esta Reserva?')">Cancelar
                                                                    </a>

                                                                    <a class="btn btn-success" role="button"
                                                                    href="reserva-gestion.php?bckid=<?php echo htmlentities($result->idReserva); ?>"
                                                                    onclick="return confirm('Realmente quieres CONFIRMAR esta Reserva?')">Confirmar
                                                                    </a>
                                                                </td>
                                                            <?php
                                                            } ?>

                                                    </tr>
                                                    <?php $cnt = $cnt + 1;
                                                }
                                            } ?>
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

        function confirmaEliminar() {
            if (confirm("Seguro que quieres Eliminar esta Reserva?")) {
                window.location = "reserva-delete.php?delrid=<?php echo $result->idReserva; ?>";
            } else {
                // alert("Pareces indeciso");
                // document.location = "reserva-gestion.php";
            }
        }
    </script>
</body>

</html>