<?php
include ('check/login.php');
check_login();

$aid = intval($_GET['aid']);

if (isset($_POST['actividadUpdate'])) {

    $aname = $_POST['aname'];
    // Para la Categoría:
    if (isset($_POST["selectCatName"]) && $_POST["selectCatName"] != "") {
        $acat = $_POST["selectCatName"];
        // echo '<script>alert("COJO DEL SELECT")</script>';
    } else {
        $acat = $_POST["nuevaCategoria"];
        // echo '<script>alert("COJO DEL AREAAA")</script>';
    }

    $afeatures = $_POST['afeatures'];
    $adetails = $_POST['adetails'];

    $alocation = $_POST['alocation'];
    $aprice = $_POST['aprice'];

    $sql = "SELECT plazasOcupadas FROM actividad WHERE idActividad =:aid";

    $query = $dbh->prepare($sql);
    $query->bindParam(':aid', $aid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $stringPlazas = $result->plazasOcupadas;
        }
    }

    if (isset($_POST['fechaHora0']) && $_POST['fechaHora0'] != "") {
        $fechashora = $_POST['fechaHora0'] . ",";

        if (substr($stringPlazas, 0, 1) == TRUE && substr($stringPlazas, 0, 1) != 0) {
            $plazasocupa = substr($result->plazasOcupadas, 0, 1) . ",";
        } else {
            $plazasocupa = "0,";
        }
    } else {
        $fechashora = "";
    }

    if (isset($_POST['fechaHora1']) && $_POST['fechaHora1'] != "") {
        $fechashora .= $_POST['fechaHora1'] . ",";

        if (substr($stringPlazas, 2, 1) == TRUE && substr($stringPlazas, 2, 1) != 0) {
            $plazasocupa .= substr($result->plazasOcupadas, 2, 1) . ",";
        } else {
            $plazasocupa .= "0,";
        }
    } else {
        $fechashora .= "";
    }

    if (isset($_POST['fechaHora2']) && $_POST['fechaHora2'] != "") {
        $fechashora .= $_POST['fechaHora2'] . ",";

        if (substr($stringPlazas, 4, 1) == TRUE && substr($stringPlazas, 4, 1) != 0) {
            $plazasocupa .= substr($result->plazasOcupadas, 4, 1) . ",";
        } else {
            $plazasocupa .= "0,";
        }
    } else {
        $fechashora .= "";
    }

    $aduration = $_POST['duracion'];

    $amax = $_POST['maxPlazas'];
    $amin = $_POST['minPlazas'];

    if (isset($_POST['materialOfrecido'])) {
        $amatoffer = 1;
    } else {
        $amatoffer = 0;
    }

    $aplus = $_POST['plusMaterial'];

    if (isset($_POST['condicionFisica'])) {
        $aphysical = 1;
    } else {
        $aphysical = 0;
    }

    if (isset($_POST['transporte'])) {
        $atransport = 1;
    } else {
        $atransport = 0;
    }

    $sql = "UPDATE actividad SET nombreActividad=:aname,categoria=:acat,
    caracteristicas=:afeatures,detalles=:adetails,
    localizacion=:alocation,tarifa=:aprice,
    fechasHora=:fechashora,plazasOcupadas=:plazasocupa,duracion=:duracion,
    maxPlazas=:amax,minPlazas=:amin,
    materialNecesario=:necesitaMat,materialOfrecido=:matofrecido,plusMaterial=:plusmaterial,
    condicionFisica=:condfisica,transporte=:transporte
    WHERE idActividad =:aid";

    $query = $dbh->prepare($sql);

    $query->bindParam(':aname', $aname, PDO::PARAM_STR);
    $query->bindParam(':acat', $acat, PDO::PARAM_STR);

    $query->bindParam(':afeatures', $afeatures, PDO::PARAM_STR);
    $query->bindParam(':adetails', $adetails, PDO::PARAM_STR);

    $query->bindParam(':alocation', $alocation, PDO::PARAM_STR);
    $query->bindParam(':aprice', $aprice, PDO::PARAM_STR);

    $query->bindParam(':fechashora', $fechashora, PDO::PARAM_STR);
    $query->bindParam(':plazasocupa', $plazasocupa, PDO::PARAM_STR);

    $query->bindParam(':amax', $amax, PDO::PARAM_STR);
    $query->bindParam(':amin', $amin, PDO::PARAM_STR);

    $query->bindParam(':duracion', $aduration, PDO::PARAM_STR);

    $query->bindParam(':necesitaMat', $amat, PDO::PARAM_STR);
    $query->bindParam(':matofrecido', $amatoffer, PDO::PARAM_STR);
    $query->bindParam(':plusmaterial', $aplus, PDO::PARAM_STR);
    $query->bindParam(':condfisica', $aphysical, PDO::PARAM_STR);
    $query->bindParam(':transporte', $atransport, PDO::PARAM_STR);

    $query->bindParam(':aid', $aid, PDO::PARAM_STR);

    $query->execute();
    $msg = "Actividad ACTUALIZADA correctamente";
}
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

                    <h3 class="m-0 font-weight-bold text-primary">Actualizar ACTIVIDAD</h3><br>

                    <div class="row">

                        <div class="col-lg-12">

                            <?php

                            $aid = intval($_GET['aid']);

                            $sql = "SELECT * FROM actividad WHERE idActividad =:aid";

                            $query = $dbh->prepare($sql);
                            $query->bindParam(':aid', $aid, PDO::PARAM_STR);
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
                                                        value="<?php echo htmlentities($result->nombreActividad); ?>">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6" id="categoriaDivID">

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

                                                <div id="nuevaCategoriaDiv" class="form-group">
                                                    <div class="col-sm-12 pl-0 pr-0">
                                                        <input type="text" class="form-control" name="nuevaCategoria"
                                                            id="nuevaCategoriaID" placeholder="Nueva categoría"
                                                            value="<?php echo $result->categoria ?>">
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="form-group col-md-6">
                                                <label for="focusedinput" class="col-sm-12 pl-0 pr-0">Características</label>
                                                <div class="col-sm-12 pl-0 pr-0">
                                                    <textarea class="form-control" rows="5" cols="50" name="afeatures"
                                                        id="afeaturesID"
                                                        placeholder="A destacar..."><?php echo $result->caracteristicas; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="focusedinput" class="col-sm-12 pl-0 pr-0">Detalles</label>
                                                <div class="col-sm-12 pl-0 pr-0">
                                                    <textarea class="form-control" rows="5" cols="50" name="adetails"
                                                        id="adetailsID" placeholder="En particular..."
                                                        required><?php echo htmlentities($result->detalles); ?></textarea>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="form-group col-md-6">
                                                <label for="focusedinput" class="col-sm-12 pl-0 pr-0">Localización</label>
                                                <div class="col-sm-12 pl-0 pr-0">
                                                    <input type="text" class="form-control" name="alocation" id="alocationID"
                                                        placeholder="Localización de la Actividad"
                                                        value="<?php echo htmlentities($result->localizacion); ?>">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="focusedinput" class="col-sm-12 pl-0 pr-0">EUROS</label>
                                                <div class="col-sm-12 pl-0 pr-0">
                                                    <input type="number" class="form-control" name="aprice" id="apriceID"
                                                        min="0" step="0.25" placeholder="En Euros"
                                                        value="<?php echo htmlentities($result->tarifa); ?>">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="form-group col-md-6" id="padreFechas">

                                                <label class="col-sm-12 pl-0 pr-0">Fecha/s | Hora</label>

                                                <script>

                                                    function fechasOnOff() {

                                                        var input1 = document.getElementById("fechaHoraID0");
                                                        var input2 = document.getElementById("fechaHoraID1");
                                                        var input3 = document.getElementById("fechaHoraID2");
                                                        
                                                        if (input1.value == "" && input2.value != "" && input3.value != "") {
                                                            // input1.disabled = true;
                                                            // input1.value = "";
                                                            input2.disabled = true;
                                                            input2.value = "";
                                                            input3.disabled = true;
                                                            input3.value = "";
                                                        } else if (input1.value == "" && input2.value == "" && input3.value == "") {
                                                            input1.disabled = false;
                                                            // input1.value = "";
                                                            input2.disabled = true;
                                                            input2.value = "";
                                                            input3.disabled = true;
                                                            input3.value = "";
                                                        } else if (input1.value != "" && input2.value == "") {
                                                            input1.disabled = false;
                                                            // input1.value = "";
                                                            input2.disabled = false;
                                                            input2.value = "";
                                                            input3.disabled = true;
                                                            input3.value = "";
                                                        } else if (input1.value != "" && input2.value != "" && input3.value != "") {
                                                            input3.disabled = false;
                                                        } else if (input1.value != "" && input2.value != "") {
                                                            // input1.disabled = true;
                                                            // input1.value = "";
                                                            // input2.disabled = true;
                                                            // input2.value = "";
                                                            input3.disabled = false;
                                                            input3.value = "";                                                        
                                                        } else if (input1.value != "" && input2.value != "" && input3.value == "") {
                                                            // input1.disabled = true;
                                                            // input1.value = "";
                                                            // input2.disabled = true;
                                                            // input2.value = "";
                                                            input3.disabled = true;
                                                            // input3.value = "";                                                    
                                                        } else {
                                                            // input1.disabled = true;
                                                            // input1.value = "";
                                                            // input2.disabled = true;
                                                            // input2.value = "";
                                                            // input3.disabled = true;
                                                            // input3.value = "";
                                                        }
                                                    }

                                                    window.onload = function () {
                                                        fechasOnOff();
                                                    }

                                                </script>

                                                <?php

                                                $fechasHoras = $result->fechasHora;
                                                $fechaHora = explode(",", $fechasHoras, -1);

                                                for ($i = 0; $i <= 2; $i++) { ?>

                                                    <div class="col-sm-12 pl-0 pr-0" id="fechaHoraDivID<?php echo $i ?>">

                                                        <input type="datetime-local" name="fechaHora<?php echo $i; ?>"
                                                            onblur="fechasOnOff()" id="fechaHoraID<?php echo $i ?>" value="<?php if ($fechaHora[$i])
                                                                   echo date('Y-m-d H:i', strtotime($fechaHora[$i]));
                                                               else
                                                                   echo ''; ?>"
                                                            min="<?php echo date('Y-m-d') ?>T00:00">&nbsp;&nbsp;
                                                    </div>

                                                <?php } ?>

                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-sm-12 pl-0 pr-0">Duración (Hora/s)</label>
                                                <div class="col-sm-12 pl-0 pr-0">
                                                    <input type="number" class="form-control" name="duracion" id="duracionID"
                                                        min="0" placeholder="En horas"
                                                        value="<?php echo htmlentities($result->duracion); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="form-group col-md-6">
                                                <label class="col-sm-12 pl-0 pr-0">Número <b>mínimo</b> de plazas</label>
                                                <div class="col-sm-12 pl-0 pr-0">
                                                    <input type="number" class="form-control" name="minPlazas" id="minPlazasID"
                                                        min="0" value="<?php echo htmlentities($result->minPlazas); ?>">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-sm-12 pl-0 pr-0">Número <b>Máximo</b> de plazas</label>
                                                <div class="col-sm-12 pl-0 pr-0">
                                                    <input type="number" class="form-control" name="maxPlazas" id="maxPlazasID"
                                                        min="0" value="<?php echo htmlentities($result->maxPlazas); ?>">
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
                                                        value="<?php echo htmlentities($result->materialNecesario); ?>"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-sm-12 pl-0 pr-0" style="text-align: center;">Se ofrece el
                                                    material</label>
                                                <input type="checkbox" class="form-control" name="materialOfrecido"
                                                    id="materialOfrecidoID" <?php if ($result->materialOfrecido == 1) {
                                                        echo 'checked';
                                                    } ?> onclick="plusMat()">
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="form-group col-md-6"></div>

                                            <div class="form-group col-md-6">
                                                <label class="col-sm-12 pl-0 pr-0">Plus material (EUROS)</label>
                                                <div class="col-sm-12 pl-0 pr-0">
                                                    <input type="number" class="form-control" name="plusMaterial"
                                                        id="plusMaterialID" placeholder="En Euros" min="0"
                                                        value="<?php echo htmlentities($result->plusMaterial); ?>">
                                                </div>
                                            </div>

                                        </div>

                                        <script>
                                            if (document.getElementById('materialOfrecidoID').checked == false) {
                                                document.getElementById('plusMaterialID').disabled = true;
                                            } else {
                                                document.getElementById('plusMaterialID').disabled = false;
                                            }

                                            function plusMat() {
                                                if (document.getElementById('materialOfrecidoID').checked == true) {
                                                    document.getElementById('plusMaterialID').disabled = false;
                                                    document.getElementById('plusMaterialID').value = '<?php echo htmlentities($result->plusMaterial); ?>';                                                 
                                                } else {
                                                    document.getElementById('plusMaterialID').disabled = true;
                                                    document.getElementById('plusMaterialID').value = '0';
                                                }
                                            }                                        
                                        </script>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="col-sm-12 pl-0 pr-0" style="text-align: center;">Condición
                                                    física específica</label>
                                                <input type="checkbox" class="form-control" name="condicionFisica"
                                                    id="condicionFisicaID" <?php if ($result->condicionFisica == 1) {
                                                        echo 'checked';
                                                    } ?>>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="col-sm-12 pl-0 pr-0" style="text-align: center;">Se necesita
                                                    transporte
                                                    para
                                                    llegar</label>
                                                <input type="checkbox" class="form-control" name="transporte" id="transporteID"
                                                    <?php if ($result->transporte == 1) {
                                                        echo 'checked';
                                                    } ?>>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="focusedinput" class="col-sm-12 control-label">Imagen
                                                asociada</label>
                                            <div class="col-sm-6">
                                                <img src="images/actividad/<?php echo $result->imagen; ?>"
                                                    width="200">&nbsp;&nbsp;&nbsp;
                                                <a href="actividad-cambia-imagen.php?imgid=<?php echo $result->idActividad; ?>">Cambiar
                                                    Imagen</a>
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

                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <button type="submit" name="actividadUpdate"
                                                    class="btn-primary btn">Actualizar</button>
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