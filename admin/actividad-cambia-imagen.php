<?php
include ('check/login.php');
check_login();

// $aid = intval($_GET['aid']);
$imgid = intval($_GET['imgid']);

if (isset($_POST['cambiaImagen'])) {

  $aimage = $_FILES["aimage"]["name"];

  $sql = "UPDATE actividad SET imagen =:aimage WHERE idActividad =:imgid";

  $query = $dbh->prepare($sql);
  $query->bindParam(':imgid', $imgid, PDO::PARAM_STR);
  $query->bindParam(':aimage', $aimage, PDO::PARAM_STR);
  $query->execute();

  move_uploaded_file($_FILES["aimage"]["tmp_name"], "images/actividad/" . $_FILES["aimage"]["name"]);
  $msg = "Imagen de ACTIVIDAD actualizada correctamente";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <title>EscAppe Admin - Cambiar imagen ACTIVIDAD</title>
  <meta charset="UTF-8">
  <meta name="author" content="JaviER Fdez.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <!-- <link href="css/personal-admin.min.css" rel="stylesheet"> -->
  <link href="css/personal-admin.css" rel="stylesheet">
  <!-- <link href="css/bootstrap.css" rel="stylesheet"> -->
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

          <div class="row">

            <div class="col-lg-12">

              <div class="card mb-4">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                  <h1 class="h3 mb-0 text-gray-800">Cambiar imagen asociada a la ACTIVIDAD</h1>

                  <?php
                  if ($error) { ?>
                    <div class="errorWrap">
                      <strong>ERROR</strong>:
                      <?php echo htmlentities($error); ?>
                    </div>
                    <?php
                  } else if ($msg) { ?>
                      <div class="succWrap">
                        <strong>CORRECTO</strong>:
                      <?php echo htmlentities($msg); ?>
                      </div>
                    <?php
                  } ?>

                </div>

                <div class="card-body">

                  <form class="form-horizontal" name="actividadImage" method="POST" enctype="multipart/form-data">

                    <?php

                    $imgid = intval($_GET['imgid']);

                    $sql = "SELECT imagen FROM actividad WHERE idActividad =:imgid";

                    $query = $dbh->prepare($sql);
                    $query->bindParam(':imgid', $imgid, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    if ($query->rowCount() > 0) {

                      foreach ($results as $result) {
                        ?>
                        <div class="form-group">
                          <label for="focusedinput" class="col-sm-2 control-label">Imagen actual</label>
                          <div class="col-sm-8">
                            <img src="images/actividad/<?php echo $result->imagen; ?>" width="200">
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="focusedinput" class="col-sm-2 control-label">Cambiar la imagen</label>
                          <div class="col-sm-8">
                            <input type="file" name="aimage" id="aimageID">
                          </div>
                        </div>
                        <?php
                      }
                    } ?>

                    <div class="row">
                      <div class="col-sm-8 col-sm-offset-2">
                        <button type="submit" name="cambiaImagen" class="btn-primary btn">Actualizar</button>
                      </div>
                    </div>

                  </form>

                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <p>Seguro que quieres salir?</p>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancelar</button>
                  <a href="login.php" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include ('includes/footer.php'); ?>
    </div>
  </div>

  <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/personal-admin.min.js"></script>

</body>

</html>