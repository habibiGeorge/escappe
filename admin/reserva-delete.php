<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');

if (isset($_GET['delrid'])) {

    $rid = intval($_GET['delrid']);

    $sql = "DELETE FROM reserva WHERE idReserva =:rid";

    $query = $dbh->prepare($sql);
    $query->bindParam(':rid', $rid, PDO::PARAM_STR);
    $query->execute();

    echo "<script>window.alert('La Reserva ha sido eliminada');</script>";
    echo "<script>document.location = 'reserva-gestion.php';</script>";
}
