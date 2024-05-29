<?php
require_once ("../includes/dbconnection.php");

// Comprueba la disponibilidad del email con respecto a escappebd
if (!empty($_POST["adminEmail"])) {

	$amail = $_POST["adminEmail"];

	if (filter_var($amail, FILTER_VALIDATE_EMAIL) === false) {

		echo 'emailMal';
	
	} else {

		$sql = "SELECT emailOfertante FROM ofertante WHERE emailOfertante=:amail";
		$query = $dbh->prepare($sql);
		$query->bindParam(':amail', $amail, PDO::PARAM_STR);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_OBJ);

		if ($query->rowCount() > 0) {
			echo 'yaRegistrado';
		} else {
			echo 'emailOK';
		}
	}
}