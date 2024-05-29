<?php
session_start();
error_reporting(0);
include ('dbconnection.php');

if (isset($_SESSION['adminid'])) {

    $aid = intval($_SESSION['adminid']);
    $adminLogin = $_SESSION['entraOfertante'];
    
    if ($aid == '1' && $adminLogin == 'developer') {
        echo "<script>window.alert('Tú no puedes darte de BAJA porque eres el desarrollador!!');</script>";
        echo "<script>document.location = '../dashboard.php';</script>";
        
    } else {
        
        $sql = "DELETE FROM ofertante WHERE idOfertante =:aid";

        $query = $dbh->prepare($sql);
        $query->bindParam(':aid', $aid, PDO::PARAM_STR);
        $query->execute();

        echo "<script>window.alert('Tu cuenta Ofertante ha sido eliminada!');</script>";
        echo "<script>document.location = 'logout.php';</script>";
    }
}
