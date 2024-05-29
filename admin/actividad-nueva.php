<?php
include ('includes/dbconnection.php');
include ('check/login.php');
check_login();

if (isset($_POST['nuevActividad'])) {

  $aname = $_POST['nombreActividad'];

  if (isset($_POST["selectCatName"]) && $_POST["selectCatName"] != "") {
    $acat = $_POST["selectCatName"];
    // echo '<script>alert("COJO DEL SELECT")</script>';
  } else {
    $acat = $_POST["nuevaCategoria"];
    // echo '<script>alert("COJO DEL AREAAA")</script>';
  }

  $acaract = $_POST['caracteristicActividad'];
  $adetails = $_POST['detallesActividad'];

  $alocation = $_POST['localizActividad'];
  $aprice = $_POST['precioActividad'];

  // EDITAR AQUÍ PARA AUMENTAR / DISMINUIR EL NRO. DE FECHAS | HORA
  for ($i = 0; $i <= 2; $i++) {
    if (isset($_POST['fechaHora' . $i])) {
      $fechasHora .= $_POST['fechaHora' . $i] . ",";
    }
  }

  $aduration = $_POST['durActividad'];

  $amax = $_POST['maxPlazas'];
  $amin = $_POST['minPlazas'];

  $amat = $_POST['materialNecesario'];

  if (isset($_POST['materialOfrecido'])) {
    $amatoffer = 1;
  } else {
    $amatoffer = 0;
  }

  $aplus = $_POST['plusMaterial'];

  if (isset($_POST['condicionFisica'])) {
    $aphysical = 1;
  } else {
    $aphysical = 0;
  }

  if (isset($_POST['transporte'])) {
    $atransport = 1;
  } else {
    $atransport = 0;
  }

  $aimage = "actividad/" . $_FILES["imagenActividad"]["name"];
  move_uploaded_file($_FILES["imagenActividad"]["tmp_name"], "images/actividad/" . $_FILES["imagenActividad"]["name"]);

  $idOfert = $_SESSION['adminid'];

  $sql = "INSERT INTO actividad (nombreActividad,categoria,localizacion,caracteristicas,detalles,
  fechasHora,duracion,tarifa,
  materialNecesario,materialOfrecido,plusMaterial,
  condicionFisica,transporte,
  maxPlazas,minPlazas,
  imagen,
  idOfertante)
  VALUES (:aname,:acat,:alocation,:acaract,:adetails,
  :fechasHora,:duracion,:aprice,
  :necesitaMat,:matofrecido,:plusmaterial,
  :condfisica,:transporte,
  :amax,:amin,
  :aimage,
  :idbidder)";

  $query = $dbh->prepare($sql);

  $query->bindParam(':aname', $aname, PDO::PARAM_STR);
  $query->bindParam(':acat', $acat, PDO::PARAM_STR);

  $query->bindParam(':acaract', $acaract, PDO::PARAM_STR);
  $query->bindParam(':adetails', $adetails, PDO::PARAM_STR);

  $query->bindParam(':alocation', $alocation, PDO::PARAM_STR);
  $query->bindParam(':aprice', $aprice, PDO::PARAM_STR);

  $query->bindParam(':fechasHora', $fechasHora, PDO::PARAM_STR);
  $query->bindParam(':duracion', $aduration, PDO::PARAM_STR);

  $query->bindParam(':amax', $amax, PDO::PARAM_STR);
  $query->bindParam(':amin', $amin, PDO::PARAM_STR);

  $query->bindParam(':necesitaMat', $amat, PDO::PARAM_STR);
  $query->bindParam(':matofrecido', $amatoffer, PDO::PARAM_STR);
  $query->bindParam(':plusmaterial', $aplus, PDO::PARAM_STR);

  $query->bindParam(':condfisica', $aphysical, PDO::PARAM_STR);
  $query->bindParam(':transporte', $atransport, PDO::PARAM_STR);

  $query->bindParam(':aimage', $aimage, PDO::PARAM_STR);
  $query->bindParam(':idbidder', $idOfert, PDO::PARAM_STR);

  $query->execute();

  $lastInsertId = $dbh->lastInsertId();

  if ($lastInsertId) {
    $msg = "ACTIVIDAD creada correctamente";
  } else {
    $error = "Algo ha ido mal... Inténtalo otra vez";
  }

}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <title>EscAppe Admin - Crea ACTIVIDAD</title>
  <meta charset="UTF-8">
  <meta name="author" content="JaviER Fdez.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <!-- <link href="css/personal-admin.min.css" rel="stylesheet"> -->
  <link href="css/personal-admin.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <link href="images/favicon/sole_ico.png" rel="shortcut icon" type="image/x-icon">

</head>

<body id="page-top">

  <div id="wrapper">

    <?php include ('includes/sidebar.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

        <?php include ('includes/header.php'); ?>

        <div class="container-fluid" id="container-wrapper">

          <h3 class="m-0 font-weight-bold text-primary">Nueva ACTIVIDAD</h3><br>

          <div class="row">

            <div class="col-lg-12">

              <form action="" class="form-sample" method="POST" enctype="multipart/form-data">

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

                <!-- nombre y categoria -->
                <div class="row">

                  <div class="form-group col-md-6">
                    <label class="col-sm-12 pl-0 pr-0">Nombre de la Actividad</label>
                    <div class="col-sm-12 pl-0 pr-0">
                      <input type="text" class="form-control" name="nombreActividad" id="nombreActividadID"
                        placeholder="Nombre...">
                    </div>
                  </div>

                  <div class="form-group col-md-6" id="categoriaDivID">

                    <label class="inputLabel">Categoría</label>
                    <select name="selectCatName" id="selectCatID" class="form-control form-fit">
                      <option value="">Selecciona / Introduce tú una...</option>

                      <?php
                      $sql4 = "SELECT DISTINCT categoria FROM actividad";
                      $query4 = $dbh->prepare($sql4);
                      $query4->execute();
                      $results4 = $query4->fetchAll(PDO::FETCH_OBJ);

                      if ($query4->rowCount() > 0) {
                        foreach ($results4 as $key => $result4) {
                          $categorias = $result4->categoria;
                          echo "<option value=" . $categorias . ">" . $categorias . "</option>";
                        }
                      }
                      ?>

                      <script>

                        const select = document.getElementById('selectCatID');

                        select.addEventListener('change', function () {

                          if (this.options[this.selectedIndex].value == "") {
                            $('#nuevaCategoriaID').prop('disabled', false);
                            $('#nuevaCategoriaID').prop('required', true);
                            $('#nuevaCategoriaID').prop('value', "");
                          } else {
                            // SI SE SELECCIONA UNA CATEGORIA YA EXISTENTE SE OCULTA EL TEXTAREA
                            $('#nuevaCategoriaID').prop('disabled', true);
                            $('#nuevaCategoriaID').prop('value', "Ya seleccionada...");
                          }
                        });

                      </script>

                    </select>

                    <div id="nuevaCategoriaDiv" class="form-group">
                      <div class="col-sm-12 pl-0 pr-0">
                        <input type="text" class="form-control" name="nuevaCategoria" id="nuevaCategoriaID"
                          placeholder="Nueva categoría">
                      </div>
                    </div>

                  </div>

                </div>

                <!-- Caracteristicas y Detalles -->
                <div class="row">

                  <div class="form-group col-md-6">
                    <label class="col-sm-12 pl-0 pr-0">Características</label>
                    <div class="col-sm-12 pl-0 pr-0">
                      <textarea class="form-control" rows="5" cols="50" name="caracteristicActividad"
                        id="caracteristicActividadID" placeholder="A destacar..."></textarea>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label class="col-sm-12 pl-0 pr-0">Detalles</label>
                    <div class="col-sm-12 pl-0 pr-0">
                      <textarea class="form-control" rows="5" cols="50" name="detallesActividad"
                        id="detallesActividadID" placeholder="En particular..."></textarea>
                    </div>
                  </div>

                </div>

                <!-- localizacion, tarifa -->
                <div class="row">

                  <div class="form-group col-md-6">
                    <label class="col-sm-12 pl-0 pr-0">Localización</label>
                    <div class="col-sm-12 pl-0 pr-0">
                      <input type="text" class="form-control" name="localizActividad" id="localizActividadID"
                        placeholder="Dónde se realiza...">
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label class="col-sm-12 pl-0 pr-0">Precios</label>
                    <div class="col-sm-12 pl-0 pr-0">
                      <input type="number" class="form-control" name="precioActividad" id="precioActividadID"
                        placeholder="En EUROS..." min="0.00" step="0.5">
                    </div>
                  </div>

                </div>

                <!-- fecha, hora, duracion -->
                <div class="row">

                  <script>

                    let contador = 0;

                    function delFn(e) {

                      $(e).parent('div').remove();
                      contador--;
                      $('#addFechaID' + (contador)).show();
                      $('#delFechaID' + (contador)).show();
                    }

                    function addFn() {

                      contador++;

                      const divEle = document.getElementById("fechaHoraDivID");
                      // const aOcultar = document.getElementById("addFechaID"+(contador-1));
                      $('#addFechaID' + (contador - 1)).hide();
                      $('#delFechaID' + (contador - 1)).hide();
                      // aOcultar.setAttribute('disabled','disabled');

                      const div2 = document.createElement("div");
                      divEle.appendChild(div2);
                      div2.innerHTML += "<br/>";

                      // input type datetime-local
                      const idt = document.createElement("input");
                      idt.setAttribute("type", "datetime-local");
                      // idt.classList.add("fechaHora");

                      idt.setAttribute('name', 'fechaHora' + contador);
                      idt.setAttribute('id', 'fechaHoraID' + contador);
                      idt.setAttribute('min', '<?php echo date('Y-m-d') ?>T00:00');
                      idt.setAttribute('value', '<?php echo date('Y-m-d') ?>T<?php echo date('H:i') ?>');
                      idt.setAttribute('required', 'required');

                      div2.appendChild(idt);
                      div2.innerHTML += "&nbsp;&nbsp;&nbsp;";

                      const btn1 = document.createElement("input");
                      btn1.setAttribute("type", "button");
                      btn1.setAttribute("class", "btn btn-secondary");
                      btn1.setAttribute('name', "addFecha" + contador);
                      btn1.setAttribute("id", "addFechaID" + contador);
                      btn1.setAttribute("onclick", "addFn()");
                      btn1.setAttribute("value", "Añadir");
                      if (contador < 2) {
                        div2.appendChild(btn1);
                      }

                      // let i = document.createElement('i');
                      // i.classList.add('fa', 'fa-plus');
                      // btn1.appendChild(i);

                      // $(this).append('<i class="fa fa-plus""></i>');
                      // const icon = document.createElement("i");
                      // icon.setAttribute("class","fa fa-plus");
                      // btn1.value = '<i class="fa fa-plus"></i>';
                      // btn1.appendChild('<i class="fa fa-plus"></i>');
                      // btn1.appendChild(icon);
                      // btn1.value("EOOOO");
                      // btn1.innerHTML('EOOOOO');

                      if (contador == 2) {
                        div2.innerHTML += "";
                      } else {
                        div2.innerHTML += "&nbsp;&nbsp;&nbsp;";
                      }
                      const btn2 = document.createElement("input");
                      btn2.setAttribute("type", "button");
                      btn2.setAttribute("class", "btn btn-danger");
                      btn2.setAttribute("name", "delFecha" + contador);
                      btn2.setAttribute("id", "delFechaID" + contador);
                      btn2.setAttribute("onclick", "delFn(this)");
                      btn2.setAttribute("value", "Quitar");
                      div2.appendChild(btn2);


                      // PARA PILLAR EL ICONO "+" DE fontawesome TAMBIÉN SE PUEDE HACER CON:
                      // divEle.innerHTML +=
                      // `<div>
                      // <input type="datetime-local" name="fechaHora" id="fechaHoraID">&nbsp;&nbsp;
                      // <button type="button" class="btn btn-secondary" onclick="addFn()" name="addFecha" id="addFechaID`+ contador + `">
                      //   <i class="fa fa-plus"></i>&nbsp;Añadir
                      // </button>
                      // <button type="button" class="btn btn-danger" onclick="delFn(this)" name="delFecha" id="delFechaID`+ contador + `">Quitar
                      // </button>
                      // </div>`;

                    }

                  </script>

                  <!-- FECHAS HORAS -->
                  <div class="form-group col-md-6">

                    <label class="col-sm-12 pl-0 pr-0">Fecha/s | Hora</label>

                    <div class="col-sm-12 pl-0 pr-0" id="fechaHoraDivID">

                      <input type="datetime-local" name="fechaHora0" id="fechaHoraID0"
                        value="<?php echo date('Y-m-d H:i') ?>" min="<?php echo date('Y-m-d') ?>T00:00"
                        required>&nbsp;&nbsp;

                      <button type="button" class="btn btn-secondary" onclick="addFn()" name="addFecha0"
                        id="addFechaID0">Añadir</button>
                    </div>

                  </div>

                  <div class="form-group col-md-6">
                    <label class="col-sm-12 pl-0 pr-0">Duración</label>
                    <div class="col-sm-12 pl-0 pr-0">
                      <input type="number" class="form-control" name="durActividad" id="durActividadID"
                        placeholder="En horas" step="0.25">
                    </div>
                  </div>
                </div>

                <!-- maxPlazas, minPlazas -->
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="col-sm-12 pl-0 pr-0">Número máximo de plazas</label>
                    <div class="col-sm-12 pl-0 pr-0">
                      <input type="number" class="form-control" name="maxPlazas" id="maxPlazasID" min="0" step="1">
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label class="col-sm-12 pl-0 pr-0">Número mínimo de plazas</label>
                    <div class="col-sm-12 pl-0 pr-0">
                      <input type="number" class="form-control" name="minPlazas" id="minPlazasID" min="0" step="1">
                    </div>
                  </div>
                </div>

                <!-- materialNecesario, materialOfrecido, plusMaterial, condicion fisica, transporte, imagen -->
                <div class="row">

                  <div class="form-group col-md-6">
                    <label class="col-sm-12 pl-0 pr-0">Material necesario para realizar la
                      Actividad</label>
                    <div class="col-sm-12 pl-0 pr-0">
                      <textarea class="form-control" rows="2" cols="50" name="materialNecesario"
                        id="materialNecesarioID" placeholder="Será necesario..."></textarea>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label class="col-sm-12 pl-0 pr-0" style="text-align: center;">Se ofrece el material</label>
                    <input type="checkbox" class="form-control" name="materialOfrecido" id="materialOfrecidoID"
                      onclick="plusMat()">
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-6"></div>

                  <div class="form-group col-md-6">
                    <label class="col-sm-12 pl-0 pr-0">Plus material (EUROS)</label>
                    <div class="col-sm-12 pl-0 pr-0">
                      <input type="number" class="form-control" name="plusMaterial" id="plusMaterialID"
                        placeholder="En Euros" min="0" step="0.25" value="">
                    </div>
                  </div>
                </div>

                <script>
                  if (document.getElementById('materialOfrecidoID').checked == false) {
                    document.getElementById('plusMaterialID').disabled = true;
                  } else {
                    document.getElementById('plusMaterialID').disabled = false;
                  }

                  function plusMat() {
                    if (document.getElementById('materialOfrecidoID').checked == true) {
                      document.getElementById('plusMaterialID').disabled = false;
                      document.getElementById('plusMaterialID').value = '';
                    } else {
                      document.getElementById('plusMaterialID').disabled = true;
                      document.getElementById('plusMaterialID').value = '0';
                    }
                  }                                        
                </script>

                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="col-sm-12 pl-0 pr-0" style="text-align: center;">Condición física
                      específica:</label>
                    <input type="checkbox" class="form-control" name="condicionFisica" id="condicionFisicaID">
                  </div>

                  <div class="form-group col-md-6">
                    <label class="col-sm-12 pl-0 pr-0" style="text-align: center;">Se necesita transporte para
                      llegar:</label>
                    <input type="checkbox" class="form-control" name="transporte" id="transporteID">
                  </div>
                </div>

                <div class="form-group col-md-4">
                  <label class="col-sm-12 pl-0 pr-0">Imagen asociada a la Actividad:</label>
                  <div class="col-sm-12 pl-0 pr-0">
                    <input type="file" name="imagenActividad" id="imagenActividadID" class="file-upload-default">
                  </div>
                </div>
            </div>
          </div>

          <button type="submit" name="nuevActividad" class="btn-primary btn">Crear</button>
          <button type="reset" class="btn-inverse btn">Reset</button>

          </form>

          <!-- </div> -->
        </div>
      </div>
    </div>
  </div>
  <?php include ('includes/footer.php'); ?>
  </div>
  </div>

  <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

  <?php include ('includes/logout-modal.php'); ?>
  <?php include ('includes/quit-modal.php'); ?>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/personal-admin.min.js"></script>

</body>

</html>