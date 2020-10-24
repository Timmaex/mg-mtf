<?php
	require("steamapi.php");
	session_start();
	$db = mysqli_connect("localhost", "mtf", "mImdfhoxdGM2mdpD", "mtf_site");

	if (!$db) {
	    echo "Fehler: konnte nicht mit MySQL verbinden." . PHP_EOL;
	    echo "Debug-Fehlernummer: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Debug-Fehlermeldung: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	}

	function runQuery($sql) {
		global $db;
		$db_res = mysqli_query($db, $sql);
		return $db_res;
	}

	function isLoggedIn() {
		return isset($_SESSION["steamid"]);
	}

?>

