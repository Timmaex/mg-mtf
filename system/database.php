<?php

    $rankByShort = array(
        "r" => "Rekrut",
        "pvt" => "Private",
        "pfc" => "Private First Class",
        "spc" => "Specialist",
        "lcpl" => "Lance Corporal",
        "cpl" => "Corporal",

        "sgt" => "Sergeant",
        "ssgt" => "Staff Sergeant",
        "sfc" => "Sergeant First Class",
        "fsg" => "First Sergeant",
        "sgm" => "Sergeant Major",
        "csm" => "Command Sergeant Major",

        "2lt" => "2. Lieutenant",
        "1lt" => "1. Lieutenant",
        "cpt" => "Captain",
        "maj" => "Major",
        "lcol" => "Lieutenant Colonel",
        "col" => "Colonel"
    );

	require("steamapi.php");
	session_start();
	$db = mysqli_connect("84.59.133.60", "mtf", "mImdfhoxdGM2mdpD", "mtf_site");

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

	function getFullMTFName($steamid) {
		$data = runQuery("SELECT * FROM mtf_character WHERE steamid='".$steamid."' LIMIT 1");
		$row = mysqli_fetch_array($data);
		return ucfirst($row["job"]) . " " . strval($row["dienstnummer"]) . " " . $row["codename"];
	}

?>

