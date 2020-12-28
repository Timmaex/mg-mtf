<?php
	require("steamapi.php");
	require("rankvars.php");

	session_start();

	$db = @mysqli_connect("90.186.122.152", "mtf", "mImdfhoxdGM2mdpD", "mtf_site");

	if (!$db) {
	    include("error/database.php");
	    die();
	}
	function runQuery($sql) {
		global $db;
		$res = mysqli_query($db, $sql);
		if(!$res) {
			echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>DEAD: ";
			echo mysqli_error($db);
			die();
		}
		return $res;
	}

	function getUserVar($steamid32, $var) {
		$res = runQuery("SELECT $var FROM mtf_user WHERE steamid32='$steamid32'");
		if(mysqli_num_rows($res) == 0) { return "User not found"; }
		$res = mysqli_fetch_array($res);
		return $res[$var];
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
		if(!isset($_SESSION["steamid"])) { return "error"; }
		return strval(toSteamID($_SESSION["steamid"]));
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


	function successBox($title, $text) {
		?>
        <br>
        <div style="width: 75%; margin-left: 12.5%;" class="alert alert-success col-12" role="alert">
          <h4 class="alert-heading"><?php echo $title; ?></h4>
          <p><?php echo $text; ?></p>
        </div>		
        <?php
	}

	function getTheme() {
		if(isLoggedIn()) {
			$data = runQuery("SELECT theme FROM mtf_user WHERE steamid32='".getSteamID32()."'");
			if(mysqli_num_rows($data) == 0) {
				return "default";
			}
			$data = mysqli_fetch_array($data);
			return $data["theme"];
		} else {
			return "default";
		}
	}

















	function humanTiming($time) {

	    $time = time() - $time; // to get the time since that moment
	    $time = ($time<1)? 1 : $time;
	    $tokens = array (
	        31536000 => 'Jahr',
	        2592000 => 'Monat',
	        604800 => 'Woche',
	        86400 => 'Tag',
	        3600 => 'Stunde',
	        60 => 'Minute',
	        1 => 'Sekunde'
	    );

	    foreach ($tokens as $unit => $text) {
	        if ($time < $unit) continue;
	        $numberOfUnits = floor($time / $unit);
	        return $numberOfUnits.' '.$text.(($text == "Monat")?'e':''.($text == "Jahr")?'e':''.($text == "Tag")?'e':''.($numberOfUnits>1)?'n':'');
	    }

	}

	function displayEntry($short, $time, $entry, $isAvailable, $offz_akte, $offz) {
		?>
			<div class="container">
				<br>
				<br>
				<div class="card">
				    <div class="card-body">
				        <div class="row" style="min-height: 184px;">
			        	    <div class="col-md-2">
			        	        <img src="<?php echo $offz["avatarfull"]; ?>" height="184px" width="184px" class="img img-rounded img-fluid"/>
			        	        <p class="text-secondary text-center">
			        	        	<?php echo date("d.m.Y H:i", $time); ?>
			        	        	<?php echo "<br>Vor ".humanTiming($time); ?>
			        	        </p>
			        	    </div>
			        	    <div class="col-md-10">
			        	        <p>
			        	            <a class="float-left" href="akte.php?user=<?php echo $entry["offz_steamid"]; ?>"><strong><?php if($isAvailable == false) {echo $entry["offz_name"]." (Nicht mehr im Dienst)"; } else { echo getFullMTFName($offz_akte["steamid"]); } ?></strong></a>
			        	            <a class="float-right text-danger" href="akte.php?user=<?php echo $entry["steamid"]."&".$short; ?>&delete=<?php echo $entry["id"]; ?>"><strong>Löschen</strong></a>
			            	    </p>
						        <div class="clearfix"></div>
						        <?php
						        	if($short == "promote") {
						        		echo "<strong>Beförderung von </strong>".$entry["offz_name"];
						        		echo "<br><strong>Alter Rang -> Neuer Rang: </strong>[".strtoupper(getRankByID(getRankIDByName($entry["append"])))."] => [".strtoupper($entry["value"])."]";
						        		echo "<br><strong>Grund: </strong>".$entry["text"];
						        	}
						        	if($short == "demote") {
						        		echo "<strong>Degradierung von </strong>".$entry["offz_name"];
						        		echo "<br><strong>Alter Rang -> Neuer Rang: </strong>[".strtoupper(getRankByID(getRankIDByName($entry["append"])))."] => [".strtoupper($entry["value"])."]";
						        		echo "<br><strong>Grund: </strong>".$entry["text"];
						        	}	
						        	if($short == "negative") {
						        		echo "<strong>Negativer Eintrag von </strong>".$entry["offz_name"];
						        		echo "<br><strong>Dauer: </strong>[ll]";
						        		echo "<br><strong>Grund: </strong>".$entry["text"];
						        	}
						        	if($short == "positive") {
						        		echo "<strong>Positiver Eintrag von </strong>".$entry["offz_name"];
						        		echo "<br><strong>Aktiv: </strong><span class='text-danger'>Nein</span>";
						        		echo "<br><strong>Grund: </strong>".$entry["text"];
						        	}						        	
						        ?>
				       	    </div>
				        </div>
				    </div>
				</div>
			</div>
		<?php
	}
?>