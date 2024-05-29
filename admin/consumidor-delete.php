<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');

if (isset($_GET['delid'])) {

    $cid = intval($_GET['delid']);

    $sql = "DELETE FROM consumidor WHERE idConsumidor=:cid";

    $query = $dbh->prepare($sql);
    $query->bindParam(':cid', $cid, PDO::PARAM_STR);
    $query->execute();

    echo "<script>window.alert('El Consumidor ha sido eliminado!');</script>";
    echo "<script>document.location = 'consumidor-gestion.php';</script>";
}
