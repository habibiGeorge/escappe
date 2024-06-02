<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');

if (strlen($_SESSION['adminid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $adminid = $_SESSION['adminid'];
        $cpassword = $_POST['currentpassword'];
        $newpassword = $_POST['newpassword'];
        $sql = "SELECT idOfertante FROM ofertante WHERE idOfertante=:adminid and password=:cpassword";
        $query = $dbh->prepare($sql);
        $query->bindParam(':adminid', $adminid, PDO::PARAM_STR);
        $query->bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            $con = "UPDATE ofertante SET password=:newpassword WHERE idOfertante=:adminid";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':adminid', $adminid, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            echo '<script>alert("Tu contraseña se ha cambiado correctamente")</script>';
        } else {
            echo '<script>alert("Tu contraseña actual no vale!")</script>';
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <title>EscAppe Admin - Cambia Contraseña</title>
        <meta charset="UTF-8">
        <meta name="author" content="JaviER Fdez.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <!-- <link href="css/personal-admin.min.css" rel="stylesheet"> -->
        <link href="css/personal-admin.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">
        <link rel="shortcut icon" href="images/favicon/sole_ico.png" type="image/x-icon">
    </head>

    <script type="text/javascript">

        function checkpass() {
            if (document.changepassword.newpassword.value != document.changepassword.confirmpassword.value) {
                alert('La nueva Contraseña y su confirmación no coinciden!');
                document.changepassword.confirmpassword.focus();
                return false;
            }
            return true;
        }

    </script>

    <body id="page-top">

        <div id="wrapper">

            <?php include ('includes/sidebar.php'); ?>

            <div id="content-wrapper" class="d-flex flex-column">

                <div id="content">

                    <?php include ('includes/header.php'); ?>

                    <div class="container-fluid" id="container-wrapper">

                    <h3 class="m-0 font-weight-bold text-primary">Cambia tu contraseña</h3><br>                        

                        <div class="row">

                            <div class="col-lg-6">

                                <div class="card mb-4">

                                    <div class="card-body">

                                        <form method="POST" onsubmit="return checkpass();" name="changepassword">

                                            <div class="form-group row">
                                                <label class="col-12" for="register1-username">Contraseña actual:</label>
                                                <div class="col-12">
                                                    <input type="password" class="form-control" name="currentpassword"
                                                        id="currentpassword" required='true'>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-12" for="register1-email">Contraseña nueva:</label>
                                                <div class="col-12">
                                                    <input type="password" class="form-control" name="newpassword"
                                                        class="form-control" required="true">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-12" for="register1-password">Confirma Contraseña:</label>
                                                <div class="col-12">
                                                    <input type="password" class="form-control" name="confirmpassword"
                                                        id="confirmpassword" required='true'>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary" name="submit">Cambiar
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