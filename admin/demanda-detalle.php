<?php
include ('check/login.php');
check_login();

$aid = intval($_GET['aid']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>EscAppe Admin - Actualizar Actividad</title>
    <meta charset="UTF-8">
    <meta name="author" content="JaviER Fdez.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
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

                    <h3 class="m-0 font-weight-bold text-primary">En datalle DEMANDA</h3><br>

                    <div class="row">

                        <div class="col-lg-12">

                            <?php

                            $did = intval($_GET['did']);

                            $sql = "SELECT * FROM demanda WHERE idDemanda =:did";

                            $query = $dbh->prepare($sql);
                            $query->bindParam(':did', $did, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;

                            if ($query->rowCount() > 0) {

                                foreach ($results as $result) {
                                    ?>

                                    <form class="form-horizontal" name="activityUp" method="POST" enctype="multipart/form-data">

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

                                        <div class="row">

                                            <div class="form-group col-md-6">
                                                <label for="focusedinput" class="col-sm-12 pl-0 pr-0">Nombre de la
                                                    Actividad</label>
                                                <div class="col-sm-12 pl-0 pr-0">
                                                    <input type="text" class="form-control" name="aname" id="anameID"
                                                        placeholder="Cambia el nombre para la Actividad..."
                                                        value="<?php echo htmlentities($result->nombreActividad); ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6" id="categoriaDivID">

                                                <label class="inputLabel">Categoría</label>

                                                <div id="nuevaCategoriaDiv" class="form-group">
                                                    <div class="col-sm-12 pl-0 pr-0">
                                                        <input type="text" class="form-control" name="nuevaCategoria"
                                                            id="nuevaCategoriaID" placeholder="Nueva categoría"
                                                            value="<?php echo $result->categoria ?>" readonly>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="form-group col-md-6">
                                                <label class="col-sm-12 pl-0 pr-0">Material necesario para realizar la
                                                    Actividad</label>
                                                <div class="col-sm-12 pl-0 pr-0">
                                                    <textarea class="form-control" rows="2" cols="50" name="materialNecesario"
                                                        id="materialNecesarioID" placeholder="Será necesario..."
                                                        value="<?php echo htmlentities($result->materialNecesario); ?>"
                                                        readonly></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="focusedinput" class="col-sm-12 pl-0 pr-0">Descripción</label>
                                                <div class="col-sm-12 pl-0 pr-0">
                                                    <textarea class="form-control" rows="3" cols="50" name="afeatures"
                                                        id="afeaturesID"
                                                        placeholder="A destacar..." readonly><?php echo $result->descripcion; ?></textarea>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="form-group col-md-6">
                                                <label for="focusedinput" class="col-sm-12 pl-0 pr-0">Ubicación</label>
                                                <div class="col-sm-12 pl-0 pr-0">
                                                    <input type="text" class="form-control" name="alocation" id="alocationID"
                                                        placeholder="Localización de la Actividad"
                                                        value="<?php echo htmlentities($result->ubicacion); ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">

                                                <label class="col-sm-12 pl-0 pr-0">Fecha | Hora</label>
                                                <input type="datetime-local" value="<?php echo $result->fechaHora; ?>" readonly>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="form-group col-md-6">
                                                <label class="col-sm-12 pl-0 pr-0">Número plazas</label>
                                                <div class="col-sm-12 pl-0 pr-0">
                                                    <input type="number" class="form-control" name="nroPlazas" id="nroPlazasID"
                                                        min="0" value="<?php echo htmlentities($result->nroPlazas); ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-sm-12 pl-0 pr-0">Duración (Hora/s)</label>
                                                <div class="col-sm-12 pl-0 pr-0">
                                                    <input type="number" class="form-control" name="duracion" id="duracionID"
                                                        min="0" placeholder="En horas"
                                                        value="<?php echo htmlentities($result->duracion); ?>" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="focusedinput" class="col-sm-12 control-label">Última
                                                Actualización</label>
                                            <div class="col-sm-4">
                                                <?php if ($result->fechActualizada) {
                                                    echo date('d-m-Y H:i', strtotime($result->fechActualizada));
                                                } else {
                                                    echo "- - - ";
                                                } ?>
                                            </div>
                                        </div>

                                    </form>
                                    <?php
                                }
                            } ?>
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
    <script src="js/personal-admin.min.js"></script>

</body>

</html>