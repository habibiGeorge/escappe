<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');

if (isset($_POST['consumidorEntra'])) {

    $mail = $_POST['email'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM consumidor WHERE emailConsumidor=:mail AND password=:pass";

    $query = $dbh->prepare($sql);
    $query->bindParam(':mail', $mail, PDO::PARAM_STR);
    $query->bindParam(':pass', $pass, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {

        foreach ($results as $result) {

            $_SESSION['consumidorID'] = $result->idConsumidor;
            $_SESSION['entraConsumidor'] = $_POST['email'];            
            $_SESSION['nombreApellidos'] = $result->apenom;
        }

        // echo "<script>document.location = 'index.php';</script>";
        $currentURL = $_SERVER['REQUEST_URI'];
        echo "<script>document.location = '$currentURL';</script>";
    } else {
        echo "<script>alert('Detalles NO válidos');</script>";
    }
}
?>

<div class="modal fade" id="consumidorLoginID" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">

        <div class="modal-content modal-info">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body modal-spa">

                <div class="login-grids">

                    <div class="login">

                        <div class="login-right">

                            <form method="POST">

                                <h3>Entra en tu cuenta CONSUMIDOR</h3>

                                <input type="text" name="email" id="emailID" class="form-control"
                                    placeholder="Introduce tu email" required="">

                                <input type="password" name="password" id="passwordID" class="form-control"
                                    placeholder="Introduce tu contraseña" value="" required="">

                                <h4><a href="consumidor-olvida-pass.php">He olvidado mi contraseña</a></h4>

                                <div class="modal-footer text-right">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" name="consumidorEntra" class="btn btn-primary">Entrar</button>
                                </div>
                            </form>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>