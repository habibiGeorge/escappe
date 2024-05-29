<?php
require_once ("../includes/dbconnection.php");

// Comprueba la disponibilidad del email con respecto a escappebd
if (!empty($_POST["adminNombreUsuario"])) {

	$nombreusuario = $_POST["adminNombreUsuario"];
    
    $sql = "SELECT nombreUsuario FROM ofertante WHERE nombreUsuario =:nombreusuario";
		
        $query = $dbh->prepare($sql);
		$query->bindParam(':nombreusuario', $nombreusuario, PDO::PARAM_STR);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_OBJ);

		if ($query->rowCount() > 0) {
			echo 'yaRegistrado';
		} else {
			echo 'nombreUsuariOK';
		}
	
}