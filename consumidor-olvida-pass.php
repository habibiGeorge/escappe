<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');

if (isset($_POST['olvidaPass'])) {

    $mail = $_POST['email'];
    $tlf = $_POST['telefono'];
    $newpass = $_POST['newPassword'];

    $sql = "SELECT emailConsumidor FROM consumidor WHERE emailConsumidor=:mail AND telefono=:tlf";

    $query = $dbh->prepare($sql);
    $query->bindParam(':mail', $mail, PDO::PARAM_STR);
    $query->bindParam(':tlf', $tlf, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {

        $sql2 = "UPDATE consumidor SET password=:newpass WHERE emailConsumidor=:mail AND telefono=:tlf";

        $query2 = $dbh->prepare($sql2);
        $query2->bindParam(':mail', $mail, PDO::PARAM_STR);
        $query2->bindParam(':tlf', $tlf, PDO::PARAM_STR);
        $query2->bindParam(':newpass', $newpass, PDO::PARAM_STR);
        $query2->execute();
        $msg = "Tu Contraseña se ha cambiado correctamente";
    } else {
        $error = "Teléfono o Email NO válidos";
    }
}

?>

<head>
    <title>EscAppe - Usuario</title>
    <meta charset="UTF-8">
    <meta name="author" content="JaviER Fdez.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="css/font-awesome/font-awesome.min.css" rel="stylesheet">
    <!-- <link href="css/animate.css" rel="stylesheet" type="text/css" media="all"> -->
    <link href="css/bootstrap-3.0.0/bootstrap.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="admin/images/favicon/sole_ico.png" rel="shortcut icon" type="image/x-icon">

    <script type="text/javascript">
        function validaPass() {
            if (document.cambiaPass.newPassword.value != document.cambiaPass.confirmaPass.value) {
                alert("Las dos palabras no coinciden!");
                document.cambiaPass.confirmaPass.focus();
                return false;
            }
            return true;
        }
    </script>

</head>

<body>

    <?php include ('includes/header.php'); ?>

    <div id="#top"></div>

    <section id="actividad" class="secPad">

        <div class="container">

            <div class="privacy">

                <div class="container">

                    <h3 class="wow fadeInDown animated animated" data-wow-delay=".5s"
                        style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">Renueva tu
                        contraseña
                    </h3>

                    <form name="cambiaPass" method="POST" onSubmit="return validaPass();">

                        <?php
                        if ($error) {
                            ?>
                            <div class="errorWrap" style="color:red">
                                <strong>ERROR</strong>:
                                <?php echo htmlentities($error); ?>
                            </div>
                            <?php
                        } else if ($msg) {
                            ?>
                                <div class="succWrap" style="color:green">
                                    <strong>CORRECTO</strong>:
                                <?php echo htmlentities($msg); ?>
                                </div>
                            <?php
                        }
                        ?>

                        <p class="form-fit">
                            <b>Email (Login)</b>
                            <input type="email" name="email" id="emailID" class="form-control"
                                placeholder="Introduce tu email registrado" required="">
                        </p>

                        <p class="form-fit">
                            <b>Teléfono</b>
                            <input type="text" name="telefono" id="telefonoID" class="form-control"
                                placeholder="Introduce número de teléfono asociado" required="">
                        </p>

                        <p class="form-fit">
                            <b>Nueva Contraseña</b>
                            <input type="password" name="newPassword" id="newPasswordID" class="form-control"
                                placeholder="Introduce una nueva contraseña" required="">
                        </p>

                        <p class="form-fit">
                            <b>Confirma Contraseña</b>
                            <input type="password" name="confirmaPass" id="confirmaPassID" class="form-control"
                                placeholder="Confirma la nueva contraseña" required="">
                        </p>

                        <p class="form-fit">
                            <button type="submit" name="olvidaPass" class="btn-primary btn">Cambiar</button>
                        </p>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <a href="#top" class="topHome"><i class="fa fa-chevron-up fa-2x"></i></a>

    <?php include ('admin/includes/signup.php'); ?>

    <?php include ('includes/signup.php'); ?>
    <?php include ('includes/login.php'); ?>

    <?php include ('includes/footer.php') ?>

    <script src="js/jquery-1.8.2/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script src="js/bootstrap-3.0.0/bootstrap.min.js" type="text/javascript"></script>
</body>

</html>