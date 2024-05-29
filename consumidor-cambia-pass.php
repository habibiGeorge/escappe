<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');

if (strlen($_SESSION['entraConsumidor']) == 0) {

    header('Location:index.php');

} else {
    // ...del FORMULARIO "cambiaPass"
    if (isset($_POST['cambiaPass'])) {

        $password = $_POST['currentpass'];
        $newpassword = $_POST['newpassword'];
        $email = $_SESSION['entraConsumidor'];
        
        $sql = "SELECT password FROM consumidor WHERE emailConsumidor=:email AND password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            
            $con = "UPDATE consumidor SET password=:newpassword WHERE emailConsumidor=:email";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            $msg = "Tu contraseña se ha modificado correctamente";
        } else {
            $error = "No has introducido bien tu contraseña actual";
        }
    }
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
        <link rel="stylesheet" href="css/bootstrap-3.0.0/bootstrap.min.css" />
        <link rel="stylesheet" href="css/styles.css" />
        <link rel="shortcut icon" href="admin/images/favicon/sole_ico.png" type="image/x-icon">
        <script type="text/javascript">

            function mostrarContrasena() {
                var tipo = document.getElementById("currentpassid");
                if (tipo.type == "password") {
                    tipo.type = "text";
                } else {
                    tipo.type = "password";
                }
            }

            function valid() {
                if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                    $("#passConfirmID").html("<span style='color:red'>Error : No has introducido bien las palabras</span>");
                    $('#cambiaPassID').prop('disabled',true);
                    alert("Las palabras no coinciden!");
                    document.chngpwd.confirmpassword.focus();
                    return false;
                }
                else {
                    $("#passConfirmID").html("");
                    $('#cambiaPassID').prop('disabled',false);                    
                }
                return true;
            }
        </script>
    </head>

    <body>

    <?php include ('includes/header.php'); ?>

        <section id="actividades" class="secPad">

            <div class="privacy">

                <div class="container">

                    <h3 class="wow fadeInDown animated animated" data-wow-delay=".5s"
                        style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">Cambia tu contraseña
                    </h3>

                    <!-- INICIO FORMULARIO submit "cambiaPass" -->
                    <form name="chngpwd" method="POST" onSubmit="return valid();">
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
                        <p class="form-fit">
                            <b>Contraseña actual</b>
                            <input type="password" name="currentpass" id="currentpassid" placeholder="" required="">
                            <button class="btn btn-primary" type="button" onclick="mostrarContrasena()">
                                <i class="fa fa-eye"></i>
                            </button>
                        </p>

                        <p class="form-fit">
                            <b>Contraseña nueva</b>
                            <input type="password" class="form-control" name="newpassword" id="newpasswordid"
                                placeholder="Introduce nueva contraseña" required="">
                        </p>

                        <p class="form-fit">
                            <b>Confirma el cambio de Contraseña</b>
                            <input type="password" class="form-control" name="confirmpassword" id="confirmpasswordid"
                                placeholder="Confirma la nueva contraseña" required="">
                            <span id="passConfirmID"></span>
                        </p>

                        <button type="submit" name="cambiaPass" id="cambiaPassID" class="btn-primary btn">
                            Cambiar
                        </button>
                    </form>

                </div>
            </div>
        </section>

        <a href="#top" class="topHome"><i class="fa fa-chevron-up fa-2x"></i></a>
        
        <?php include ('includes/footer.php') ?>
        
        <?php include ('includes/signup.php'); ?>
        <?php include ('includes/login.php'); ?>        
        
        <script src="js/jquery-1.8.2/jquery-1.8.2.min.js" type="text/javascript"></script>
        <script src="js/bootstrap-3.0.0/bootstrap.min.js" type="text/javascript"></script>
    </body>

    </html>
    <?php
} ?>