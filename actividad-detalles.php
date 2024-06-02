<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');
include ('admin/check/util.php');

if (isset($_POST['confirmaReserva'])) {

    $aid = intval($_GET['actid']);

    $umail = $_SESSION['entraConsumidor'];

    $fechahora = $_POST['selectFechaHora'];
    $nroPlazasSolicita = $_POST['solicitaPlazas'];
    $comments = $_POST['comentarios'];
    $statusR = 0;

    $sql = "SELECT * FROM actividad WHERE idActividad =:aid";

    $query = $dbh->prepare($sql);
    $query->bindParam(':aid', $aid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $idadmin = $result->idOfertante;
            $plazasocupa = $result->plazasOcupadas;
        }
    }

    $sql2 = "SELECT idConsumidor FROM consumidor WHERE emailConsumidor =:umail";

    $query2 = $dbh->prepare($sql2);
    $query2->bindParam(':umail', $umail, PDO::PARAM_STR);
    $query2->execute();
    $results2 = $query2->fetchAll(PDO::FETCH_OBJ);

    if ($query2->rowCount() > 0) {
        foreach ($results2 as $result2) {
            $iduser = $result2->idConsumidor;
        }
    }

    $sql = "INSERT INTO reserva (fechaHora,nroPlazas,comentarios,estado,
    idActividad,
    idOfertante,
    idConsumidor) 
    VALUES (:fechahora,:nroPlazas,:comments,:statusR,
    :aid,
    :idadmin,
    :iduser)";

    // Ahora creamos una variable llamada query que llame al método prepare() del Objeto 'base de datos'
    // La consulta SQL se introduce como parámetro, y cada marcador de posición se escribe así :placeholder_name
    $query = $dbh->prepare($sql);
    // Ahora le decimos al script con qué variable se refiere realmente cada marcador de posición (placeholder) usando el método bindParam()
    // El primer parámetro es el marcador de posición de la sentencia de arriba; el segundo es la variable a la que se debe referir

    $query->bindParam(':fechahora', $fechahora, PDO::PARAM_STR);
    $query->bindParam(':nroPlazas', $nroPlazasSolicita, PDO::PARAM_STR);
    $query->bindParam(':comments', $comments, PDO::PARAM_STR);

    $query->bindParam(':statusR', $statusR, PDO::PARAM_STR);

    $query->bindParam(':aid', $aid, PDO::PARAM_STR);
    $query->bindParam(':idadmin', $idadmin, PDO::PARAM_STR);
    $query->bindParam(':iduser', $iduser, PDO::PARAM_STR);

    // Ejecuta la consulta con las datos que acabamos de definir
    // El método execute() devuelve TRUE si tiene éxito y FALSE si no, pudiéndole poner tus propios mensajes
    $query->execute();

    $lastInsertId = $dbh->lastInsertId();

    if ($lastInsertId) {
        echo '<script>alert("Reservado correctamente. Gracias")</script>';
    } else {
        echo '<script>alert("Parece que algo no ha ido bien. Prueba otra vez")</script>';
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
    <!-- <link href="css/bootstrap-3.0.0/bootstrap.min.css" rel="stylesheet" /> -->
    <link href="css/bootstrap-3.0.0/bootstrap.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="admin/images/favicon/sole_ico.png" rel="shortcut icon" type="image/x-icon">

</head>

<body>

    <?php include ('includes/header.php'); ?>

    <div id="#top"></div>

    <section id="actividades" class="secPad">

        <div class="container">

            <div class="selectact">

                <div class="container">

                    <?php

                    $aid = intval($_GET['actid']);

                    $sql = "SELECT * FROM actividad WHERE idActividad=:aid";

                    $query = $dbh->prepare($sql);
                    $query->bindParam(':aid', $aid, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    $sql2 = "SELECT idOfertante FROM actividad WHERE idActividad =:idactiv";

                    $query2 = $dbh->prepare($sql2);
                    $query2->bindParam(':idactiv', $aid, PDO::PARAM_STR);
                    $query2->execute();
                    $results2 = $query2->fetchAll(PDO::FETCH_OBJ);

                    if ($query2->rowCount() > 0) {

                        foreach ($results2 as $result2) {

                            $idadmin = $result2->idOfertante;

                            $sql3 = "SELECT * FROM ofertante WHERE idOfertante =:idadmin";

                            $query3 = $dbh->prepare($sql3);
                            $query3->bindParam(':idadmin', $idadmin, PDO::PARAM_STR);
                            $query3->execute();
                            $results3 = $query3->fetchAll(PDO::FETCH_OBJ);

                            if ($query3->rowCount() > 0) {
                                foreach ($results3 as $result3) {
                                    $nombre = $result3->nombre;
                                    $apllidos = $result3->apellidos;
                                }
                            }
                        }
                    }
                    ?>

                    <h1 class="h3 mb-0 text-gray-800">HAZ TU RESERVA PARA :&nbsp;
                        <?php echo "$nombre&nbsp;$apllidos"; ?>
                    </h1><br>

                    <?php
                    if ($query->rowCount() > 0) {

                        foreach ($results as $result) { ?>

                            <div class="selectact_top">

                                <div class="col-md-4 selectact_left wow fadeInLeft animated" data-wow-delay=".5s">
                                    <img src="admin/images/actividad/<?php echo htmlentities($result->imagen); ?>" class="img-responsive"
                                        alt="">
                                </div>

                                <div class="selectact_right wow fadeInRight animated" style="padding-left:1em;"
                                    data-wow-delay=".5s">

                                    <h2>
                                        <?php echo htmlentities($result->nombreActividad); ?>
                                    </h2>

                                    <p>
                                        Actividad #
                                        <?php echo htmlentities($result->idActividad); ?>

                                        <!-- BOOLEAN -->
                                        <?php
                                        if ($result->condicionFisica == 1) {
                                            echo '|&nbsp;<b style="color:#FF6019 !important;">Condición física: Necesaria</b>';
                                        } else {
                                            echo '|&nbsp;<b>Condición física:</b>&nbsp;No necesaria';
                                        }
                                        ?>
                                    </p>

                                    <br>

                                    <div class="row">

                                        <div class="form-group col-md-4">

                                            <p><b>Categoría:</b>
                                                <?php echo htmlentities($result->categoria); ?>
                                            </p>

                                            <p><b>Localización:</b>
                                                <?php echo htmlentities($result->localizacion); ?>
                                            </p>

                                            <!-- BOOLEAN -->
                                            <p><b>Transporte:</b>
                                                <?php
                                                if ($result->transporte == 1) {
                                                    echo ("<b>NECESARIO</b>");
                                                } else {
                                                    echo htmlentities("NO NECESARIO");
                                                }
                                                ?>
                                            </p>

                                            <p><b>Precio:</b>
                                                <?php echo htmlentities($result->tarifa); ?>&nbsp;EUR
                                            </p>

                                            <p><b>Material necesario:</b>
                                                <?php echo htmlentities($result->materialNecesario); ?>
                                            </p>

                                            <!-- BOOLEAN -->
                                            <p><b>Material ofrecido:</b>
                                                <?php
                                                if ($result->materialOfrecido == 1) {
                                                    echo 'SÍ';
                                                } else {
                                                    echo '<b>NO</b>';
                                                }
                                                ?>
                                            </p>

                                            <!-- PLUS MATERIAL -->
                                            <p>
                                                <?php
                                                if ($result->materialOfrecido == 1 && $result->plusMaterial == 0) {
                                                    echo 'Plus Material:&nbsp;GRATIS';
                                                } else if ($result->materialOfrecido == 1 && $result->plusMaterial != 0) {
                                                    echo 'Plus Material:&nbsp;' . $result->plusMaterial . '&nbsp;EUR';
                                                } else {
                                                    echo '';
                                                }
                                                ?>
                                            </p>


                                        </div>

                                        <div class="form-group col-md-4">

                                            <p><b>Fecha/s | Hora</b><br>

                                                <?php

                                                $fechaHora = explode(",", $result->fechasHora, -1);

                                                $plazas = explode(",", $result->plazasOcupadas, -1);

                                                foreach ($fechaHora as $index => $fh) {

                                                    if ($fh) {
                                                        echo date('d-m-Y |', strtotime($fh));
                                                        echo date('H:i', strtotime($fh)) . " | Plazas libres: " . $result->maxPlazas - $plazas[$index] . "<br/>";
                                                    }
                                                }
                                                ?>

                                            </p>

                                            <p><b>Duración:</b>
                                                <?php echo htmlentities($result->duracion); ?> hora/s
                                            </p>

                                            <p><b>Plazas Máx.:</b>
                                                <?php echo htmlentities($result->maxPlazas); ?>
                                            </p>

                                            <p><b>Plazas Mín.:</b>
                                                <?php echo htmlentities($result->minPlazas); ?>
                                            </p>
                                        </div>

                                    </div>

                                    <p><b>Caracteríticas:</b>
                                        <?php echo htmlentities($result->caracteristicas); ?>
                                    </p>

                                    <p><b>Detalles:</b>
                                        <?php echo htmlentities($result->detalles); ?>
                                    </p>
                                    <br>
                                    <p class="text-right"><b>Fecha publicada:</b>
                                        <?php echo date("d-m-Y", strtotime($result->fechaPublicada)); ?>
                                    </p>
                                    <p class="text-right"><b>Fecha actualizada:</b>
                                        <?php
                                        if ($result->fechActualizada) {
                                            echo date("d-m-Y", strtotime($result->fechActualizada));
                                        } else {
                                            echo "- - -";
                                        }
                                        ?>
                                    </p>
                                </div>

                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                        <?php
                        }
                    } ?>


                <!-- FORMULARIO INFERIOR -->
                <?php

                if ($_SESSION['entraConsumidor']) {

                    if (isset($_REQUEST['actid'])) {

                        $idactiv = intval($_GET['actid']);

                        $sql2 = "SELECT idOfertante FROM actividad WHERE idActividad =:idactiv";

                        $query2 = $dbh->prepare($sql2);
                        $query2->bindParam(':idactiv', $idactiv, PDO::PARAM_STR);
                        $query2->execute();
                        $results2 = $query2->fetchAll(PDO::FETCH_OBJ);

                        if ($query2->rowCount() > 0) {

                            foreach ($results2 as $result2) {

                                $idadmin = $result2->idOfertante;

                                $sql3 = "SELECT * FROM ofertante WHERE idOfertante =:idadmin";

                                $query3 = $dbh->prepare($sql3);
                                $query3->bindParam(':idadmin', $idadmin, PDO::PARAM_STR);
                                $query3->execute();
                                $results3 = $query3->fetchAll(PDO::FETCH_OBJ);

                                if ($query3->rowCount() > 0) {
                                    foreach ($results3 as $result3) {
                                        $nombre = $result3->nombre;
                                        $apllidos = $result3->apellidos;
                                    }
                                }
                            }
                        }
                    }
                    ?>

                    <div class="container">
                        <div class="selectact_top">
                            <form name="reserva" method="POST">

                                <div class="selectact-info animated wow fadeInUp animated" data-wow-duration="1200ms"
                                    data-wow-delay="500ms"
                                    style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp; margin-top: -3em;">
                                    <!-- margin-top: -70px"> -->

                                    <!-- SELECCION DE FECHAS -->
                                    <div class="ban-bottom">

                                        <div class="col-md-6 mr-2">

                                            <label class="inputLabel">Fecha | Hora</label>

                                            <select name="selectFechaHora" id="selectFechaHoraID"
                                                class="form-control form-fit" required>
                                                <option value="">Selecciona Fecha | Hora</option>

                                                <?php
                                                foreach ($fechaHora as $fh) {

                                                    if ($fh) {
                                                        echo "<option value=" . $fh . ">" . dameFechaEsp($fh) . " | " . date('H:i', strtotime($fh)) . "</option>";
                                                    }

                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <?php

                                        $plazasReservadasString = $result->plazasOcupadas;

                                        $distintosNrosPlazasLibres = explode(",", $plazasReservadasString, -1);

                                        // var_dump($distintosNrosPlazasLibres);
                                    
                                        ?>

                                        <script>

                                            var select = document.getElementById("selectFechaHoraID");

                                            select.addEventListener("change", function () {

                                                var selectedOption = this.options[this.selectedIndex];
                                                // window.alert(selectedOption.index);

                                                var select2 = document.getElementById("solicitaPlazasID");
                                                var noHayPlazasMsg = document.getElementById('noHayPlazasID');
                                                var activaSubmit = document.getElementById('confirmaReservaID');

                                                if (selectedOption.index == 1) {
                                                    select2.disabled = false;
                                                    select2.min = 1;
                                                    select2.max = <?php echo $result->maxPlazas - $distintosNrosPlazasLibres[0]; ?>;
                                                    select2.value = <?php echo $result->maxPlazas - $distintosNrosPlazasLibres[0]; ?>;
                                                    if (select2.max == 0) {
                                                        select2.disabled = true;
                                                        noHayPlazasMsg.innerText = "NO HAY PLAZAS!";
                                                        activaSubmit.disabled = true;
                                                    } else {
                                                        noHayPlazasMsg.innerText = "";
                                                        activaSubmit.disabled = false;
                                                    }
                                                } else if (selectedOption.index == 2) {
                                                    select2.disabled = false;
                                                    select2.min = 1;
                                                    select2.max = <?php echo $result->maxPlazas - $distintosNrosPlazasLibres[1]; ?>;
                                                    select2.value = <?php echo $result->maxPlazas - $distintosNrosPlazasLibres[1]; ?>;
                                                    if (select2.max == 0) {
                                                        select2.disabled = true;
                                                        noHayPlazasMsg.innerText = "NO HAY PLAZAS!";
                                                        activaSubmit.disabled = true;
                                                    } else {
                                                        noHayPlazasMsg.innerText = "";
                                                        activaSubmit.disabled = false;
                                                    }
                                                } else if (selectedOption.index == 3) {
                                                    select2.disabled = false;
                                                    select2.min = 1;
                                                    select2.max = <?php echo $result->maxPlazas - $distintosNrosPlazasLibres[2]; ?>;
                                                    select2.value = <?php echo $result->maxPlazas - $distintosNrosPlazasLibres[2]; ?>;
                                                    if (select2.max == 0) {
                                                        noHayPlazasMsg.innerText = "NO HAY PLAZAS!";
                                                        select2.disabled = true;
                                                        activaSubmit.disabled = true;
                                                    } else {
                                                        noHayPlazasMsg.innerText = "";
                                                        activaSubmit.disabled = false;
                                                    }
                                                } else {
                                                    select2.disabled = true;
                                                    select2.value = "Selecciona el número de reservas deseado";
                                                    noHayPlazasMsg.innerText = "";
                                                    activaSubmit.disabled = true;
                                                }
                                            });



                                        </script>

                                        <div class="col-md-6 mr-2">
                                            <label class="inputLabel">Número de RESERVAS&nbsp;<span id="noHayPlazasID"
                                                    style="color:red"></span></label>
                                            <input type="number" name="solicitaPlazas" id="solicitaPlazasID"
                                                class="form-control" placeholder="Selecciona el número de reservas deseado"
                                                required disabled>
                                        </div>

                                        <ul>
                                            <li class="spe">
                                                <label class="inputLabel">Comentarios</label>
                                                <textarea name="comentarios" class="form-control" rows="4" cols="4"
                                                    type="text"></textarea>
                                            </li>
                                        </ul>

                                        <button type="submit" name="confirmaReserva" id="confirmaReservaID"
                                            class="btn-primary btn" disabled>
                                            Confirma tu Reserva
                                        </button>

                                        <a href="demanda-solicitud.php?idadmin=<?php echo htmlentities($idadmin); ?>"
                                            class="view enlace-sencillo">DEMANDA para OFERTANTE :
                                            <?php echo "$nombre&nbsp;$apllidos"; ?>
                                        </a>
                                    </div>
                            </form>
                        </div>
                    </div>

                    <?php
                } else {
                    ?>
                    <div class="selectact-info wow" style="margin-top: -3em; margin-left: 1em;">
                        <ul>
                            <li>
                                <a href="#" data-toggle="modal" data-target="#consumidorLoginID"
                                    class="btn-primary btn">Entra para Reservar o Solicitar</a>
                            </li>
                        </ul>
                    </div>
                    <?php
                }
                ?>
                <div class="clearfix"></div>
            </div>
        </div>
        </div>
    </section>

    <a href="#top" class="topHome"><i class="fa fa-chevron-up fa-2x"></i></a>

    <?php include ('includes/footer.php'); ?>

    <?php include ('admin/includes/signup.php'); ?>

    <?php include ('includes/signup.php'); ?>
    <?php include ('includes/login.php'); ?>

    <script src="js/jquery-1.8.2/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script src="js/bootstrap-3.0.0/bootstrap.min.js" type="text/javascript"></script>

</body>

</html>