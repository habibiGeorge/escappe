<?php
require_once ("../includes/dbconnection.php");

// Comprueba la disponibilidad del teléfono con respecto a la bbdd
if (!empty($_POST["userNumber"])) {

    $unumber = $_POST["userNumber"];

    $sql = "SELECT telefono FROM consumidor WHERE telefono=:unumber";
    
    $query = $dbh->prepare($sql);
    $query->bindParam(':unumber', $unumber, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        echo 'nroYaRegistrado';
    } else {
        echo 'tlfOK';
    }

}