<?php
error_reporting(0);

if (isset($_POST['creaOfertante'])) {

    $alog = $_POST['adminNombreUsuario'];
    $atlf = $_POST['adminNumber'];
    $amail = $_POST['adminEmail'];
    $apass = $_POST['adminPass'];

    $sql = "INSERT INTO ofertante (nombreUsuario,telefono,emailOfertante,password) 
    VALUES(:alog,:atlf,:amail,:apass)";

    $query = $dbh->prepare($sql);
    $query->bindParam(':alog', $alog, PDO::PARAM_STR);
    $query->bindParam(':atlf', $atlf, PDO::PARAM_STR);
    $query->bindParam(':amail', $amail, PDO::PARAM_STR);
    $query->bindParam(':apass', $apass, PDO::PARAM_STR);
    $query->execute();

    $lastInsertId = $dbh->lastInsertId(); //devuelve un string representando el ID de la última fila que ha sido insertada

    if ($lastInsertId) {
        echo '<script>alert("Te has registrado satisfactoriamente...\nAhora puedes acceder como OFERTANTE");</script>';
    } else {
        echo '<script>alert("Algo ha ido mal. Prueba otra vez")</script>';
    }
}
?>

<script>

    function validaNombreUsuario() {
        // $("#loaderIcon").show();
        jQuery.ajax(
            {
                url: "admin/check/nombreUsuario.php",
                // data: 'fullname=' + $("#fullname").val(),
                data: 'adminNombreUsuario=' + $("#adminNombreUsuarioID").val(),
                type: "POST",
                success: function (data) {

                    if (data == "yaRegistrado") {
                        $("#adminNombreUsuariOK").html('<span style="color:red">Nombre de Usuario ya registrado!</span>');
                    } else if (data == '') {
                        $("#adminNombreUsuariOK").html("");
                    } else if (data == 'nombreUsuariOK') {
                        $("#adminNombreUsuariOK").html('<span style="color:green">Nombre de usuario disponible...</span>');
                    } else {
                        window.alert("SALGOOOOOOOOOOOOOO");
                    }
                    // $("#loaderIcon").hide();
                },
                error: function () { }
            });
    }
    // Comprueba diponibilidad del número de teléfono para el nuevo Ofertante
    function validaTlfAdmin() {

        var telef = new RegExp("^(\\+34|0034|34)?[6789]\\d{8}$");
        var valortelef = document.getElementById("adminNumberID").value;//input type=text

        if (!!valortelef) {

            if (telef.test(valortelef)) {
                jQuery.ajax({
                    url: "admin/check/phone.php",
                    data: 'adminNumber=' + $("#adminNumberID").val(),
                    type: "POST",
                    success: function (data) {
                        if (data == "nroYaRegistrado") {
                            $("#adminNumberOK").html('<span style="color:red">¡El teléfono introducido ya se encuentra registrado!</span>');
                        } else if (data == "tlfOK") {
                            $("#adminNumberOK").html('<span style="color:green">Telefono OK y disponible...</span>');
                        }
                    },
                    error: function () { }
                });
            } else {
                $("#adminNumberOK").html("<span style='color:red'>Error : No has introducido bien el teléfono</span>");
            }
        } else {
            $("#adminNumberOK").html("");
        }

    }

    // Comprueba y valida la disponibilidad del email para el nuevo Ofertante
    function validaEmailAdmin() {

        jQuery.ajax({
            url: "admin/check/email.php",
            data: 'adminEmail=' + $("#adminEmailID").val(),
            type: "POST",
            success: function (data) {

                if (data == 'emailMal') {
                    $("#adminEmailOK").html('<span style="color:red">Error : Email NO válido</span>');
                } else {
                    if (data == "yaRegistrado") {
                        $("#adminEmailOK").html('<span style="color:red">¡El email introducido ya se encuentra registrado!</span>');
                    } else if (data == '') {
                        $("#adminEmailOK").html("");
                    } else if (data == 'emailOK') {
                        $("#adminEmailOK").html('<span style="color:green">Email disponible...</span>');
                    } else {
                        window.alert("SALGOOOOOOOOOOOOOO");
                    }
                }
            },
            error: function () { }
        });

    }

    // Enciende el botón para crear el nuevo Ofertante cuando todo está OK
    function activaBotonAdmin() {

        let nombreUsuario = document.getElementById("adminNombreUsuariOK").innerText;
        let tlf = document.getElementById("adminNumberOK").innerText;
        let mail = document.getElementById("adminEmailOK").innerText;

        if (tlf == "Telefono OK y disponible..." && mail == "Email disponible..." && nombreUsuario == "Nombre de usuario disponible...") {
            $('#creaOfertanteID').prop('disabled', false);
            $('#creaOfertanteID').css('background-color', 'green');
        } else if (tlf == "" && mail == "" && nombreUsuario == "") {
            $('#creaOfertanteID').prop('disabled', true);
            $('#creaOfertanteID').css('background-color', '#428bca');
        } else {
            $('#creaOfertanteID').prop('disabled', true);
            $('#creaOfertanteID').css('background-color', 'red');
        }
    }

    window.onload = function () {

    }

</script>

<div class="modal fade" id="ofertanteSignupID" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

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

                                <h3>Crea una cuenta OFERTANTE</h3>

                                <form name="signupAdmin" method="POST">

                                    <!-- Nombre de Usuario del Ofertante -->
                                    <input type="text" name="adminNombreUsuario" id="adminNombreUsuarioID" class="form-control" onblur="validaNombreUsuario()"
                                        placeholder="Nombre de Usuario [Será tu login]" autocomplete="off" value=""
                                        required="">
                                    <span id="adminNombreUsuariOK" style="font-size:12px;"></span>

                                    <!-- Teléfono del Ofertante -->
                                    <input type="text" name="adminNumber" id="adminNumberID" class="form-control"
                                        placeholder="Número de teléfono" onBlur="validaTlfAdmin()" maxlength="10"
                                        autocomplete="off" value="" required="">
                                    <span id="adminNumberOK" style="font-size:12px;"></span>

                                    <!-- Email del Ofertante -->
                                    <input type="text" name="adminEmail" id="adminEmailID" class="form-control"
                                        placeholder="Correo electrónico" onBlur="validaEmailAdmin()" autocomplete="off"
                                        value="" required="">
                                    <span id="adminEmailOK" style="font-size:12px;"></span>

                                    <!-- Contraseña del Ofertante -->
                                    <input type="password" name="adminPass" class="form-control"
                                        placeholder="Contraseña" value="" required="">

                                    <div class="modal-footer text-right">
                                        <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Cancelar</button>

                                        <span onmouseover="activaBotonAdmin()">
                                            <button type="submit" name="creaOfertante" id="creaOfertanteID"
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