<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');
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
    <!-- <link href="css/bootstrap-3.0.0/bootstrap.min.css" rel="stylesheet" /> -->
    <link href="css/bootstrap-3.0.0/bootstrap.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="admin/images/favicon/sole_ico.png" rel="shortcut icon" type="image/x-icon">
</head>

<body>

    <?php include ('includes/header.php'); ?>

    <section id="actividades" class="secPad">

        <div class="container">

            <!-- INICIO DEL BUSCADOR de Actividades -->
            <div id="buscador">
                <form action="" method="GET">
                    <input type="text" name="busqueda" placeholder=" introduce algún campo">
                    <input type="submit" name="busca" value="Buscar" class="btn">
                </form>
            </div>

            <h3>Lista de ACTIVIDADES</h3>

            <?php
            if (isset($_REQUEST['busca'])) {

                $busqueda = $_REQUEST['busqueda'];

                // Búsqueda de cualquier coincidencia con las filas de la tabla Actividad
                $sql = "SELECT * FROM actividad WHERE
                nombreActividad LIKE '%$busqueda%' OR
                categoria LIKE '%$busqueda%' OR
                localizacion LIKE '%$busqueda%' OR
                caracteristicas LIKE '%$busqueda%' OR
                fechasHora LIKE '%$busqueda%' OR
                detalles LIKE '%$busqueda%'";

                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);

                if ($query->rowCount() == 0) {

                    // Búsqueda de coincidencias por el email del Ofertante
                    $sql5 = "SELECT idOfertante FROM ofertante WHERE emailOfertante =:busqueda";

                    $query5 = $dbh->prepare($sql5);
                    $query5->bindParam(':busqueda', $busqueda, PDO::PARAM_STR);
                    $query5->execute();
                    $results5 = $query5->fetchAll(PDO::FETCH_OBJ);

                    if ($query5->rowCount() > 0) {

                        foreach ($results5 as $result) {
                            $idadmin = $result->idOfertante;
                        }
                    }
                    // Búsqueda del email asociado a la id encontrada
                    $sql6 = "SELECT * FROM actividad WHERE idOfertante =:idadmin";

                    $query = $dbh->prepare($sql6);
                    $query->bindParam(':idadmin', $idadmin, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                }

                if ($query->rowCount() == 0) {

                    // Búsqueda de coincidencias por el teléfono del Ofertante
                    $sql5 = "SELECT idOfertante FROM ofertante WHERE telefono =:busqueda OR nombre =:busqueda OR apellidos =:busqueda";

                    $query5 = $dbh->prepare($sql5);
                    $query5->bindParam(':busqueda', $busqueda, PDO::PARAM_STR);
                    $query5->execute();
                    $results5 = $query5->fetchAll(PDO::FETCH_OBJ);

                    if ($query5->rowCount() > 0) {

                        foreach ($results5 as $result) {
                            $idadmin = $result->idOfertante;
                        }
                    }
                    // Búsqueda del teléfono asociado a la id encontrada
                    $sql6 = "SELECT * FROM actividad WHERE idOfertante =:idadmin";

                    $query = $dbh->prepare($sql6);
                    $query->bindParam(':idadmin', $idadmin, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                }

                if ($query->rowCount() == 0) {
                    echo ("<span><br>NO SE HAN ENCONTRADO RESULTADOS</span>");
                }
                // FIN DEL BUSCADOR
            } else {
                // Selección aleatoria de Actividades mostrada si no se solicita ninguna búsqueda
                $sql = "SELECT * FROM actividad WHERE disponible = '1' ORDER BY rand()";

                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
            }

            if ($query->rowCount() > 0) {

                foreach ($results as $result) { ?>

                    <div class="rom-btm">

                        <div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s">
                            <a href="actividad-detalles.php?actid=<?php echo htmlentities($result->idActividad); ?>">
                                <img src="admin/images/actividad/<?php echo htmlentities($result->imagen); ?>"
                                    class="img-responsive">
                            </a>
                        </div>

                        <div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">

                            <a href="actividad-detalles.php?actid=<?php echo htmlentities($result->idActividad); ?>">
                                <h4>Actividad:
                                    <?php echo htmlentities($result->nombreActividad); ?>
                                </h4>
                            </a>

                            <h6>Categoría:
                                <?php echo htmlentities($result->categoria); ?>
                            </h6>

                            <?php
                            $idadmin = $result->idOfertante;

                            $sql2 = "SELECT emailOfertante,telefono FROM ofertante WHERE idOfertante =:idadmin";

                            $query2 = $dbh->prepare($sql2);
                            $query2->bindParam(':idadmin', $idadmin, PDO::PARAM_STR);
                            $query2->execute();
                            $results2 = $query2->fetchAll(PDO::FETCH_OBJ);

                            if ($query2->rowCount() > 0) {
                                foreach ($results2 as $result2) {
                                    $mail = $result2->emailOfertante;
                                    $tlf = $result2->telefono;
                                }
                            }
                            ?>

                            <p><b>Email OFERTANTE:
                                    <?php echo htmlentities($mail) ?>
                                </b></p>
                            <p><b>Teléfono OFERTANTE:
                                    <?php echo htmlentities($tlf) ?>
                                </b></p>

                            <p><b>Localización:</b>
                                <?php echo htmlentities($result->localizacion); ?>
                            </p>
                            <p><b>Características:</b>
                                <?php echo htmlentities($result->caracteristicas); ?>
                            </p>
                        </div>

                        <div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">
                            <h5>PRECIO</h5>
                            <h5>
                                <?php echo htmlentities($result->tarifa); ?>&nbsp;EUR
                            </h5>

                            <a href="actividad-detalles.php?actid=<?php echo htmlentities($result->idActividad); ?>"
                                class="view enlace-sencillo">DETALLES</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <?php
                }
            }
            ?>

            <div class="clearfix"></div>
        </div>

    </section>

    <a href="#top" class="topHome"><i class="fa fa-chevron-up fa-2x"></i></a>

    <?php include ('includes/footer.php'); ?>

    <?php include ('includes/login.php'); ?>
    <?php include ('includes/signup.php'); ?>
    <?php include ('admin/includes/signup.php'); ?>

    <script src="js/jquery-1.8.2/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script src="js/bootstrap-3.0.0/bootstrap.min.js" type="text/javascript"></script>

</body>

</html>