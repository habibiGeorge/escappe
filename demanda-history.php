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

                // $a=explode("/",$fdate);
                // $val=array_reverse($a);
                // $mydate =implode("/",$val);
                $cdate = date('Y/m/d');
                $date1 = date_create("$cdate");//fecha actual
                $date2 = date_create("$fdate");//fecha de la cancelación
                $diff = date_diff($date1, $date2);
                $df = $diff->format("%a");
                // echo "<script>alert($df)</script>";

                if ($df > 1) {
                    $status = 2;
                    $cancelby = "usuario";
                    $sql = "UPDATE demanda SET estado =:status, canceladaPor=:cancelby WHERE idConsumidor=:idconsum AND idReserva=:bid";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':bid', $bid, PDO::PARAM_STR);
                    $query->bindParam(':idconsum', $idConsum, PDO::PARAM_STR);
                    $query->bindParam(':status', $status, PDO::PARAM_STR);
                    $query->bindParam(':cancelby', $cancelby, PDO::PARAM_STR);
                    $query->execute();
                    $msg = "Demanda cancelada correctamente";
                } else {
                    $error = "No puedes cancelar hasta 24 horas después de la fecha de realización";
                }
            }
        }
    }

    if (isset($_GET['deliddemanda'])) {

        $dltbkid = intval($_GET['deliddemanda']);

        $sql = "DELETE FROM demanda WHERE idDemanda = :delbkid";

        $query = $dbh->prepare($sql);
        $query->bindParam(':delbkid', $dltbkid, PDO::PARAM_STR);
        $query->execute();

        if ($query->execute()) {
            echo "<script>alert('Demanda Eliminada');</script>";
            echo "<script>window.location.href = 'demanda-history.php'</script>";
        } else {
            echo '<script>alert("ERROR al eliminar Demanda")</script>';
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
                            DEMANDAS
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
                                <th>Categoría</th>
                                <th>Ubicación</th>
                                <th>Descripción</th>
                                <th>Material necesario</th>
                                <th>Fecha | Hora</th>
                                <th>Duración Hora/s</th>
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

                            $sql = "SELECT * FROM demanda WHERE idConsumidor=:idConsumer";

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
                                        <td>
                                            <?php echo htmlentities($result->nombreActividad); ?>
                                        </td>
                                        <td>
                                            <?php echo htmlentities($result->categoria); ?>
                                        </td>
                                        <td>
                                            <?php echo htmlentities($result->ubicacion); ?>
                                        </td>
                                        <td>
                                            <?php echo htmlentities($result->descripcion); ?>
                                        </td>
                                        <td>
                                            <?php echo htmlentities($result->materialNecesario); ?>
                                        </td>
                                        <td>
                                            <?php echo htmlentities(date("d-m-Y H:i", strtotime($result->fechaHora))); ?>
                                        </td>
                                        <td>
                                            <?php echo htmlentities($result->duracion); ?>
                                        </td>
                                        <!-- Fecha de solicitud de la Demanda -->
                                        <td>
                                            <?php echo date("d-m-Y", strtotime($result->fechaRealizada))."<br/>".date("H:i", strtotime($result->fechaRealizada)); ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-info"
                                                onclick="location.href='demanda-update.php?upiddemanda=<?php echo htmlentities($result->idDemanda); ?>'">Actualizar
                                            </button>
                                            <br>
                                            <a class="btn btn-danger" href="demanda-history.php?deliddemanda=<?php echo htmlentities($result->idDemanda); ?>"
                                            role="button" onclick="return confirm('Realmente quieres ELIMINAR tu Reserva?')">Eliminar</a>
                                        </td>
                                    </tr>

                                    <?php $cnt = $cnt + 1;
                                }
                            } ?>
                        </table>

                    </div>
                </div>
            </div>
        </section>
        
        <?php include ('includes/footer.php'); ?>
        
        <?php include ('includes/signup.php'); ?>
        <?php include ('includes/login.php'); ?>
        
        <a href="#top" class="topHome"><i class="fa fa-chevron-up fa-2x"></i></a>

        <script src="js/jquery-1.8.2/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="js/bootstrap-3.0.0/bootstrap.min.js" type="text/javascript"></script>
    </body>

    </html>
    <?php
} ?>