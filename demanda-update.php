<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');

if (strlen($_SESSION['entraConsumidor']) == 0) {
    header('Location:index.php');
} else {

    if (isset($_REQUEST['upiddemanda'])) {

        $iddemanda = $_REQUEST['upiddemanda'];

        if (isset($_POST['demandaUpdate'])) {

            $activity = $_POST['actividad'];

            if (isset($_POST["selectCatName"]) && $_POST["selectCatName"] != "") {
                $acat = $_POST["selectCatName"];
                // echo '<script>alert("COJO DEL SELECT")</script>';
            } else {
                $acat = $_POST["nuevaCategoria"];
                // echo '<script>alert("COJO DEL AREAAA")</script>';
            }

            $descripcion = $_POST['descripcion'];
            $ubicacion = $_POST['ubicacion'];
            $material = $_POST['matNecesario'];
            $fechahora = $_POST['fechaHora'];
            $duracion = $_POST['duracion'];

            $sql = "UPDATE demanda SET nombreActividad=:activity,categoria=:category,descripcion=:descripcion,
            ubicacion=:ubicacion,materialNecesario=:material,
            fechaHora=:fechahora,duracion=:duracion
            WHERE idDemanda=:iddemanda";
            $query = $dbh->prepare($sql);

            $query->bindParam(':activity', $activity, PDO::PARAM_STR);
            $query->bindParam(':category', $acat, PDO::PARAM_STR);
            $query->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $query->bindParam(':ubicacion', $ubicacion, PDO::PARAM_STR);
            $query->bindParam(':material', $material, PDO::PARAM_STR);
            $query->bindParam(':fechahora', $fechahora, PDO::PARAM_STR);
            $query->bindParam(':duracion', $duracion, PDO::PARAM_STR);
            $query->bindParam(':iddemanda', $iddemanda, PDO::PARAM_STR);

            $query->execute();
            $msg = "Demanda actualizada correctamente";
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
                            Demanda
                        </h3>

                        <form name="demandaUp" method="POST">

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
                            $iddemanda = $_REQUEST['upiddemanda'];

                            $sql = "SELECT * FROM demanda WHERE idDemanda =:iddemanda";

                            $query = $dbh->prepare($sql);
                            $query->bindParam(':iddemanda', $iddemanda, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);

                            if ($query->rowCount() > 0) {

                                foreach ($results as $result) { ?>
                                
                                    <p class="form-fit">
                                        <b>Actividad</b>
                                        <input type="text" name="actividad"
                                            value="<?php echo htmlentities($result->nombreActividad); ?>" class="form-control"
                                            id="actividadID" required="">
                                    </p>
                                    
                                    <div class="form-fit" id="categoriaDivID">

                                        <label class="inputLabel">Categoría</label>
                                        <select name="selectCatName" id="selectCatID" class="form-control form-fit">
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
                                                    } else {
                                                        // SI SE SELECCIONA UNA CATEGORIA YA EXISTENTE SE OCULTA EL TEXTAREA
                                                        $('#nuevaCategoriaID').prop('disabled', true);
                                                        $('#nuevaCategoriaID').prop('value', "Ya seleccionada...");
                                                    }
                                                });

                                            </script>

                                        </select>

                                        <div id="nuevaCategoriaDiv" class="form-fit">
                                            <div class="">Categoría actual en tu Demanda:
                                                <input type="text" class="form-control" name="nuevaCategoria" id="nuevaCategoriaID"
                                                    placeholder="Nueva categoría" value="<?php echo htmlentities($result->categoria); ?>">
                                            </div>
                                        </div>

                                    </div>

                            <p class="form-fit">
                                <b>Descripcion:</b>
                                <textarea class="form-control" name="descripcion" id="descripcionID"
                                    value=""><?php echo htmlentities($result->descripcion); ?></textarea>
                            </p>

                            <p class="form-fit">
                                <b>Ubicación:</b>
                                <input type="text" class="form-control" name="ubicacion" id="ubicacionID"
                                    value="<?php echo htmlentities($result->ubicacion); ?>">
                            </p>

                            <p class="form-fit">
                                <b>Fecha | Hora</b>
                                <input type="datetime-local" class="form-control" name="fechaHora" id="fechaHoraID" required=""
                                    min="<?php echo date('Y-m-d') ?>T00:00"
                                    value="<?php echo date("Y-m-d H:i", strtotime($result->fechaHora)); ?>" placeholder="">
                            </p>

                            <p class="form-fit">
                                <b>Duración (Hora/s)</b>
                                <input type="number" class="form-control" name="duracion" id="duracionID" placeholder="En Horas"
                                    step="0.25" min="0" max="8" value="<?php echo htmlentities($result->duracion); ?>">
                            </p>

                            <p class="form-fit">
                                <b>Material necesario</b>
                                <textarea class="form-control" cols="" rows="3" name="matNecesario" id="matNecesarioID"
                                    value="<?php echo htmlentities($result->materialNecesario); ?>"></textarea>
                            </p>

                            <p class="form-fit">
                                <b>Fecha realizada:</b>
                                <?php echo date('d-m-Y H:i',strtotime($result->fechaRealizada)); ?>
                            </p>

                            <p class="form-fit">
                                <b>Fecha actualizada:</b>
                                <?php echo date('d-m-Y H:i',strtotime($result->fechActualizada)); ?>
                            </p>
                            <?php
                                }
                            } ?>

                    <p class="form-fit">
                        <button type="submit" name="demandaUpdate" class="btn-primary btn">Update</button>
                    </p>
                    </form>
                    <!-- FIN FORMULARIO submit "reservaUpdate" -->
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