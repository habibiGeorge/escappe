<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');

if (isset($_GET['delid'])) {

    $oid = intval($_GET['delid']);

    $sql = "DELETE FROM ofertante WHERE idOfertante =:oid";

    $query = $dbh->prepare($sql);
    $query->bindParam(':oid', $oid, PDO::PARAM_STR);
    $query->execute();

    echo "<script>window.alert('El Ofertante ha sido eliminado!');</script>";
    echo "<script>document.location = 'ofertante-registro.php';</script>";
}
