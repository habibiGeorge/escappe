<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');

if (isset($_GET['delid'])) {

    $cid = intval($_GET['delid']);
    // Comprueba si existen otros Ofertantes asociados al Consumidor
    $sql4 = "SELECT idReserva FROM reserva WHERE idOfertante != :idofer AND idConsumidor = :cid
    UNION SELECT idDemanda FROM demanda WHERE idOfertante != :idofer AND idConsumidor = :cid";
    $query4 = $dbh->prepare($sql4);
    $query4->bindParam(':idofer', $_SESSION['adminid'], PDO::PARAM_STR);
    $query4->bindParam(':cid', $cid, PDO::PARAM_STR);
    $query4->execute();
    $results4 = $query4->fetchAll(PDO::FETCH_OBJ);

    // Condición para que NO se pueda borrar
    if ($query4->rowCount() > 0) {
        // echo "<script>window.alert('NO SE PUEDE BORRAR!');</script>";
        echo "<script>window.alert('Este Consumidor NO puede ser eliminado porque está asociado a otros OFERTANTES')</script>";
        echo "<script>document.location = 'consumidor-gestion.php';</script>";    
    } else {
        // echo "<script>window.alert('SE PUEDE BORRAR!');</script>";
        $sql = 'DELETE FROM consumidor WHERE idConsumidor=:cid';
        $query = $dbh->prepare($sql);
        $query->bindParam(':cid', $cid, PDO::PARAM_STR);
        $query->execute();
        echo "<script>window.alert('El Consumidor ha sido eliminado!');</script>";
        echo "<script>document.location = 'consumidor-gestion.php';</script>";
    }
}