<?php
include ('check/login.php');
check_login();

if (isset($_GET['delid'])) {

  $rid = intval($_GET['delid']);

  if ($rid == 1) {
    echo "<script>alert('No puedes bloquearte... Eres el desarrollador!');</script>";
  } else {

    $sql = "UPDATE ofertante SET enActivo = '0' WHERE idOfertante=:rid";

    $query = $dbh->prepare($sql);
    $query->bindParam(':rid', $rid, PDO::PARAM_STR);
    $query->execute();

    if ($query->execute()) {
      echo "<script>alert('Usuario bloqueado');</script>";
      echo "<script>window.location.href = 'ofertante-registro.php'</script>";
    } else {
      echo '<script>alert("Registro fallido")</script>';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <title>EscAppe Admin - Registrar Admin</title>
  <meta charset="UTF-8">
  <meta name="author" content="JaviER Fdez.">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- <link href="css/personal-admin.min.css" rel="stylesheet"> -->
  <link href="css/personal-admin.css" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet" />
  <link href="images/favicon/sole_ico.png" rel="shortcut icon" type="image/x-icon">
</head>

<body id="page-top">

  <div id="wrapper">

    <?php include ('includes/sidebar.php'); ?>

    <div id="content-wrapper" class="d-flex flex-column">

      <div id="content">

        <?php include ('includes/header.php'); ?>

        <div class="container-fluid" id="container-wrapper">

          <div class="row">

            <div class="col-lg-12">

              <div class="card mb4">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                  <h1 class="h3 mb-0 text-gray-800">Gestionar OFERTANTES</h1>

                  <div class="card-tools" style="float: right;">

                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#bloqueo">
                      Ofertantes Bloqueados
                    </button>

                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                      data-target="#ofertanteNuevo"><i class="fas fa-plus"></i>
                      Nuevo Admin
                    </button>

                  </div>
                </div>

                <div class="table-responsive p-3">

                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">

                    <thead class="thead-light">
                      <tr>
                        <th class="text-center">#</th>
                        <th class="">Usuario</th>
                        <th class="">Nombre Apellidos</th>
                        <th class="">Perfil</th>
                        <th class="">Email</th>
                        <th class="">Teléfono</th>
                        <th class="">Ubicación</th>
                        <th class="text-center">Registrado</th>
                        <th class="text-center" style="width: auto;">Acción</th>
                      </tr>
                    </thead>

                    <tbody>

                      <?php

                      $sql = "SELECT * FROM ofertante WHERE enActivo ='1'";

                      $query = $dbh->prepare($sql);
                      $query->execute();
                      $results = $query->fetchAll(PDO::FETCH_OBJ);
                      $cnt = 1;

                      if ($query->rowCount() > 0) {
                        foreach ($results as $row) {
                          ?>
                          <tr>
                            <!-- Nro -->
                            <td class="text-center">
                              <?php echo htmlentities($cnt); ?>
                            </td>
                            <!-- Nombre de Usuario -->
                            <td>
                              <?php echo htmlentities($row->nombreUsuario); ?>
                            </td>
                            <!-- Nombre y Apellidos -->
                            <td>
                              <?php echo htmlentities($row->nombre . " " . $row->apellidos); ?>
                            </td>
                            <!-- Perfil -->
                            <td>
                              <?php echo htmlentities($row->perfil); ?>
                            </td>
                            <!-- Email -->
                            <td>
                              <?php echo htmlentities($row->emailOfertante); ?>
                            </td>
                            <!-- Teléfono -->
                            <td class="text-center">
                              <?php echo htmlentities($row->telefono); ?>
                            </td>
                            <!-- Ubicación -->
                            <td class="text-center">
                              <?php echo htmlentities($row->ubicacion); ?>
                            </td>
                            <!-- Fecha de Registro -->
                            <td class="text-center">
                              <span>
                                <?php
                                if ($row->fechaRegistro) {
                                  echo date("d-m-Y", strtotime($row->fechaRegistro)) . "<br/>";
                                  echo date("H:i", strtotime($row->fechaRegistro));
                                } else {
                                  echo "- - - ";
                                }
                                ?>
                              </span>
                            </td>

                            <!-- Acción -->
                            <td class="text-center">

                              <a href="#" class="edit_data btn btn-sm btn-primary" id="<?php echo ($row->idOfertante); ?>"
                                title="Editar este Admin">Editar</a>

                              <a href="ofertante-registro.php?delid=<?php echo ($row->idOfertante); ?>"
                                onclick="return confirm('Seguro que quieres BLOQUEAR a <?php echo htmlentities($row->nombre . ' ' . $row->apellidos) ?>?');"
                                title="Bloquear este Admin" class="btn btn-sm btn-danger">Bloquear</a>

                            </td>
                          </tr>
                          <?php $cnt = $cnt + 1;
                        }
                      } ?>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include ('includes/footer.php'); ?>
    </div>
  </div>


  <div class="modal fade" id="bloqueo">
    <div class="modal-dialog modal-xl ">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Admin Bloqueados</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <?php @include ("ofertante-bloqueado.php"); ?>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="ofertanteNuevo">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nuevo Admin</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <?php @include ("ofertante-nuevo.php"); ?>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="editData">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar Admin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="info_update">
          <?php @include ("ofertante-update.php"); ?>
        </div>
      </div>
    </div>
  </div>


  <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

  <?php include ('includes/logout-modal.php'); ?>
  <?php include ('includes/quit-modal.php'); ?>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/personal-admin.min.js"></script>

  <!-- <script src="vendor/datatables/jquery.dataTables.min.js"></script> -->
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <script type="text/javascript">

    $(document).ready(function () {
      $(document).on('click', '.edit_data', function () {
        var edit_id = $(this).attr('id');
        $.ajax(
          {
            url: "ofertante-update.php",
            type: "POST",
            data: { edit_id: edit_id },

            success: function (data) {
              $("#info_update").html(data);
              $("#editData").modal('show');
            }

          });
      });
    });

    $(document).ready(function () {
      $('#dataTable').DataTable();
      $('#dataTableHover').DataTable();
    });

  </script>

</body>

</html>