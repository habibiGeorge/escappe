<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');

if (!empty($_POST["adminNombreUsuario"])) {

    $nombreusuario = $_POST["adminNombreUsuario"];

    $sql = "SELECT nombreUsuario FROM ofertante WHERE nombreUsuario =:nombreusuario";

    $query = $dbh->prepare($sql);
    $query->bindParam(':nombreusuario', $nombreusuario, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;

    if ($query->rowCount() > 0) {
        echo "<script>alert('Ya existe ese Nombre de Usuario. Prueba con otro!');</script>";
    } else {

        if (isset($_POST['nuevoAdmin'])) {

            $perfil = $_POST['perfil'];
            $nombre = $_POST['nombre'];
            $apllidos = $_POST['apellidos'];
            $email = $_POST['adminEmail'];
            $telefono = $_POST['adminNumber'];            
            $password = $_POST['password'];
            $ubicacion = $_POST['ubicacion'];

            $sql = "INSERT INTO ofertante (nombreUsuario,perfil,nombre,apellidos,emailOfertante,telefono,password,ubicacion) 
            VALUES (:nombreusuario,:perfil,:nombre,:apllidos,:email,:telefono,:password,:ubicacion)";

            $query = $dbh->prepare($sql);
            $query->bindParam(':nombreusuario', $nombreusuario, PDO::PARAM_STR);
            $query->bindParam(':perfil', $perfil, PDO::PARAM_STR);
            $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $query->bindParam(':apllidos', $apllidos, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':telefono', $telefono, PDO::PARAM_STR);
            $query->bindParam(':password', $password, PDO::PARAM_STR);
            $query->bindParam(':ubicacion', $ubicacion, PDO::PARAM_STR);            
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();

            if ($lastInsertId) {
                echo "<script>alert('El registro se ha realizado correctamente');</script>";
                echo "<script>document.location = 'ofertante-registro.php';</script>";
            } else {
                echo "<script>alert('Algo ha ido mal. Inténtalo de nuevo');</script>";
            }
        }
    }
}

?>
<script type="text/javascript">

    function checkNombreUsuario() {

        jQuery.ajax(
            {
                url: "check/nombreUsuario.php",
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
                },
                error: function () { }
            });
    }

    function checkTlf() {

        var telef = new RegExp("^(\\+34|0034|34)?[6789]\\d{8}$");
        var valortelef = document.getElementById("adminNumberID").value;//input type=text

        if (!!valortelef) {

            if (telef.test(valortelef)) {
                jQuery.ajax({
                    url: "check/phone.php",
                    data: 'adminNumber=' + $("#adminNumberID").val(),
                    type: "POST",
                    success: function (data) {
                        if (data == "nroYaRegistrado") {
                            $("#adminNumberOK").html('<span style="color:red">Teléfono ya registrado!</span>');
                        } else if (data == "tlfOK") {
                            $("#adminNumberOK").html('<span style="color:green">Telefono OK y disponible...</span>');
                        }
                    },
                    error: function () { }
                });
            } else {
                $("#adminNumberOK").html("<span style='color:red'>Introduce un teléfono correcto</span>");
            }
        } else {
            $("#adminNumberOK").html("");
        }

    }

    function checkEmail() {

        jQuery.ajax(
            {
                url: "check/email.php",
                data: 'adminEmail=' + $("#adminEmailID").val(),
                type: "POST",
                success: function (data) {

                    if (data == 'emailMal') {
                        $("#adminEmailOK").html('<span style="color:red">Email NO válido</span>');
                    } else {
                        if (data == "yaRegistrado") {
                            $("#adminEmailOK").html('<span style="color:red">Email ya registrado!</span>');
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

    function activaBotonAdmin() {

        let nombreUsuario = document.getElementById("admiNombreUsuariOK").innerText;
        let tlf = document.getElementById("adminNumberOK").innerText;
        let mail = document.getElementById("adminEmailOK").innerText;

        if (tlf == "Telefono OK y disponible..." && mail == "Email disponible..." && nombreUsuario == "Nombre de usuario disponible...") {
            $('#nuevoAdminID').prop('disabled', false);
            $('#nuevoAdminID').css('background-color', 'green');
        } else if (tlf == "" && mail == "" && nombreUsuario == "") {
            $('#nuevoAdminID').prop('disabled', true);
            $('#nuevoAdminID').css('background-color', '#428bca');
        } else {
            $('#nuevoAdminID').prop('disabled', true);
            $('#nuevoAdminID').css('background-color', 'red');
        }
    }

    function validaPassConfirm() {
        if (document.signup.password.value != document.signup.confirmpassword.value) {
            alert("La Contraseña y su confirmación no coinciden!");
            document.signup.confirmpassword.focus();
            return false;
        }
        return true;
    }
</script>

<div class="card-body">

    <form method="POST" name="signup" onSubmit="return validaPassConfirm();">

        <div class="row">

            <div class="form-group col-md-6">
                <select class="form-control" name="perfil" id="perfilID" required>
                    <option value="">Tipo de perfil</option>
                    <option value="admin">Admin</option>
                    <option value="sadmin">superAdmin</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <input type="text" class="form-control" name="adminNombreUsuario" id="adminNombreUsuarioID"
                    placeholder="Nombre Usuario (Login)" onBlur="checkNombreUsuario()" required="required">
                <span id="adminNombreUsuariOK" style="font-size:12px;"></span>
            </div>

        </div>

        <div class="row">

            <div class="form-group col-md-6">
                <input type="text" class="form-control" name="nombre" placeholder="Nombre" required="required">
            </div>

            <div class="form-group col-md-6">
                <input type="text" class="form-control" name="apellidos" placeholder="Apellidos" required="required">
            </div>

        </div>

        <div class="row">

            <div class="form-group col-md-6">
                <input type="text" class="form-control" name="adminNumber" id="adminNumberID" onBlur="checkTlf()"
                    placeholder="Teléfono" maxlength="10" required="required">
                <span id="adminNumberOK" style="font-size:12px;"></span>
            </div>

            <div class="form-group col-md-6">
                <input type="email" class="form-control" name="adminEmail" id="adminEmailID" onBlur="checkEmail()"
                    placeholder="Email" required="required">
                <span id="adminEmailOK" style="font-size:12px;"></span>
            </div>

        </div>

        <div class="row">

            <div class="form-group col-md-6">
                <input type="password" class="form-control" name="password" placeholder="Contraseña"
                    required="required">
            </div>

            <div class="form-group col-md-6">
                <input type="password" class="form-control" name="confirmpassword" placeholder="Confirma Contraseña"
                    required="required">
            </div>

        </div>

        <div class="row">

            <div class="form-group col-md-6">
                <input type="text" class="form-control" name="ubicacion" id="ubicacionID" placeholder="Ubicación">
            </div>

            

        </div>
        <div class="form-group">
                <input type="submit" class="btn btn-info" name="nuevoAdmin" id="nuevoAdminID" value="Crear"
                    onmouseover="activaBotonAdmin()">
            </div>

    </form>
</div>