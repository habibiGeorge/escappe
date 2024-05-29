<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');

if (strlen($_SESSION['entraConsumidor']) == 0) {

    header('location:index.php');

} else {

    if (isset($_REQUEST['bkid'])) {

        $bid = intval($_GET['bkid']);
        $email = $_SESSION['entraConsumidor'];

        $sql = "SELECT idConsumidor FROM consumidor WHERE emailConsumidor =:email";

        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {

            foreach ($results as $result) {
                $idConsum = $result->idConsumidor;
            }
        }

        $sql = "SELECT fechaRealizada FROM reserva WHERE idConsumidor =:idconsum AND idReserva =:bid";

        $query = $dbh->prepare($sql);
        $query->bindParam(':idconsum', $idConsum, PDO::PARAM_STR);
        $query->bindParam(':bid', $bid, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {

            foreach ($results as $result) {

                $fdate = $result->fechaRealizada;

                $cdate = date('Y/m/d');
                $date1 = date_create("$cdate");// fecha actual
                $date2 = date_create("$fdate");// fecha en que se realizó la Reserva
                $diff = date_diff($date1, $date2);
                $df = $diff->format("%a");

                // Si la diferencia supera las 72 horas (3 días) NO se puede Cancelar
                if ($df < 3) {

                    $status = 2;
                    $cancelby = "usuario";

                    $sql = "UPDATE reserva SET estado =:status, canceladaPor=:cancelby WHERE idConsumidor=:idconsum AND idReserva=:bid";

                    $query = $dbh->prepare($sql);
                    $query->bindParam(':bid', $bid, PDO::PARAM_STR);
                    $query->bindParam(':idconsum', $idConsum, PDO::PARAM_STR);
                    $query->bindParam(':status', $status, PDO::PARAM_STR);
                    $query->bindParam(':cancelby', $cancelby, PDO::PARAM_STR);
                    $query->execute();
                    $msg = "Reserva cancelada correctamente";
                } else {
                    $error = "No puedes CANCELAR pasadas 72 horas desde la realización de la Reserva";
                }
            }
        }
    }

    if (isset($_GET['deletebkid'])) {

        $dltbkid = intval($_GET['deletebkid']);

        $sql = "DELETE FROM reserva WHERE idReserva = :delbkid";

        $query = $dbh->prepare($sql);
        $query->bindParam(':delbkid', $dltbkid, PDO::PARAM_STR);
        $query->execute();

        if ($query->execute()) {
            echo "<script>alert('Reserva Eliminada');</script>";
            echo "<script>window.location.href = 'reserva-history.php'</script>";
        } else {
            echo '<script>alert("ERROR al eliminar Reserva")</script>';
        }
    }


    if (isset($_GET['updatebkid'])) {

        $bid = intval($_GET['updatebkid']);
        $email = $_SESSION['entraConsumidor'];

        $sql = "SELECT idConsumidor FROM consumidor WHERE emailConsumidor =:email";

        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {

            foreach ($results as $result) {
                $idConsum = $result->idConsumidor;
            }
        }

        $sql = "SELECT fechaRealizada FROM reserva WHERE idConsumidor =:idconsum AND idReserva =:bid";

        $query = $dbh->prepare($sql);
        $query->bindParam(':idconsum', $idConsum, PDO::PARAM_STR);
        $query->bindParam(':bid', $bid, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {

            foreach ($results as $result) {

                $fdate = $result->fechaRealizada;

                $cdate = date('Y/m/d');
                $date1 = date_create("$cdate");// fecha actual
                $date2 = date_create("$fdate");// fecha en que se realizó la Reserva
                $diff = date_diff($date1, $date2);
                $df = $diff->format("%a");

                // Si la diferencia supera las 72 horas (3 días) No se puede Actualizar
                if ($df < 3) {
                    echo "<script>window.location.href = 'reserva-update.php?upid=$bid'</script>";
                } else {
                    $error = "No puedes ACTUALIZAR pasadas 72 horas desde la realización de la Reserva";
                }
            }
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <title>EscAppe - Usuario</title>
        <meta charset="UTF-8">
        <meta name="author" content="JaviER Fdez.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link href="css/font-awesome/font-awesome.min.css" rel="stylesheet">

        <!-- <link href="css/animate.css" rel="stylesheet" type="text/css" media="all"> -->
        <link rel="stylesheet" href="css/bootstrap-3.0.0/bootstrap.min.css" />
        <link rel="stylesheet" href="css/styles.css" />
        <link rel="shortcut icon" href="admin/images/favicon/sole_ico.png" type="image/x-icon">
    </head>

    <body>

        <?php include ('includes/header.php'); ?>

        <div id="#top"></div>

        <section id="actividades" class="secPad">

            <div class="container">

                <div class="privacy">

                    <div class="container">

                        <h3 class="wow fadeInDown animated animated" data-wow-delay=".5s"
                            style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">Historial de
                            RESERVAS
                        </h3>

                        <?php
                        if ($error) {
                            ?>
                            <div class="errorWrap" style="color:red">
                                <strong>ERROR</strong>:
                                <?php echo htmlentities($error); ?>
                            </div>
                            <?php
                        } else
                            if ($msg) {
                                ?>
                                <div class="succWrap" style="color:green">
                                    <strong>CORRECTO</strong>:
                                    <?php echo htmlentities($msg); ?>
                                </div>
                                <?php
                            } ?>

                        <table class="table align-items-center table-flush table-hover table-bordered" width="100%">
                            <tr>
                                <th>Nro.</th>
                                <th>Actividad</th>
                                <th>Ofertante MAIL</th>
                                <th>Ofertante TLF</th>
                                <th>Fecha | Hora</th>
                                <th>Sugerencias</th>
                                <th>Estado</th>
                                <th>Realizada</th>
                                <th>Acción</th>
                            </tr>

                            <?php

                            $uemail = $_SESSION['entraConsumidor'];

                            $sql = "SELECT idConsumidor FROM consumidor WHERE emailConsumidor =:uemail";

                            $query = $dbh->prepare($sql);
                            $query->bindParam(':uemail', $_SESSION['entraConsumidor'], PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);

                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) {
                                    $idConsumer = $result->idConsumidor;
                                }
                            }

                            $sql = "SELECT * FROM reserva WHERE idConsumidor=:idConsumer";

                            $query = $dbh->prepare($sql);
                            $query->bindParam(':idConsumer', $idConsumer, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;

                            if ($query->rowCount() > 0) {

                                foreach ($results as $result) {
                                    ?>
                                    <tr>
                                        <!-- Número de Reserva -->
                                        <td>
                                            <?php echo htmlentities($cnt); ?>
                                        </td>

                                        <!-- Nombre de la Actividad -->
                                        <td>
                                            <a
                                                href="actividad-detalles.php?actid=<?php echo htmlentities($result->idActividad); ?>">
                                                <?php
                                                $aid = $result->idActividad;
                                                $sql2 = "SELECT * FROM actividad WHERE idActividad=:aid";
                                                $query2 = $dbh->prepare($sql2);
                                                $query2->bindParam(':aid', $aid, PDO::PARAM_STR);
                                                $query2->execute();
                                                $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
                                                if ($query2->rowCount() > 0) {
                                                    foreach ($results2 as $result2) {
                                                        echo htmlentities($result2->nombreActividad);
                                                    }
                                                }
                                                ?>
                                            </a>
                                        </td>

                                        <!-- Datos del Ofertante -->
                                        <?php
                                        $idofer = $result->idOfertante;

                                        $sql3 = "SELECT * FROM ofertante WHERE idOfertante=:idofer";

                                        $query3 = $dbh->prepare($sql3);
                                        $query3->bindParam(':idofer', $idofer, PDO::PARAM_STR);
                                        $query3->execute();
                                        $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
                                        if ($query3->rowCount() > 0) {
                                            foreach ($results3 as $result3) {
                                                $emailOfert = $result3->emailOfertante;
                                                $tlfnOfert = $result3->telefono;
                                            }
                                        }
                                        ?>
                                        <td>
                                            <?php echo htmlentities($emailOfert); ?>
                                        </td>
                                        <td>
                                            <?php echo htmlentities($tlfnOfert); ?>
                                        </td>

                                        <!-- Fecha Hora -->
                                        <td>
                                            <?php echo date("d-m-Y", strtotime($result->fechaHora)) . "<br/>" . date("H:i", strtotime($result->fechaHora)); ?>
                                        </td>
                                        <td>
                                            <?php echo htmlentities($result->comentarios); ?>
                                        </td>

                                        <!-- Estado de la Reserva -->
                                        <td>
                                            <?php if ($result->estado == 0) {
                                                echo "<span style='color:#ff8000'>Por confirmar</span>";
                                            }
                                            if ($result->estado == 1) {
                                                echo "<span style='color:#00ff00'>Confirmada</span>";
                                            }
                                            if ($result->estado == 2 && $result->canceladaPor == 'usuario') {
                                                echo '<span style="color:#ff0000">Cancelada por CONSUMIDOR</span><br>';
                                                echo date("d-m-Y", strtotime($result->fechActualizada)) . "<br/>" . date("H:i", strtotime($result->fechActualizada));
                                            }
                                            if ($result->estado == 2 && $result->canceladaPor == 'admin') {
                                                echo '<span style="color:#ff0000">Cancelada por OFERTANTE</span><br>';
                                                echo date("d-m-Y", strtotime($result->fechActualizada)) . "<br/>" . date("H:i", strtotime($result->fechActualizada));
                                            }
                                            ?>
                                        </td>

                                        <!-- Fecha de solicitud de la Reserva -->
                                        <td>
                                            <?php echo date("d-m-Y", strtotime($result->fechaRealizada)) . "<br/>" . date("H:i", strtotime($result->fechaRealizada)); ?>
                                        </td>

                                        <!-- Acción si puede realizarse -->
                                        <?php
                                        // Si la Reserva se Cancela (estado = 2)
                                        if ($result->estado == 2) {
                                            ?>
                                            <td>
                                                <a class="btn btn-danger"
                                                    href="reserva-history.php?deletebkid=<?php echo htmlentities($result->idReserva); ?>"
                                                    role="button"
                                                    onclick="return confirm('Realmente quieres ELIMINAR tu Reserva?')">Eliminar</a>
                                            </td>
                                            <?php

                                            // Si la Reserva se Confirma (estado = 1)
                                        } else if ($result->estado == 1) {
                                            ?>
                                                <td>
                                                    <button class="btn btn-info" disabled>Actualizar</button>
                                                    <br>
                                                    <a class="btn btn-warning disabled">Cancelar</a>
                                                </td>

                                            <?php

                                            // Si la Reserva está en espera de confirmación (estado = 0)
                                        } else {
                                            ?>
                                                <td>
                                                    <a class="btn btn-info"
                                                        href="reserva-history.php?updatebkid=<?php echo htmlentities($result->idReserva); ?>"
                                                        role="button">Actualizar</a>
                                                    <br>
                                                    <a class="btn btn-warning"
                                                        href="reserva-history.php?bkid=<?php echo htmlentities($result->idReserva); ?>"
                                                        role="button"
                                                        onclick="return confirm('Realmente quieres CANCELAR tu Reserva?')">Cancelar</a>
                                                </td>
                                        <?php } ?>
                                    </tr>

                                    <?php $cnt = $cnt + 1;
                                }
                            } ?>
                        </table>

                    </div>
                </div>
            </div>
        </section>

        <a href="#top" class="topHome"><i class="fa fa-chevron-up fa-2x"></i></a>

        <?php include ('includes/footer.php'); ?>

        <?php include ('includes/signup.php'); ?>
        <?php include ('includes/login.php'); ?>

        <script src="js/jquery-1.8.2/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="js/bootstrap-3.0.0/bootstrap.min.js" type="text/javascript"></script>
    </body>

    </html>
    <?php
} ?>