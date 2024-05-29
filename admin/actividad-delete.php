<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');

if (isset($_GET['delid'])) {

    $aid = intval($_GET['delid']);

    $sql = "DELETE FROM actividad WHERE idActividad=:aid";

    $query = $dbh->prepare($sql);
    $query->bindParam(':aid', $aid, PDO::PARAM_STR);
    $query->execute();

    echo "<script>window.alert('La Actividad ha sido eliminada');</script>";
    echo "<script>document.location = 'actividad-gestion.php';</script>";
}
