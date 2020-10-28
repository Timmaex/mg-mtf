<?php
	require("steamapi.php");
	require("rankvars.php");

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
		return mysqli_query($db, $sql);;
	}

	function isLoggedIn() {
		return isset($_SESSION["steamid"]);
	}

	function getFullMTFName($steamid) {
		$data = runQuery("SELECT * FROM mtf_character WHERE steamid='".$steamid."' LIMIT 1");
		if(mysqli_num_rows($data) == 0) { return "BENUTZER EXISTIERT NICHT"; }
		$row = mysqli_fetch_array($data);
		return ucfirst($row["job"]) . " " . strval($row["dienstnummer"]) . " \"" . $row["codename"]."\"";
	}

	function getSteamID32() {
		if(!isset($_SESSION["steamid"])) { return; }
   		$s32 = runQuery("SELECT steamid32 FROM mtf_user WHERE steamid64='".$_SESSION["steamid"]."'");
   		if(mysqli_num_rows($s32) == 0) { return; }
   		$s32 = mysqli_fetch_array($s32);
   		return $s32["steamid32"];
	}

	function getUserRank() {
		if(!isLoggedIn()) {return "r";}
		$data = runQuery("SELECT rank FROM mtf_character WHERE steamid='".getSteamID32()."'");
		if(mysqli_num_rows($data) == 0) { return "r"; }
		$data = mysqli_fetch_array($data);
		return $data["rank"];
	}

	function getRankByShortname($short) {
		global $rankByShort;
		return $rankByShort[$short];
	}

	function getRankIDByName($name) {
		global $RankIDByName;
		return $RankIDByName[$name];
	}

	function getRankByID($id) {
		global $rankByID;
		return $rankByID[$id];
	}

	function getFullJobname($job) {
		global $FullJobByJob;
		return $FullJobByJob[$job];
	}

	function seconds_format($seconds) {
	  $t = round($seconds);
	  return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
	}
?>