<?php
// Detalles para la conexión con la BBDD
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'escappebd');

// Conexión con la BBDD
try {
	$dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
} catch (PDOException $e) {
	exit("Error: " . $e->getMessage());
}