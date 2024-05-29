<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');
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
    <!-- <link href="css/bootstrap-3.0.0/bootstrap.min.css" rel="stylesheet" /> -->
    <link href="css/bootstrap-3.0.0/bootstrap.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="admin/images/favicon/sole_ico.png" rel="shortcut icon" type="image/x-icon">
</head>

<body>

    <?php include ('includes/header.php'); ?>

    <section id="actividades" class="secPad">

        <div class="container">
            <img src="admin\images\perfil\bbg.png" style="width: 21rem;" alt="">
            <p>
                Desarrollado por Javier Fdez.
                IES. VELÁZQUEZ @2024
            </p>
            <div class="clearfix"></div>
        </div>

    </section>

    <a href="#top" class="topHome"><i class="fa fa-chevron-up fa-2x"></i></a>

    <?php include ('includes/footer.php'); ?>

    <?php include ('includes/login.php'); ?>
    <?php include ('includes/signup.php'); ?>
    <?php include ('admin/includes/signup.php'); ?>

    <script src="js/jquery-1.8.2/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script src="js/bootstrap-3.0.0/bootstrap.min.js" type="text/javascript"></script>

</body>

</html>