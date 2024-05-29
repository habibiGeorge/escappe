<?php
require_once ("../includes/dbconnection.php");

// Comprueba la disponibilidad del teléfono con respecto a escappebd
if (!empty($_POST["adminNumber"])) {

    $anumber = $_POST["adminNumber"];

    $sql = "SELECT telefono FROM ofertante WHERE telefono=:anumber";
    $query = $dbh->prepare($sql);
    $query->bindParam(':anumber', $anumber, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        echo 'nroYaRegistrado';
    } else {
        echo 'tlfOK';
    }
}