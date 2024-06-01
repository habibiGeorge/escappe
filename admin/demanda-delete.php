<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');

if (isset($_GET['deldid'])) {

    $rid = intval($_GET['deldid']);

    $sql = "DELETE FROM demanda WHERE idDemanda =:did";

    $query = $dbh->prepare($sql);
    $query->bindParam(':did', $rid, PDO::PARAM_STR);
    $query->execute();

    echo "<script>window.alert('La Demanda ha sido eliminada');</script>";
    echo "<script>document.location = 'demanda-gestion.php';</script>";
}
