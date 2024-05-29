<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');

if (isset($_POST['entraOfertante'])) {

    $adminlogin = $_POST['adminLogin'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM ofertante WHERE nombreUsuario =:username AND password =:password";
    
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $adminlogin, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {

        foreach ($results as $result) {

            $_SESSION['adminid'] = $result->idOfertante;
            $_SESSION['entraOfertante'] = $result->nombreUsuario;
            $_SESSION['perfil'] = $result->perfil;
            $_SESSION['nombre'] = $result->nombre;
            $_SESSION['apellidos'] = $result->apellidos;
            $_SESSION['telefono'] = $result->telefono;
            $_SESSION['email'] = $result->emailOfertante;
            $_SESSION['cuentaOk'] = $result->enActivo;
            // $cuentaOk = $result->enActivo;
        }

        // $idadmin = $_SESSION['adminid'];

        $sql = "SELECT * FROM ofertante WHERE idOfertante =:adminid";
        
        $query = $dbh->prepare($sql);
        $query->bindParam(':adminid', $_SESSION['adminid'], PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {

            foreach ($results as $row) {

                if ($_SESSION['cuentaOk'] == "1") {
                    echo "<script type='text/javascript'>document.location ='dashboard.php';</script>";
                } else {
                    echo "<script>alert('Tu cuenta OFERTANTE ha sido deshabilitada');
                    document.location ='../index.php';</script>";
                }
            }
        }

    } else {
        echo "<script>alert('Datos NO válidos!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>EscAPPe - Admin</title>
    <meta charset="UTF-8">
    <meta name="author" content="JaviER Fdez.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/personal-admin.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="images/favicon/sole_ico.png" rel="shortcut icon" type="image/x-icon">

</head>

<body class="bg-gradient-login">
    
    <!-- Contenido del Login -->
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login OFERTANTE</h1>
                                    </div>

                                    <!-- INICIO FORMULARIO submit "entraOfertante" -->
                                    <form method="POST" role="form" id="" enctype="multipart/form-data"
                                        class="form-horizontal">

                                        <div class="form-group mb-3">
                                            <input type="text" name="adminLogin" id="exampleInputEmail1"
                                                class="form-control form-control-lg" placeholder="Nombre de Usuario"
                                                required>
                                        </div>

                                        <div class="form-group mt-3">
                                            <input type="password" name="password" id="exampleInputPassword1"
                                                class="form-control form-control-lg" placeholder="Contraseña" required>
                                        </div>

                                        <div class="mt-3">
                                            <button name="entraOfertante" class="btn btn-primary btn-block">Entrar
                                            </button>
                                        </div>

                                        <div class="text-center mt-4 font-weight-light">
                                            <a href="ofertante-olvida-pass.php" class="text-primary">
                                                Olvidé mi contraseña
                                            </a>
                                        </div>

                                        <div class="text-center mt-4 font-weight-light">
                                            <a href="../index.php" class="text-primary">
                                                Volver a la Página Principal
                                            </a>
                                        </div>
                                        <hr>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN Contenido del Login -->

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>    
    <script src="js/personal-admin.min.js"></script>
</body>

</html>