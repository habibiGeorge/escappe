<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');

if (strlen($_SESSION['entraConsumidor']) == 0) {

    header('Location:index.php');

} else {

    $IDbid = intval($_GET['idadmin']);

    $sql = "SELECT idOfertante,nombreUsuario,emailOfertante,nombre,apellidos 
    FROM ofertante 
    WHERE idOfertante =:ID";

    $query = $dbh->prepare($sql);
    $query->bindParam(':ID', $IDbid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $OFERTANTEid = $result->idOfertante;
            $OFERTANTEmail = $result->emailOfertante;
            $OFERTANTElogin = $result->nombreUsuario;
            $NOMBRE = $result->nombre;
            $APLLIDOS = $result->apellidos;
        }
    }

    // ...Del FORMULARIO submit "solicitaDemanda"
    if (isset($_POST['solicitaDemanda'])) {

        $activityName = $_POST['nombreActividad'];

        if (isset($_POST["selectCatNAME"]) && $_POST["selectCatNAME"] != "") {
            $category = $_POST["selectCatNAME"];
            // echo '<script>alert("COJO DEL SELECT")</script>';
        } else {
            $category = $_POST["nuevaCategoria"];
            // echo '<script>alert("COJO DEL AREAAA")</script>';
        }

        $fechahora = $_POST['fechaHora'];
        $nroplazas = $_POST['nroPlazas'];
        $duracion = $_POST['duracion'];
        $description = $_POST['descripcion'];
        $ubication = $_POST['ubicacion'];
        $matNecessary = $_POST['matNecesario'];

        $consumerMail = $_SESSION['entraConsumidor'];

        $sql = "SELECT idConsumidor FROM consumidor WHERE emailConsumidor=:useremail";

        $query = $dbh->prepare($sql);
        $query->bindParam(':useremail', $consumerMail, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            foreach ($results as $result) {
                $consumerID = $result->idConsumidor;
            }
        }

        $sql = "INSERT INTO demanda(nombreActividad,categoria,descripcion,ubicacion,materialNecesario,
        fechaHora,nroPlazas,duracion,
        idOfertante,
        idConsumidor)
        VALUES(:activityName,:catSelect,:descripcion,:ubicacion,:matNecesario,
        :fechahora,:nroplazas,:duracion,
        :ofertanteID,
        :consumidorID)";

        $query = $dbh->prepare($sql);
        $query->bindParam(':activityName', $activityName, PDO::PARAM_STR);
        $query->bindParam(':catSelect', $category, PDO::PARAM_STR);
        $query->bindParam(':descripcion', $description, PDO::PARAM_STR);
        $query->bindParam(':ubicacion', $ubication, PDO::PARAM_STR);
        $query->bindParam(':matNecesario', $matNecessary, PDO::PARAM_STR);

        $query->bindParam(':fechahora', $fechahora, PDO::PARAM_STR);
        $query->bindParam(':nroplazas', $nroplazas, PDO::PARAM_STR);
        $query->bindParam(':duracion', $duracion, PDO::PARAM_STR);

        $query->bindParam(':ofertanteID', $OFERTANTEid, PDO::PARAM_STR);

        $query->bindParam(':consumidorID', $consumerID, PDO::PARAM_STR);

        $query->execute();

        $msg = "Se ha realizado la DEMANDA correctamente";

        $lastInsertId = $dbh->lastInsertId();

        if ($lastInsertId) {
            echo '<script>alert("DEMANDA realizada correctamente")</script>';
        } else {
            echo '<script>alert("Parece que algo no ha salido bien...")</script>';
        }

    } else {
        // echo '<script>alert("NO ENTROOOOOOOOOOO")</script>';
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

        <link rel="stylesheet" href="font/css/font-awesome.min.css">
        <!-- <link rel="stylesheet" href="js/fancybox/jquery.fancybox.css" type="text/css" media="screen" /> -->
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
                            style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">
                            Realiza DEMANDA para el OFERTANTE :
                            <?php echo "$OFERTANTEmail"; ?>

                        </h3>

                        <form name="demandaForm" method="POST">

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

                            <!-- Nombre Actividad -->
                            <div class="form-fit">
                                <label class="inputLabel">Nombre de Actividad</label>
                                <textarea class="form-control" rows="1" cols="4" type="text" name="nombreActividad"
                                    required=""></textarea>
                            </div>

                            <!-- Categoría -->
                            <div class="form-fit" id="categoriaDivID">
                                <label class="inputLabel">Categoría</label>

                                <select name="selectCatNAME" id="selectCatID" class="form-control form-fit">
                                    <option value="">Selecciona / Introduce tú una...</option>
                                    <?php
                                    $sql4 = "SELECT DISTINCT categoria FROM actividad";
                                    $query4 = $dbh->prepare($sql4);
                                    $query4->execute();
                                    $results4 = $query4->fetchAll(PDO::FETCH_OBJ);

                                    if ($query4->rowCount() > 0) {
                                        foreach ($results4 as $key => $result4) {
                                            $categorias = $result4->categoria;
                                            echo "<option value=" . $categorias . ">" . $categorias . "</option>";
                                        }
                                    }
                                    ?>

                                    <script>
                                        const select = document.getElementById('selectCatID');

                                        select.addEventListener('change', function () {

                                            if (this.options[this.selectedIndex].value == "") {
                                                $('#nuevaCategoriaID').prop('disabled', false);
                                                $('#nuevaCategoriaID').prop('required', true);
                                                $('#nuevaCategoriaID').prop('value', "");
                                                // SI SE SELECCIONA UNA CATEGORIA YA EXISTENTE SE OCULTA EL TEXTAREA
                                            } else {
                                                $('#nuevaCategoriaID').prop('disabled', true);
                                                $('#nuevaCategoriaID').prop('value', "...categoría existente seleccionada");
                                            }
                                        });
                                    </script>

                                </select>
                            </div>

                            <!-- Nueva categoría -->
                            <div id="nuevaCategoriaDiv" class="form-fit">
                                <textarea name="nuevaCategoria" id="nuevaCategoriaID" class="form-control" rows="1" cols="4"
                                    type="text" placeholder="Nueva categoría"></textarea>
                            </div>

                            <!-- Fecha Hora -->
                            <div class="form-fit">
                                <label class="inputLabel">Fecha | Hora</label>
                                <input type="datetime-local" class="form-control" min="<?php echo date('Y-m-d') ?>T00:00"
                                    value="<?php echo date('Y-m-d H:i') ?>" name="fechaHora" id="fechaHoraID">
                            </div>
                            
                            <!-- Número de plazas -->
                            <div class="form-fit">
                                <label class="inputLabel">Número de plazas</label>
                                <input type="number" name="nroPlazas" id="nroPlazasID" class="form-control" min="1"
                                    max="20">
                            </div>
                            
                            <!-- Duración -->
                            <div class="form-fit">
                                <label class="inputLabel">Duración</label>
                                <input type="number" class="form-control" name="duracion" id="duracionID"
                                    placeholder="En horas" step="0.5" min="0">
                            </div>

                            <!-- Descripción -->
                            <div class="form-fit">
                                <label class="inputLabel">Descripción</label>
                                <textarea name="descripcion" class="form-control" rows="3" cols="4" type="text"
                                    placeholder= "El ofertante estudiará tus opciones..."></textarea>
                            </div>

                            <!-- Ubicación -->
                            <div class="form-fit">
                                <label class="inputLabel">Ubicación</label>
                                <textarea name="ubicacion" class="form-control" rows="1" cols="4" type="text"></textarea>
                            </div>

                            <!-- Material necesario -->
                            <div class="form-fit">
                                <label class="inputLabel">Material necesario</label>
                                <textarea name="matNecesario" class="form-control" rows="4" cols="4" type="text"></textarea>
                            </div>
                            <br>
                            <button type="submit" name="solicitaDemanda" class="btn-primary btn">Enviar</button>
                        </form>

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