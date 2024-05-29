<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');
include ('check/login.php');
check_login();

if (strlen($_SESSION['adminid'] == 0)) {

    header('location: logout.php');

} else {

    $aid = intval($_GET['id']);

    if (isset($_POST['fotoUpdateAdmin'])) {

        $adminid = $_SESSION['adminid'];
        $adminfoto = $_FILES["adminfoto"]["name"];
        move_uploaded_file($_FILES["adminfoto"]["tmp_name"], "images/perfil/" . $_FILES["adminfoto"]["name"]);

        $sql = "UPDATE ofertante SET foto=:adminfoto WHERE idOfertante=:aid";

        $query = $dbh->prepare($sql);
        $query->bindParam(':adminfoto', $adminfoto, PDO::PARAM_STR);
        $query->bindParam(':aid', $aid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Foto de Perfil actualizada correctamente";
    }
    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <title>EscAppe Admin - Actualizar Foto Perfil</title>
        <meta charset="UTF-8">
        <meta name="author" content="JaviER Fdez.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <!-- <link href="css/personal-admin.min.css" rel="stylesheet"> -->
        <link href="css/personal-admin.css" rel="stylesheet">
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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

                                    <div class="card-body">
                                        <?php if (isset($_POST['fotoUpdateAdmin'])) { ?>
                                            <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <strong>¡Hecho!</strong>
                                                <?php echo $msg; ?>
                                                <?php echo $msg = ""; ?>
                                            </div>
                                        <?php } ?>

                                        <form class="form-horizontal row-fluid" name="cambiaFoto" method="POST"
                                            enctype="multipart/form-data">

                                            <?php
                                            $adminid = $_SESSION['adminid'];

                                            $sql = "SELECT * FROM ofertante WHERE idOfertante=:aid";

                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':aid', $adminid, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);

                                            if ($query->rowCount() > 0) {

                                                foreach ($results as $row) {
                                                    ?>
                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Nombre y Apellidos</label>
                                                        <div class="col-6">
                                                            <input type="text" class="form-control" name="adminApenom" readonly
                                                                value="<?php echo $row->nombre; ?>&nbsp;<?php echo $row->apellidos; ?>"
                                                                class="span6 tip" required>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="control-group">
                                                        <label class="control-label" for="basicinput">Imagen actual</label>
                                                        <div class="controls">
                                                            <?php
                                                            if ($row->foto == "nobody.jpg") {
                                                                ?>
                                                                <img class="" src="images/perfil/nobody.jpg" alt="" width="100" height="100">
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img src="images/perfil/<?php echo $row->foto; ?>" width="auto" height="150">
                                                                <?php
                                                            } ?>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="form-group col-md-6">
                                                        <label><b>Nueva imagen :</b></label>
                                                        <input type="file" name="adminfoto" id="adminfotoID"
                                                            class="file-upload-default">
                                                    </div>
                                                    <?php
                                                }
                                            } ?>
                                            <br>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary" name="fotoUpdateAdmin">Actualizar
                                                        <!-- <i class="fa fa-plus"></i>&nbsp; -->
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
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

        <?php include ('includes/logout-modal.php'); ?>
        <?php include ('includes/quit-modal.php'); ?>

        <script src="vendor/jquery/jquery.min.js"></script>
        <!-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="js/personal-admin.min.js"></script>

        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#dataTable').DataTable();
                $('#dataTableHover').DataTable();
            });
        </script>

    </body>

    </html>

    <?php
} ?>