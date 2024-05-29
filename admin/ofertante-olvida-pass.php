<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');

if (isset ($_POST['submit'])) {
    $password1 = ($_POST['newpassword']);
    $password2 = ($_POST['confirmpassword']);
    
    if ($password1 != $password2) {
        echo "<script>alert('No coinciden las palabras!');</script>";
    } else {
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $newpassword = $_POST['newpassword'];
        
        $sql = "SELECT email FROM ofertante WHERE email=:email and telefono=:phonenumber";
        
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':phonenumber', $phonenumber, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        
        if ($query->rowCount() > 0) {

            $sql2 = "UPDATE ofertante SET password=:newpassword WHERE email=:email and telefono=:phonenumber";
            
            $query2 = $dbh->prepare($sql2);
            $query2->bindParam(':email', $email, PDO::PARAM_STR);
            $query2->bindParam(':phonenumber', $phonenumber, PDO::PARAM_STR);
            $query2->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $query2->execute();
            echo "<script>alert('Tu contraseña se ha cambiado correctamente');</script>";
        } else {
            echo "<script>alert('Email o teléfono NO válidos!');</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>EscAppe - Admin</title>
    <meta charset="UTF-8">
    <meta name="author" content="JaviER Fdez.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/personal-admin.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon/sole_ico.png" type="image/x-icon">
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
                                        <h1 class="h4 text-gray-900 mb-4">Completa la información requerida</h1>
                                    </div>
                                    
                                    <form role="form" id="" method="post" enctype="multipart/form-data"
                                        class="form-horizontal">
                                        <div class="form-group mb-3">
                                            <input type="email" class="form-control form-control-lg" name="email"
                                                placeholder="Email" required>
                                        </div>
                                        <div class="form-group mt-3">
                                            <input type="text" name="mobile" class="form-control form-control-lg"
                                                id="exampleInputPassword1" placeholder="Número de teléfono" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="password" class="form-control form-control-lg"
                                                name="newpassword" placeholder="Nueva contraseña" required>
                                        </div>
                                        <div class="form-group mt-3">
                                            <input type="password" name="confirmpassword"
                                                class="form-control form-control-lg" id="exampleInputPassword1"
                                                placeholder="Confirma la contraseña" required>
                                        </div>
                                        <div class="mt-3">
                                            <button name="submit" class="btn btn-primary btn-block">Confirma tu cambio de Contraseña</button>
                                        </div>
                                        <div class="text-center mt-4 font-weight-light">
                                            <a href="login.php" class="text-primary">
                                                Vuelve al Login
                                            </a>
                                        </div>
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
    
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>    
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/personal-admin.min.js"></script>
</body>

</html>