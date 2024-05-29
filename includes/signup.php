<?php
error_reporting(0);

if (isset($_POST['creaConsumidor'])) {

    $uapenom = $_POST['userApenom'];
    $unumber = $_POST['userNumber'];
    $umail = $_POST['userEmail'];
    $upass = $_POST['userPass'];

    $sql = "INSERT INTO consumidor(apenom,telefono,emailConsumidor,password) 
    VALUES(:uapenom,:unumber,:usermail,:userpass)";

    $query = $dbh->prepare($sql);
    $query->bindParam(':uapenom', $uapenom, PDO::PARAM_STR);
    $query->bindParam(':unumber', $unumber, PDO::PARAM_STR);
    $query->bindParam(':usermail', $umail, PDO::PARAM_STR);
    $query->bindParam(':userpass', $upass, PDO::PARAM_STR);
    $query->execute();

    $lastInsertId = $dbh->lastInsertId();
    //devuelve un string representando el ID de la última fila que ha sido insertada

    if ($lastInsertId) {
        echo '<script>alert("Te has registrado satisfactoriamente\nAhora puedes entrar como CONSUMIDOR")</script>';
        echo "<script>document.location = 'index.php';</script>";
    } else {
        echo '<script>alert("Algo ha ido mal. Prueba otra vez")</script>';
        echo "<script>document.location = 'index.php';</script>";
    }
}
?>


<script>

    // Comprueba y valida la diponibilidad del teléfono para el nuevo Consumidor
    function validaTlf() {

        var telef = new RegExp("^(\\+34|0034|34)?[6789]\\d{8}$");
        var valortelef = document.getElementById("userNumberID").value;

        if (!!valortelef) {

            if (telef.test(valortelef)) {
                jQuery.ajax({
                    url: "check/phone.php",
                    data: 'userNumber=' + $("#userNumberID").val(),
                    type: "POST",
                    success: function (data) {
                        if (data == "nroYaRegistrado") {
                            $("#userNumberOK").html('<span style="color:red">¡El teléfono introducido ya se encuentra registrado!</span>');
                        } else if (data == "tlfOK") {
                            $("#userNumberOK").html('<span style="color:green">Telefono OK y disponible...</span>');
                        }
                    },
                    error: function () { }
                });
            } else {
                $("#userNumberOK").html("<span style='color:red'>Error : No has introducido bien el teléfono</span>");
            }
        } else {
            $("#userNumberOK").html("");
        }
    }

    // Comprueba y valida la diponibilidad del email para el nuevo Consumidor
    function validaEmail() {

        jQuery.ajax({
            url: "check/email.php",
            data: 'userEmail=' + $("#userEmailID").val(),
            type: "POST",
            success: function (data) {
                if (data == 'emailMal') {
                    $("#userEmailOK").html('<span style="color:red">Error : Email NO válido</span>');
                } else {
                    if (data == "yaRegistrado") {
                        $("#userEmailOK").html('<span style="color:red">¡El email introducido ya se encuentra registrado!</span>');
                    } else if (data == '') {
                        $("#userEmailOK").html("");
                        $('#creaOfertanteID').prop('disabled', true);
                    } else if (data == 'emailOK') {
                        $("#userEmailOK").html('<span style="color:green">Email disponible...</span>');
                    } else {
                        window.alert("SALGOOOOOOOOOOOOOO");
                    }
                }
            },
            error: function () { }
        });
    }

    // Permite la pulsación del botón para crear el nuevo Consumidor cuando todo está OK
    function activaBoton() {

        let tlf = document.getElementById("userNumberOK").innerText;
        let mail = document.getElementById("userEmailOK").innerText;

        if (tlf == "Telefono OK y disponible..." && mail == "Email disponible...") {
            $('#creaConsumidorID').prop('disabled', false);
            $('#creaConsumidorID').css('background', 'green');
        } else if (tlf == "" && mail == "") {
            $('#creaConsumidorID').prop('disabled', true);
            $('#creaConsumidorID').css('background', '#428bca');
        } else {
            $('#creaConsumidorID').prop('disabled', true);
            $('#creaConsumidorID').css('background', 'red');
        }
    }

</script>

<div class="modal fade" id="consumidorSignupID" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;
                    </span>
                </button>
            </div>

            <section>
                <div class="modal-body modal-spa">
                    <div class="login-grids">
                        <div class="login">
                            <div class="login-right">

                                <form name="signup" method="POST">

                                    <h3>Crea una cuenta CONSUMIDOR</h3>

                                    <!-- Nombre y Apellidos del Consumidor -->
                                    <input type="text" name="userApenom" placeholder="Nombre y apellidos"
                                        autocomplete="off" class="form-control" value="" required="">

                                    <!-- Teléfono del Consumidor -->
                                    <input type="text" class="form-control" placeholder="Número de teléfono"
                                        maxlength="12" name="userNumber" id="userNumberID" onBlur="validaTlf()"
                                        autocomplete="off" value="" required="">
                                    <span id="userNumberOK" style="font-size:12px;"></span>

                                    <!-- Email del Consumidor -->
                                    <input type="text" name="userEmail" id="userEmailID" class="form-control"
                                        placeholder="Email [Será tu login]" onBlur="validaEmail()" autocomplete="off"
                                        style="color: #000000;" value="" required="">
                                    <span id="userEmailOK" style="font-size:12px;"></span>

                                    <!-- Password del Consumidor -->
                                    <input type="password" name="userPass" class="form-control" placeholder="Contraseña"
                                        value="" required="">

                                    <div class="modal-footer text-right">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Cancelar</button>

                                        <span onmouseover="activaBoton()">
                                            <button type="submit" name="creaConsumidor" id="creaConsumidorID"
                                                class="btn btn-primary" disabled>Crear</button>
                                        </span>
                                    </div>
                                </form>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>