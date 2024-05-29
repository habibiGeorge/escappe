<?php
session_start();
error_reporting(0);
include ('includes/dbconnection.php');

if (isset($_SESSION['entraConsumidor'])) {

        if (isset($_SESSION['consumidorID'])) {

            $did = intval($_SESSION['consumidorID']);

            $sql = "DELETE FROM consumidor WHERE idConsumidor=:did";

            $query = $dbh->prepare($sql);
            $query->bindParam(':did', $did, PDO::PARAM_STR);
            $query->execute();

            echo "<script>window.alert('Tu cuenta CONSUMIDOR ha sido eliminada');</script>";
            echo "<script>document.location = 'logout.php';</script>";
        } else {
            echo "<script>window.alert('Algo ha ido mal... Prueba otra vez');</script>";
            echo "<script>document.location = 'index.php';</script>";
        }
    }