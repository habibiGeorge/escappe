<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');

if (strlen($_SESSION['entraConsumidor']) == 0) {
    header('Location:index.php');
} else {

    if (isset($_POST['perfilUpdate'])) {

        $fullname = $_POST['nombreCompleto'];
        $phoneConsumer = $_POST['telefonoConsumer'];
        $emailConsumer = $_SESSION['entraConsumidor'];

        $sql = "UPDATE consumidor SET apenom=:nombreCompleto,telefono=:telefonoConsumer 
        WHERE emailConsumidor=:emailLogin";

        $query = $dbh->prepare($sql);
        $query->bindParam(':nombreCompleto', $fullname, PDO::PARAM_STR);
        $query->bindParam(':telefonoConsumer', $phoneConsumer, PDO::PARAM_STR);
        $query->bindParam(':emailLogin', $emailConsumer, PDO::PARAM_STR);
        $query->execute();
        $msg = "Perfil actualizado correctamente";
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

            <!-- <div class="container"> -->

            <div class="privacy">

                <div class="container">

                    <h3 class="wow fadeInDown animated animated" data-wow-delay=".5s"
                        style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">Actualiza tu
                        perfil
                    </h3>

                    <form name="perfilUp" method="POST">
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

                        $consumeremail = $_SESSION['entraConsumidor'];

                        $sql = "SELECT * FROM consumidor WHERE emailConsumidor=:emailconsumer";

                        $query = $dbh->prepare($sql);
                        $query->bindParam(':emailconsumer', $consumeremail, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {
                                ?>
                                <p class="form-fit">
                                    <b>Nombre y apellidos</b>
                                    <input type="text" name="nombreCompleto" id="nombreCompletoID" class="form-control"
                                        value="<?php echo htmlentities($result->apenom); ?>" required="">
                                </p>

                                <p class="form-fit">
                                    <b>Teléfono de contacto</b>
                                    <input type="text" name="telefonoConsumer" id="telefonoConsumerID" class="form-control"
                                        value="<?php echo htmlentities($result->telefono); ?>" maxlength="12" required="">
                                </p>

                                <p class="form-fit">
                                    <b>Email (Login)</b>
                                    <input type="email" name="emailConsumer" id="emailConsumerID" class="form-control"
                                        value="<?php echo htmlentities($result->emailConsumidor); ?>">
                                </p>

                                <p class="form-fit">
                                    <b>Fecha de la última actualización : </b>
                                    <?php if ($result->fechActualizado) {
                                        echo date("d-m-Y H:i", strtotime($result->fechActualizado));
                                    } else {
                                        echo "- - -";
                                    }
                                    ; ?>
                                </p>

                                <p class="form-fit">
                                    <b>Fecha de Registro :</b>
                                    <?php echo date("d-m-Y H:i", strtotime($result->fechaRegistro)); ?>
                                </p>
                                <?php
                            }
                        } ?>

                        <p class="form-fit">
                            <button type="submit" name="perfilUpdate" class="btn-primary btn">Update
                            </button>
                        </p>
                    </form>

                </div>
            </div>
            <!-- </div> -->
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