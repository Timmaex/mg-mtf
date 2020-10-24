<?php
	$MySQL = array(
		"host" => "127.0.0.1",
		"user" => "user",
		"database" => "db",
		"password" => "pw",
	);

	$db = mysqli_connect($MySQL["host"], $MySQL["user"], $MySQL["password"], $MySQL["database"]);

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

?>