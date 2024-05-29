<script>
    // DELETE en la Tabla CONSUMIDOR
    function confirmaBaja() {
        if (window.confirm("¿Seguro que quieres DARTE DE BAJA?") == true) {
            window.location = "consumidor-quit.php";
        } else {
            // alert("Pareces indeciso");
            // document.location = "index.php";
        }
    }

</script>

<header class="header">

    <?php if ($_SESSION['entraConsumidor']) { ?>

        <div class="top-header">

            <div class="container">

                <ul class="tp-hd-lft wow fadeInLeft animated" data-wow-delay=".5s">
                    <!-- <li class="hm" id="consumerLog"><a href="index.php"><i class="fa fa-home"></i></a></li> -->
                    <li class="prnt" id="consumerLog"><a href="consumidor-perfil.php">Perfil</a></li>
                    <li class="prnt" id="consumerLog"><a href="consumidor-cambia-pass.php">Contraseña</a></li>
                    <li class="prnt" id="consumerLog"><a href="reserva-history.php">Reservas</a></li>
                    <li class="prnt" id="consumerLog"><a href="demanda-history.php">Demandas</a></li>
                    <li class="prnt" id="consumerLog"><a href="javascript:confirmaBaja()">Baja</a></li>
                </ul>

                <ul class="tp-hd-rgt wow fadeInRight animated" data-wow-delay=".5s">
                    <li>Hola</li>
                    <li>
                        <?php //echo htmlentities($_SESSION['entraConsumidor']); ?>
                        <?php echo htmlentities($_SESSION['nombreApellidos']); ?>
                    </li>
                    <li><a href="logout.php" onclick="return confirm('Realmente quieres SALIR?')">Salir</a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>

        <?php
    } else {
        ?>
        <div class="top-header">

            <div class="container">

                <ul class="tp-hd-lft wow fadeInLeft animated" data-wow-delay=".5s">
                    <li><a href="admin/login.php">Entra</a></li>
                    <li>OFERTANTE</li>
                    <li><a href="#" data-toggle="modal" data-target="#ofertanteSignupID">Regístrate</a></li>
                </ul>

                <ul class="tp-hd-rgt wow fadeInRight animated" data-wow-delay=".5s">
                    <li><a href="#" data-toggle="modal" data-target="#consumidorSignupID">Regístrate</a></li>
                    <li>CONSUMIDOR</li>
                    <li><a href="#" data-toggle="modal" data-target="#consumidorLoginID">Entra</a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php
    } ?>

    <div class="container">

        <nav class="navbar navbar-inverse" role="navigation">

            <a href="index.php">
                <img src="admin/images/logo/logo2_300px.png" alt="logo_sole" class="wow fadeInLeft animated logo_sole">
            </a>

            <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
                <span class="sr-only">Palanca de navegación</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <div id="main-nav" class="collapse navbar-collapse fadeInDown animated animated" data-wow-delay=".5s"
                style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">

                <ul class="nav navbar-nav" id="mainNav">
                    <li><a href="index.php#top" class="scroll-link">Inicio</a></li>
                    <li><a href="index.php#actividades" class="scroll-link">Actividades</a></li>
                    <li><a href="app-info.php" class="scroll-link">Sobre la App</a></li>
                    <li><a href="contact.php" class="scroll-link">Contacto</a></li>
                </ul>

            </div>
        </nav>
    </div>
</header>