<?php
include ('check/login.php');
check_login();

if (isset($_POST['perfilUpdate'])) {

    $adminid = $_SESSION['adminid'];
    $AName = $_POST['username'];
    $fName = $_POST['firstname'];
    $lName = $_POST['lastname'];
    $mobno = $_POST['mobilenumber'];
    $email = $_POST['email'];

    $sql = "UPDATE ofertante SET nombreUsuario=:adminname,FirstName=:firstname,LastName=:lastname,MobileNumber=:mobilenumber,Email=:email WHERE ID=:aid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':adminname', $AName, PDO::PARAM_STR);
    $query->bindParam(':firstname', $fName, PDO::PARAM_STR);
    $query->bindParam(':lastname', $lName, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobilenumber', $mobno, PDO::PARAM_STR);
    $query->bindParam(':aid', $adminid, PDO::PARAM_STR);
    $query->execute();
    echo '<script>alert("El Perfil ha sio actualizado")</script>';
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>EscAppe Admin - Actualizar Perfil</title>
    <meta charset="UTF-8">
    <meta name="author" content="JaviER Fdez.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
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

                    <h3 class="m-0 font-weight-bold text-primary">Edita tus datos</h3><br>

                    <div class="row mb-3">

                        <div class="col-lg-12">

                            <div class="card mb-4">

                                <div class="card-body">

                                    <form method="POST">

                                        <?php
                                        $adminid = $_SESSION['adminid'];

                                        $sql = "SELECT * FROM ofertante WHERE idOfertante=:aid";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':aid', $adminid, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                                        if ($query->rowCount() > 0) {

                                            foreach ($results as $row) { ?>

                                                <div class="container rounded bg-white mt-5">

                                                    <div class="row">

                                                        <div class="col-md-4 border-right">
                                                            <div
                                                                class="d-flex flex-column align-items-center text-center p-3 py-5">

                                                                <?php
                                                                if ($row->foto == "nobody.jpg") { ?>
                                                                    <img class="rounded-circle mt-5" src="images/perfil/nobody.jpg"
                                                                        width="90">
                                                                    <?php
                                                                } else { ?>
                                                                    <img class="rounded-circle mt-5"
                                                                        src="images/perfil/<?php echo $row->foto; ?>" width="90">
                                                                    <?php
                                                                } ?><span class="font-weight-bold">
                                                                    <?php echo $row->nombre; ?>
                                                                    <?php echo $row->apellidos; ?>
                                                                </span><span class="text-black-50">
                                                                    <?php echo $row->emailOfertante; ?>
                                                                </span><span>
                                                                    <?php echo $row->telefono; ?>
                                                                </span>
                                                                <div class="mt-3">
                                                                    <a
                                                                        href="ofertante-update-foto.php?id=<?php echo $adminid; ?>" class="btn btn-secondary">Cambiar
                                                                        imagen</a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-8">

                                                            <div class="p-3 py-5">

                                                                <div class="row mt-2">
                                                                    <div class="col-md-6">Nombre
                                                                        <input type="text" class="form-control" name="firstname"
                                                                            value="<?php echo $row->nombre; ?>" required='true'>
                                                                    </div>
                                                                    <div class="col-md-6">Apellidos
                                                                        <input type="text" class="form-control"
                                                                            value="<?php echo $row->apellidos; ?>"
                                                                            name="lastname" required>
                                                                    </div>
                                                                </div>

                                                                <div class="row mt-3">
                                                                    <div class="col-md-6">Email
                                                                        <input type="text" class="form-control" name="email"
                                                                            value="<?php echo $row->emailOfertante; ?>"
                                                                            required>
                                                                    </div>
                                                                    <div class="col-md-6">Teléfono
                                                                        <input type="text" class="form-control"
                                                                            value="<?php echo $row->telefono; ?>"
                                                                            name="mobilenumber" required>
                                                                    </div>
                                                                </div>

                                                                <div class="row mt-3">
                                                                    <div class="col-md-6">Nombre de Usuario [Login]
                                                                        <input type="text" class="form-control" name="username"
                                                                            value="<?php echo $row->nombreUsuario; ?>" required>
                                                                    </div>

                                                                    <div class="col-md-6">Tipo de Perfil
                                                                        <input type="text" class="form-control" name="adminname"
                                                                            value="<?php echo $row->perfil; ?>" readonly="true">
                                                                    </div>
                                                                </div>

                                                                <div class="row mt-3">
                                                                    <div class="col-md-6">Ubicación
                                                                        <input type="text" class="form-control"
                                                                            value="<?php echo $row->ubicacion; ?>">
                                                                    </div>
                                                                    <div class="col-md-6">Fecha del Registro
                                                                        <input type="text" class="form-control"
                                                                            value="<?php echo $row->fechaRegistro; ?>"
                                                                            readonly="true">
                                                                    </div>
                                                                </div>

                                                                <div class="mt-5 text-right">
                                                                    <button class="btn btn-primary profile-button" type="submit"
                                                                        name="perfilUpdate">Actualizar
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
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

</body>

</html>