<?php
require_once ("../includes/dbconnection.php");

// Comprueba la disponibilidad del email con respecto a la bbdd
if (!empty($_POST["userEmail"])) {

	$umail = $_POST["userEmail"];

	if (filter_var($umail, FILTER_VALIDATE_EMAIL) === false) {

		echo 'emailMal';

	} else {
		
		$sql = "SELECT emailConsumidor FROM consumidor WHERE emailConsumidor=:umail";
		
		$query = $dbh->prepare($sql);
		$query->bindParam(':umail', $umail, PDO::PARAM_STR);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_OBJ);
		
		if ($query->rowCount() > 0) {
			echo 'yaRegistrado';
		} else {
			echo 'emailOK';
		}
	}
}