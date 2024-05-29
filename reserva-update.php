<?php
session_start();
error_reporting(0);
include ('admin/check/util.php');
include ('includes/dbconnection.php');

if (strlen($_SESSION['entraConsumidor']) == 0) {
    header('Location:index.php');
} else {

    if (isset($_REQUEST['upid'])) {

        $idreserva = $_REQUEST['upid'];

        if (isset($_POST['reservaUpdate'])) {

            $fechahora = $_POST['fechaHora'];
            $nroPlazas = $_POST['plazasSolicitadas'];
            $comments = $_POST['comentarios'];

            $sql = "UPDATE reserva SET fechaHora=:fechahora,nroPlazas=:nroplazas,comentarios=:comments
            WHERE idReserva=:idreserva";

            $query = $dbh->prepare($sql);
            $query->bindParam(':fechahora', $fechahora, PDO::PARAM_STR);
            $query->bindParam(':nroplazas', $nroPlazas, PDO::PARAM_STR);
            $query->bindParam(':comments', $comments, PDO::PARAM_STR);
            $query->bindParam(':idreserva', $idreserva, PDO::PARAM_STR);
            $query->execute();
            $msg = "Reserva actualizada correctamente";
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
                            style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">Actualiza tu
                            Reserva
                        </h3>

                        <form name="reservaUp" method="POST">

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

                            <?php
                            $idreserva = $_REQUEST['upid'];

                            $sql = "SELECT * FROM reserva WHERE idReserva=:idreserva";

                            $query = $dbh->prepare($sql);
                            $query->bindParam(':idreserva', $idreserva, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);

                            if ($query->rowCount() > 0) {

                                foreach ($results as $result) { ?>
                                    <p class="form-fit">
                                        <b>Actividad</b>
                                        <?php
                                        $aid = $result->idActividad;

                                        $sql2 = "SELECT * FROM actividad WHERE idActividad=:aid";

                                        $query2 = $dbh->prepare($sql2);
                                        $query2->bindParam(':aid', $aid, PDO::PARAM_STR);
                                        $query2->execute();
                                        $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
                                        if ($query2->rowCount() > 0) {
                                            foreach ($results2 as $result2) {
                                                $actividad = $result2->nombreActividad;
                                                $fechasHoras = $result2->fechasHora;
                                            }
                                        }
                                        ?>
                                        <input type="text" name="nombreActividad" value="<?php echo htmlentities($actividad); ?>"
                                            class="form-control" id="nombreActividadID" required="" readonly="true">
                                    </p>
                                    
                                    <p class="form-fit">
                                        <b>Fecha | Hora</b>

                                        <select name="selectFechaHora" id="selectFechaHoraID" class="form-control form-fit"
                                            required>
                                            <option value="">Selecciona Fecha | Hora</option>

                                            <?php
                                            
                                            $fechaHora = explode(",", $fechasHoras);
                                            
                                            foreach ($fechaHora as $fh) {

                                                if ($fh) {
                                                    echo "<option value=" . $fh . ">" . dameFechaEsp($fh) . " | " . date('H:i', strtotime($fh)) . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </p>

                                    <p class="form-fit">
                                        <b>Número de plazas</b>
                                        <input type="number" class="form-control" name="plazasSolicitadas" id="plazasSolicitadasID"
                                            min="1" value="<?php echo $result->nroPlazas; ?>" required="">
                                    </p>

                                    <p class="form-fit">
                                        <b>Comentarios :</b>
                                        <textarea class="form-control" name="comentarios" id="comentariosID"
                                            value=""><?php echo htmlentities($result->comentarios); ?></textarea>
                                    </p>

                                    <p class="form-fit">
                                        <b>Fecha realizada:</b>
                                        <?php echo htmlentities($result->fechaRealizada); ?>
                                    </p>

                                    <p class="form-fit">
                                        <b>Fecha actualizada:</b>
                                        <?php echo htmlentities($result->fechActualizada); ?>
                                    </p>
                                    <?php
                                }
                            } ?>

                            <p class="form-fit">
                                <button type="submit" name="reservaUpdate" class="btn-primary btn">Update</button>
                            </p>
                        </form>

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