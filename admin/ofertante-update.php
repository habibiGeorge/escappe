<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');

if (isset($_POST['adminUpdate'])) {

    $idadmin = $_SESSION['editid'];

    $nombre = $_POST['nombre'];
    $apllidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $sql4 = "UPDATE ofertante SET nombre=:nombre,apellidos=:apllidos,telefono=:telefono,emailOfertante=:email 
    WHERE idOfertante =:aid";

    $query4 = $dbh->prepare($sql4);
    $query4->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $query4->bindParam(':apllidos', $apllidos, PDO::PARAM_STR);
    $query4->bindParam(':email', $email, PDO::PARAM_STR);
    $query4->bindParam(':telefono', $telefono, PDO::PARAM_STR);

    $query4->bindParam(':aid', $idadmin, PDO::PARAM_STR);
    $query4->execute();

    if ($query4->execute()) {
        echo '<script>alert("El Perfil se ha actualizado correctamente")</script>';
        echo '<script>document.location = "ofertante-registro.php";</script>';
    } else {
        echo '<script>alert("La actualización ha fallado. Prueba otra vez")</script>';
    }
}
?>

<div class="card-body">

    <!-- <h4 class="card-title">Update User Form </h4> -->

    <form class="forms-sample" method="POST" class="form-horizontal" enctype="multipart/form-data">
        
        <?php

        $eid = $_POST['edit_id'];

        $sql = "SELECT * FROM ofertante WHERE idOfertante =:eid";

        $query = $dbh->prepare($sql);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;

        if ($query->rowCount() > 0) {

            foreach ($results as $row) {

                $_SESSION['editid'] = $row->idOfertante; ?>

                <div class="form-group">
                    <label for="exampleInputName1">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombreID"
                        value="<?php echo $row->nombre; ?>" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputName1">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" id="apellidosID"
                        value="<?php echo $row->apellidos; ?>" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputName1">Teléfono</label>
                    <input type="text" class="form-control" name="telefono" id="telefonoID" value="<?php echo $row->telefono; ?>"
                        required>
                </div>

                <div class="form-group">
                    <label for="exampleInputName1">Email</label>
                    <input type="text" class="form-control" name="email" id="emailID"
                        value="<?php echo $row->emailOfertante; ?>" required>
                </div>

                <?php $cnt = $cnt + 1;
            }
        } ?>

        <button type="submit" name="adminUpdate" class="btn btn-primary btn-fw mr-2">Actualizar</button>
        <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
    </form>
</div>