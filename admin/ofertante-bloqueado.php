<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');

if (isset($_GET['restoreid'])) {
    
    $rid = intval($_GET['restoreid']);
    
    $sql = "UPDATE ofertante SET enActivo = '1' WHERE idOfertante = :rid";
    
    $query = $dbh->prepare($sql);
    $query->bindParam(':rid', $rid, PDO::PARAM_STR);
    $query->execute();

    if ($query->execute()) {
        echo "<script>alert('Admin en alta otra vez');</script>";
        echo "<script>window.location.href = 'ofertante-registro.php'</script>";
    } else {
        echo '<script>alert("Algo no ha ido bien")</script>';
    }

}

if (isset($_GET['deleteid'])) {
    
    $did = intval($_GET['deleteid']);
    
    $sql = "DELETE FROM ofertante WHERE idOfertante = :did";

    $query = $dbh->prepare($sql);
    $query->bindParam(':did', $did, PDO::PARAM_STR);
    $query->execute();

    if ($query->execute()) {
        echo "<script>alert('Admin Eliminado');</script>";
        echo "<script>window.location.href = 'ofertante-registro.php'</script>";
    } else {
        echo '<script>alert("Ha fallado la actualización")</script>';
    }

}

?>

<div class="card-body table-responsive p-3">

    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
        <thead>
            <tr>
                <th class="text-center"></th>
                <th class="">Nombre Usuario</th>
                <th class="">Teléfono</th>
                <th class="">Email</th>
                <th class="">Fecha Registro</th>
                <th class="" style="width: 15%;">Acción</th>
            </tr>
        </thead>

        <tbody>
            <?php
            
            $sql = "SELECT * FROM ofertante WHERE enActivo = '0'";

            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            $cnt = 1;

            if ($query->rowCount() > 0) {

                foreach ($results as $row) {
                    ?>
                    <tr>
                        <td class="text-center">
                            <?php echo htmlentities($cnt); ?>
                        </td>
                        <td class="font-w600">
                            <?php echo htmlentities($row->nombreUsuario); ?>
                        </td>
                        <td class="font-w600">
                            <?php echo htmlentities($row->telefono); ?>
                        </td>
                        <td class="font-w600">
                            <?php echo htmlentities($row->emailOfertante); ?>
                        </td>
                        <td class="font-w600">
                            <span class="badge badge-primary">
                                <?php echo htmlentities($row->fechaRegistro); ?>
                            </span>
                        </td>

                        <td class="">
                            <a href="ofertante-bloqueado.php?restoreid=<?php echo ($row->idOfertante); ?>"
                                onclick="return confirm('Realmente quieres reactivar este Admin?');"
                                title="Reactivar Admin" class="btn btn-success">ReActivar
                            </a>
                            <a href="ofertante-bloqueado.php?deleteid=<?php echo ($row->idOfertante); ?>"
                                onclick="return confirm('Realmente quieres eliminar este Admin?');"
                                title="Eliminar este Admin definitivamente?" class="btn btn-danger">Eliminar
                            </a>
                        </td>                        
                    </tr>
                    
                    <?php $cnt = $cnt + 1;
                }
            } ?>
        </tbody>
    </table>
</div>