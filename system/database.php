<?php
	require("steamapi.php");
	require("rankvars.php");

	session_start();

	$db = mysqli_connect("90.186.173.187", "mtf", "mImdfhoxdGM2mdpD", "mtf_site");

	if (!$db) {
	    echo "Fehler: konnte nicht mit MySQL verbinden." . PHP_EOL;
	    echo "Debug-Fehlernummer: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Debug-Fehlermeldung: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	}
	function runQuery($sql) {
		global $db;
		$res = mysqli_query($db, $sql);
		if(!$res) {
			echo mysqli_error($db);
		}
		return $res;
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

	function getUserRankBySteamID($sid) {
		$data = runQuery("SELECT rank FROM mtf_character WHERE steamid='".$sid."'");
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

	function isOffizier($r) {
		return $r == "2lt" or $r == "1lt" or $r == "cpt" or $r == "maj" or $r == "lcol" or $r == "col";
	}

	function seconds_format($seconds) {
	  $t = round($seconds);
	  return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
	}

	function minRankRequired($rank, $refuse) {
		$curRank = getUserRank();
		if(getRankIDByName($rank) > getRankIDByName($curRank)) {
			header("Location: ".$refuse);
		}
	}

	function hasRank($rank) {
		$curRank =  getRankIDByName(getUserRank());
		$rank =  getRankIDByName($rank);
		if($rank > $curRank) {
			return false;
		} else {
			return true;
		}
	}

	function isAdmin() {		//						 Kiwi									       Tron
		return isLoggedIn() && ($_SESSION["steamid"] == "76561198317965844" or $_SESSION["steamid"] == "76561198028226259") or false;
	}

	function errorBox($title, $text) {
		?>
        <br>
        <div style="width: 50%; margin-left: 25%;" class="alert alert-danger col-12" role="alert">
          <h4 class="alert-heading"><?php echo $title; ?></h4>
          <p><?php echo $text; ?></p>
        </div>		
        <?php
	}

?>