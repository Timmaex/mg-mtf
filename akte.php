<?php
	require("system/database.php");

	$header = "Personalakte";
	$subheader = "Hier findest du alle Einträge dieser Akte";

	require("system/navbar.php"); 

?>

<section class="page-section bg-light text-center" id="akte">

	<?php
		if(isLoggedIn() == true or isset($_GET["user"])) {

			if(!isset($_GET["user"])) {
				header("Location: akte.php?user=".getSteamID32());
			}

			$steamid = $_GET["user"];
			$test = runQuery("SELECT * FROM mtf_character WHERE steamid='".$steamid."'");
			if(mysqli_num_rows($test) == 0) {
				errorBox("Es ist ein Fehler aufgetreten!", "Die angegebene SteamID32 in der URL existiert nicht!");
				die();
			}

			// DEMOTE
			if(isset($_GET["demote"])) {

				$rank = getUserRankBySteamID($_GET["user"]);
				if(getRankIDByName($rank) < getRankIDByName(getUserRank()) or isAdmin()) {

					if(isset($_GET["text"])) {+
						$offz_steamid = getSteamID32();
						$name = getFullMTFName($offz_steamid);
						$time = strval(time());
						$text = $_GET["text"];
						$newRank = $_GET["rank"];

						$canDo = true;
						if($text == "" OR $newRank == "") {
							errorBox("Falsche Angaben!", "Deine Nachicht darf nicht leer sein!");
							$canDo = false;
						}

						if(getRankIDByName($canDemoteTo[getUserRank()]) >= getRankIDByName(getUserRankBySteamID($_GET["user"])) or isAdmin()) {
							if($canDo) {
								runQuery("INSERT INTO mtf_entries (steamid, offz_steamid, offz_name, time, text, type, value) VALUES ('".$steamid."', '".$offz_steamid."', '".$name."', '".$time."', '".$text."', 'demote', '".$newRank."')");
								runQuery("UPDATE mtf_character SET rank='".$newRank."' WHERE steamid='".$_GET["user"]."'");
								header("Location: akte.php?user=".$_GET["user"]."");
							}
						} else {
							errorBox("Falsche Angaben!", "Du kannst keinen ".getUserRankBySteamID($_GET["user"])." demoten!");
						}
						
					}

					?>
						<div class="text-center">
							<h2><?php echo getFullMTFName($_GET["user"]); ?> degradieren</h2>
							<a class="btn btn-primary" href="akte.php?user=<?php echo $_GET["user"]; ?>"><i class="fa fa-arrow-left mr-2"></i>Zurück</a>
							<br><br>
						</div>

						<form style="margin-right: 25%;">
						  <input type='hidden' name='user' value='<?php echo $_GET["user"]; ?>' />
						  <input type='hidden' name='demote' value='true' />
						  <div class="form-group row">
						    <label for="" class="col-4 col-form-label"></label> 
						    <div class="col-8">
						      <select id="" name="rank" class="custom-select" aria-describedby="HelpBlock">
			                    <?php
			                        $curRank = getUserRank();
			                        $can = $canDemoteTo[$curRank];
			                        $curRank = getRankIDByName(getUserRankBySteamID($_GET["user"]));
			                        if($can != "none") {
			                            $canID = getRankIDByName($can);
			                            if(isAdmin()) {
			                                $canID = 18;
			                            }

			                            for($i = 1; $i <= $curRank - 1; $i++) {
			                                echo '<option value="'.getRankByID($i).'">'.getRankByShortname(getRankByID($i)).'</option>';
			                            }
			                        }

			                    ?>
						      </select> 
						      <span id="HelpBlock" class="form-text text-muted">Wähle den Rang, auf den du <?php echo getFullMTFName($_GET["user"]); ?> demoten möchtest.</span>
						    </div>
						  </div>
						  <div class="form-group row">
						    <label for="text" class="col-4 col-form-label"></label> 
						    <div class="col-8">
						      <div class="input-group">
						        <div class="input-group-prepend">
						          <div class="input-group-text">
						            <i class="fa fa-comment mr-2"></i>Grund
						          </div>
						        </div> 
						        <input id="text" name="text" type="text" class="form-control" required="required" > 
						        <div class="input-group-append">
						          <button name="" type="submit" class="btn btn-primary input-group-text">Absenden</button>
						        </div>
						      </div>
						    </div>
						  </div> 

						</form>
					<?php




















				// Delete one
				if(isset($_GET["delete"])) {
					if(hasRank("2lt") or isAdmin()) {
						runQuery("DELETE FROM mtf_entries WHERE id='".$_GET["delete"]."'");
						//header("Location: akte.php?user=".$_GET["user"]."&demote");
						echo '<meta http-equiv="refresh" content = "0;url=akte.php?user='.$_GET["user"]."&demote".'">';
						return;
					}
				}
				$res = runQuery("SELECT * FROM mtf_entries WHERE steamid='".$_GET["user"]."' AND type='demote' ORDER BY id DESC");

				if(mysqli_num_rows($res) == 0) {
					?>
						<div class="text-center">
							<h3>Keine Einträge gefunden...</h3>
						</div>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
					<?php
					echo "</section>";
					require("system/footer.php");
					die();
				}

				while($entry = mysqli_fetch_assoc($res)) {
					$offz = runQuery("SELECT * FROM mtf_user WHERE steamid32='".$entry["offz_steamid"]."'");

					if(mysqli_num_rows($offz) == 0) {
						$offz = array(
							"avatarfull" => "assets/img/einheiten/pb_e6.png",
						);
					} else {
						$offz = mysqli_fetch_array($offz);
					}
					
					$offz_akte = runQuery("SELECT * FROM mtf_character WHERE steamid='".$entry["offz_steamid"]."'");
					$isAvailable = true;
					if(mysqli_num_rows($offz_akte) == 0) {
						$isAvailable = false;
					} else {
						$offz_akte = mysqli_fetch_array($offz_akte);
					}
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
						        	        	<?php echo date("d.m.Y H:i", $entry["time"]); ?>
						        	        	<?php echo "<br>Vor ".humanTiming($entry["time"]); ?>
						        	        </p>
					        	    </div>
					        	    <div class="col-md-10">
					        	        <p>
					        	            <a class="float-left" href="akte.php?user=<?php echo $entry["offz_steamid"]; ?>"><strong><?php if($isAvailable == false) {echo $entry["offz_name"]." (Nicht mehr im Dienst)"; } else { echo getFullMTFName($offz_akte["steamid"]); } ?></strong></a>
					        	            <a class="float-right text-danger" href="akte.php?user=<?php echo $entry["steamid"]; ?>&demote&delete=<?php echo $entry["id"]; ?>"><strong>Löschen</strong></a>
					        	       </p>
					        	       <div class="clearfix"></div>
					        	        <p><?php echo $entry["text"]; ?></p>
					        	    </div>
						        </div>
						    </div>
						</div>
					</div>
					<?php
				}





























					echo "</section>";
					require("system/footer.php");
					die();					
				}



			}



















































			// PROMOTE
			if(isset($_GET["promote"])) {
				$rank = getUserRankBySteamID($_GET["user"]);
				if(getRankIDByName($rank) < getRankIDByName(getUserRank()) or isAdmin()) {

					if(isset($_GET["text"])) {+
						$offz_steamid = getSteamID32();
						$name = getFullMTFName($offz_steamid);
						$time = strval(time());
						$text = $_GET["text"];
						$newRank = $_GET["rank"];

						$canDo = true;
						if($text == "" OR $newRank == "") {
							errorBox("Falsche Angaben!", "Deine Nachicht darf nicht leer sein!");
							$canDo = false;
						}

						if(getRankIDByName($canPromoteTo[getUserRank()]) >= getRankIDByName(getUserRankBySteamID($_GET["user"])) or isAdmin()) {
							if($canDo) {
								runQuery("INSERT INTO mtf_entries (steamid, offz_steamid, offz_name, time, text, type, value) VALUES ('".$steamid."', '".$offz_steamid."', '".$name."', '".$time."', '".$text."', 'promote', '".$newRank."')");
								runQuery("UPDATE mtf_character SET rank='".$newRank."' WHERE steamid='".$_GET["user"]."'");
								header("Location: akte.php?user=".$_GET["user"]."");
							}
						} else {
							errorBox("Falsche Angaben!", "Du kannst nicht höher als bis zum ".$canPromoteTo[getUserRank()]." befördern!");
						}
						
					}

					?>
						<div class="text-center">
							<h2><?php echo getFullMTFName($_GET["user"]); ?> befördern</h2>
							<a class="btn btn-primary" href="akte.php?user=<?php echo $_GET["user"]; ?>"><i class="fa fa-arrow-left mr-2"></i>Zurück</a>
							<br><br>
						</div>

						<form style="margin-right: 25%;">
						  <input type='hidden' name='user' value='<?php echo $_GET["user"]; ?>' />
						  <input type='hidden' name='promote' value='true' />
						  <div class="form-group row">
						    <label for="" class="col-4 col-form-label"></label> 
						    <div class="col-8">
						      <select id="" name="rank" class="custom-select" aria-describedby="HelpBlock">
			                    <?php
			                        $curRank = getUserRank();
			                        $can = $canPromoteTo[$curRank];
			                        $curRank = getRankIDByName(getUserRankBySteamID($_GET["user"]));
			                        if($can != "r") {
			                            $canID = getRankIDByName($can);
			                            if(isAdmin()) {
			                                $canID = 18;
			                            }

			                            for($i = $curRank + 1; $i <= $canID; $i++) {
			                                echo '<option value="'.getRankByID($i).'">'.getRankByShortname(getRankByID($i)).'</option>';
			                            }
			                        }

			                    ?>
						      </select> 
						      <span id="HelpBlock" class="form-text text-muted">Wähle den Rang, auf den du <?php echo getFullMTFName($_GET["user"]); ?> befördern möchtest.</span>
						    </div>
						  </div>
						  <div class="form-group row">
						    <label for="text" class="col-4 col-form-label"></label> 
						    <div class="col-8">
						      <div class="input-group">
						        <div class="input-group-prepend">
						          <div class="input-group-text">
						            <i class="fa fa-comment mr-2"></i>Grund
						          </div>
						        </div> 
						        <input id="text" name="text" type="text" class="form-control" required="required" > 
						        <div class="input-group-append">
						          <button name="" type="submit" class="btn btn-primary input-group-text">Absenden</button>
						        </div>
						      </div>
						    </div>
						  </div> 

						</form>
					<?php

					// Delete one
					if(isset($_GET["delete"])) {
						if(hasRank("2lt") or isAdmin()) {
							runQuery("DELETE FROM mtf_entries WHERE id='".$_GET["delete"]."'");
							echo '<meta http-equiv="refresh" content = "0;url=akte.php?user='.$_GET["user"]."&promote".'">';
						}
					}
					$res = runQuery("SELECT * FROM mtf_entries WHERE steamid='".$_GET["user"]."' AND type='promote' ORDER BY id DESC");

					if(mysqli_num_rows($res) == 0) {
						?>
							<div class="text-center">
								<h3>Keine Einträge gefunden...</h3>
							</div>
							<br>
							<br>
							<br>
							<br>
							<br>
							<br>
						<?php
						echo "</section>";
						require("system/footer.php");
						die();
					}

					while($entry = mysqli_fetch_assoc($res)) {
						$offz = runQuery("SELECT * FROM mtf_user WHERE steamid32='".$entry["offz_steamid"]."'");

						if(mysqli_num_rows($offz) == 0) {
							$offz = array(
								"avatarfull" => "assets/img/einheiten/pb_e6.png",
							);
						} else {
							$offz = mysqli_fetch_array($offz);
						}
						
						$offz_akte = runQuery("SELECT * FROM mtf_character WHERE steamid='".$entry["offz_steamid"]."'");
						$isAvailable = true;
						if(mysqli_num_rows($offz_akte) == 0) {
							$isAvailable = false;
						} else {
							$offz_akte = mysqli_fetch_array($offz_akte);
						}
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
						        	        	<?php echo date("d.m.Y H:i", $entry["time"]); ?>
						        	        	<?php echo "<br>Vor ".humanTiming($entry["time"]); ?>
						        	        </p>
						        	    </div>
						        	    <div class="col-md-10">
						        	        <p>
						        	            <a class="float-left" href="akte.php?user=<?php echo $entry["offz_steamid"]; ?>"><strong><?php if($isAvailable == false) {echo $entry["offz_name"]." (Nicht mehr im Dienst)"; } else { echo getFullMTFName($offz_akte["steamid"]); } ?></strong></a>
						        	            <a class="float-right text-danger" href="akte.php?user=<?php echo $entry["steamid"]; ?>&promote&delete=<?php echo $entry["id"]; ?>"><strong>Löschen</strong></a>
						        	       </p>
						        	       <div class="clearfix"></div>
						        	        <p><?php echo $entry["text"]; ?></p>
						        	    </div>
							        </div>
							    </div>
							</div>
						</div>
						<?php
					}

					echo "</section>";
					require("system/footer.php");
					die();					
				}
			}






























			// Negative entry
			if(isset($_GET["negative"])) {
				$rank = getUserRankBySteamID($_GET["user"]);
				if(getRankIDByName($rank) < getRankIDByName(getUserRank()) or isAdmin()) {

					if(isset($_GET["comment"])) {
						$offz_steamid = getSteamID32();
						$name = getFullMTFName($offz_steamid);
						$time = strval(time());
						$text = $_GET["comment"];
						$canDo = true;
						if($text == "") {
							errorBox("Falsche Angaben!", "Deine Nachicht darf nicht leer sein!");
							$canDo = false;
						}

						if($canDo) {
							runQuery("INSERT INTO mtf_entries (steamid, offz_steamid, offz_name, time, text, type, value) VALUES ('".$steamid."', '".$offz_steamid."', '".$name."', '".$time."', '".$text."', 'negative', '')");
							header("Location: akte.php?user=".$steamid."");
						}						
					}

					?>
						<div class="text-center">
							<h2><?php echo getFullMTFName($_GET["user"]); ?> ist also negativ aufgefallen, hm?</h2>
							<a class="btn btn-primary" href="akte.php?user=<?php echo $_GET["user"]; ?>"><i class="fa fa-arrow-left mr-2"></i>Nein, doch nicht...</a>
							<br><br>
						</div>
		                <form style="margin-left: 25%;">
		                  <input type='hidden' name='user' value='<?php echo $_GET["user"]; ?>' />
		                  <input type='hidden' name='negative' value='true' />
		                  <div class="form-group row">
		                    <div class="col-8">
		                      <div class="input-group">
		                        <div class="input-group-prepend">
		                          <div class="input-group-text">
		                            <i class="fa fa-comment mr-2"></i>Grund
		                          </div>
		                        </div> 
		                        <input id="comment" name="comment" type="text" class="form-control" autocomplete="off" placeholder="Wieso ist <?php echo htmlspecialchars(getFullMTFName($_GET["user"])); ?> positiv aufgefallen?"> 
		                        <div style="width: 76%;" class="result bg-dark text-white"></div>                        
		                        <div class="input-group-append">
		                          <button name="" type="submit" class="btn btn-primary input-group-text">Absenden</button>
		                        </div>

		                      </div>
		                    </div>
		                  </div> 
		                </form>
					<?php

					// Delete one
					if(isset($_GET["delete"])) {
						if(hasRank("2lt") or isAdmin()) {
							runQuery("DELETE FROM mtf_entries WHERE id='".$_GET["delete"]."'");
							echo '<meta http-equiv="refresh" content = "0;url=akte.php?user='.$_GET["user"]."&negative".'">';
						}
					}
					$res = runQuery("SELECT * FROM mtf_entries WHERE steamid='".$_GET["user"]."' AND type='negative' ORDER BY id DESC");

					if(mysqli_num_rows($res) == 0) {
						?>
							<div class="text-center">
								<h3>Keine Einträge gefunden...</h3>
							</div>
							<br>
							<br>
							<br>
							<br>
							<br>
							<br>
						<?php
						echo "</section>";
						require("system/footer.php");
						die();
					}

					while($entry = mysqli_fetch_assoc($res)) {
						$offz = runQuery("SELECT * FROM mtf_user WHERE steamid32='".$entry["offz_steamid"]."'");

						if(mysqli_num_rows($offz) == 0) {
							$offz = array(
								"avatarfull" => "assets/img/einheiten/pb_e6.png",
							);
						} else {
							$offz = mysqli_fetch_array($offz);
						}
						
						$offz_akte = runQuery("SELECT * FROM mtf_character WHERE steamid='".$entry["offz_steamid"]."'");
						$isAvailable = true;
						if(mysqli_num_rows($offz_akte) == 0) {
							$isAvailable = false;
						} else {
							$offz_akte = mysqli_fetch_array($offz_akte);
						}
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
						        	        	<?php echo date("d.m.Y H:i", $entry["time"]); ?>
						        	        	<?php echo "<br>Vor ".humanTiming($entry["time"]); ?>
						        	        </p>
						        	    </div>
						        	    <div class="col-md-10">
						        	        <p>
						        	            <a class="float-left" href="akte.php?user=<?php echo $entry["offz_steamid"]; ?>"><strong><?php if($isAvailable == false) {echo $entry["offz_name"]." (Nicht mehr im Dienst)"; } else { echo getFullMTFName($offz_akte["steamid"]); } ?></strong></a>
						        	            <a class="float-right text-danger" href="akte.php?user=<?php echo $entry["steamid"]; ?>&negative&delete=<?php echo $entry["id"]; ?>"><strong>Löschen</strong></a>
						        	       </p>
						        	       <div class="clearfix"></div>
						        	        <p><?php echo $entry["text"]; ?></p>
						        	    </div>
							        </div>
							    </div>
							</div>
						</div>
						<?php
					}

					echo "</section>";
					require("system/footer.php");
					die();					
				}
			}

			// Positive entry
			if(isset($_GET["positive"])) {
				$rank = getUserRankBySteamID($_GET["user"]);
				if(getRankIDByName($rank) < getRankIDByName(getUserRank()) or isAdmin()) {

					if(isset($_GET["comment"])) {
						$offz_steamid = getSteamID32();
						$name = getFullMTFName($offz_steamid);
						$time = strval(time());
						$text = $_GET["comment"];
						$canDo = true;
						if($text == "") {
							errorBox("Falsche Angaben!", "Deine Nachicht darf nicht leer sein!");
							$canDo = false;
						}

						if($canDo) {
							runQuery("INSERT INTO mtf_entries (steamid, offz_steamid, offz_name, time, text, type, value) VALUES ('".$steamid."', '".$offz_steamid."', '".$name."', '".$time."', '".$text."', 'positive', '')");
							header("Location: akte.php?user=".$steamid."");
						}						
					}

					?>
						<div class="text-center">
							<h2><?php echo getFullMTFName($_GET["user"]); ?> ist also positiv aufgefallen, hm?</h2>
							<a class="btn btn-primary" href="akte.php?user=<?php echo $_GET["user"]; ?>"><i class="fa fa-arrow-left mr-2"></i>Nein, doch nicht...</a>
							<br><br>
						</div>
		                <form style="margin-left: 25%;">
		                  <input type='hidden' name='user' value='<?php echo $_GET["user"]; ?>' />
		                  <input type='hidden' name='positive' value='true' />
		                  <div class="form-group row">
		                    <div class="col-8">
		                      <div class="input-group">
		                        <div class="input-group-prepend">
		                          <div class="input-group-text">
		                            <i class="fa fa-comment mr-2"></i>Grund
		                          </div>
		                        </div> 
		                        <input id="comment" name="comment" type="text" class="form-control" autocomplete="off" placeholder="Wieso ist <?php echo htmlspecialchars(getFullMTFName($_GET["user"])); ?> positiv aufgefallen?"> 
		                        <div style="width: 76%;" class="result bg-dark text-white"></div>                        
		                        <div class="input-group-append">
		                          <button name="" type="submit" class="btn btn-primary input-group-text">Absenden</button>
		                        </div>

		                      </div>
		                    </div>
		                  </div> 
		                </form>
					<?php
					// Delete one
					if(isset($_GET["delete"])) {
						if(hasRank("2lt") or isAdmin()) {
							runQuery("DELETE FROM mtf_entries WHERE id='".$_GET["delete"]."'");
							echo '<meta http-equiv="refresh" content = "0;url=akte.php?user='.$_GET["user"]."&positive".'">';
						}
					}
					$res = runQuery("SELECT * FROM mtf_entries WHERE steamid='".$_GET["user"]."' AND type='positive' ORDER BY id DESC");

					if(mysqli_num_rows($res) == 0) {
						?>
							<div class="text-center">
								<h3>Keine Einträge gefunden...</h3>
							</div>
							<br>
							<br>
							<br>
							<br>
							<br>
							<br>
						<?php
						echo "</section>";
						require("system/footer.php");
						die();
					}

					while($entry = mysqli_fetch_assoc($res)) {
						$offz = runQuery("SELECT * FROM mtf_user WHERE steamid32='".$entry["offz_steamid"]."'");

						if(mysqli_num_rows($offz) == 0) {
							$offz = array(
								"avatarfull" => "assets/img/einheiten/pb_e6.png",
							);
						} else {
							$offz = mysqli_fetch_array($offz);
						}
						
						$offz_akte = runQuery("SELECT * FROM mtf_character WHERE steamid='".$entry["offz_steamid"]."'");
						$isAvailable = true;
						if(mysqli_num_rows($offz_akte) == 0) {
							$isAvailable = false;
						} else {
							$offz_akte = mysqli_fetch_array($offz_akte);
						}
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
						        	        	<?php echo date("d.m.Y H:i", $entry["time"]); ?>
						        	        	<?php echo "<br>Vor ".humanTiming($entry["time"]); ?>
						        	        </p>
						        	    </div>
						        	    <div class="col-md-10">
						        	        <p>
						        	            <a class="float-left" href="akte.php?user=<?php echo $entry["offz_steamid"]; ?>"><strong><?php if($isAvailable == false) {echo $entry["offz_name"]." (Nicht mehr im Dienst)"; } else { echo getFullMTFName($offz_akte["steamid"]); } ?></strong></a>
						        	            <a class="float-right text-danger" href="akte.php?user=<?php echo $entry["steamid"]; ?>&positive&delete=<?php echo $entry["id"]; ?>"><strong>Löschen</strong></a>
						        	       </p>
						        	       <div class="clearfix"></div>
						        	        <p><?php echo $entry["text"]; ?></p>
						        	    </div>
							        </div>
							    </div>
							</div>
						</div>
						<?php
					}
					echo "</section>";
					require("system/footer.php");
					die();					
				}

			}









			// Hidden entries
			if(isset($_GET["hidden"])) {
				if(!isAdmin()) {
					minRankRequired("maj", "akte.php?user=".$_GET["user"]);
				}

				if(isset($_GET["delete"])) {
					if(hasRank("2lt") or isAdmin()) {
						runQuery("DELETE FROM mtf_entries WHERE id='".$_GET["delete"]."'");
						header("Location: akte.php?user=".$_GET["user"]."&hidden");
					}
				}

				// Submit
				if(isset($_GET["comment"])) {
					$steamid = $_GET["user"];
					$test = runQuery("SELECT * FROM mtf_character WHERE steamid='".$steamid."'");
					if(mysqli_num_rows($test) == 0) {
						errorBox("Es ist ein Fehler aufgetreten!", "Die angegebene SteamID32 in der URL existiert nicht!");
						die();
					}
					$offz_steamid = getSteamID32();
					$name = getFullMTFName($offz_steamid);
					$time = strval(time());
					$text = $_GET["comment"];
					$canDo = true;
					if($text == "") {
						errorBox("Falsche Angaben!", "Deine Nachicht darf nicht leer sein!");
						$canDo = false;
					}

					if($canDo) {
						runQuery("INSERT INTO mtf_entries (steamid, offz_steamid, offz_name, time, text, type, value) VALUES ('".$steamid."', '".$offz_steamid."', '".$name."', '".$time."', '".$text."', 'hidden', '')");
						header("Location: akte.php?user=".$steamid."&hidden");
					}
				}

				?>
					<div class="text-center">
						<h2>Akte von <?php echo getFullMTFName($_GET["user"]); ?></h2>
						<a class="btn btn-primary" href="akte.php?user=<?php echo $_GET["user"]; ?>"><i class="fa fa-arrow-left mr-2"></i>Zurück</a>
						<br><br>
					</div>
	                <form style="margin-left: 25%;">
	                  <input type='hidden' name='user' value='<?php echo $_GET["user"]; ?>' />
	                  <input type='hidden' name='hidden' value='true' />
	                  <div class="form-group row">
	                    <div class="col-8">
	                      <div class="input-group">
	                        <div class="input-group-prepend">
	                          <div class="input-group-text">
	                            <i class="fa fa-comment mr-2"></i>Eintrag
	                          </div>
	                        </div> 
	                        <input id="comment" name="comment" type="text" class="form-control" autocomplete="off" placeholder="Eintrag hinzufügen"> 
	                        <div style="width: 76%;" class="result bg-dark text-white"></div>                        
	                        <div class="input-group-append">
	                          <button name="" type="submit" class="btn btn-primary input-group-text">Absenden</button>
	                        </div>

	                      </div>
	                    </div>
	                  </div> 
	                </form>
				<?php

				$res = runQuery("SELECT * FROM mtf_entries WHERE steamid='".$_GET["user"]."' AND type='hidden' ORDER BY id DESC");

				if(mysqli_num_rows($res) == 0) {
					?>
						<div class="text-center">
							<h3>Keine Einträge gefunden...</h3>
						</div>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
					<?php
					echo "</section>";
					require("system/footer.php");
					die();
				}

				while($entry = mysqli_fetch_assoc($res)) {
					$offz = runQuery("SELECT * FROM mtf_user WHERE steamid32='".$entry["offz_steamid"]."'");

					if(mysqli_num_rows($offz) == 0) {
						$offz = array(
							"avatarfull" => "assets/img/einheiten/pb_e6.png",
						);
					} else {
						$offz = mysqli_fetch_array($offz);
					}
					
					$offz_akte = runQuery("SELECT * FROM mtf_character WHERE steamid='".$entry["offz_steamid"]."'");
					$isAvailable = true;
					if(mysqli_num_rows($offz_akte) == 0) {
						$isAvailable = false;
					} else {
						$offz_akte = mysqli_fetch_array($offz_akte);
					}
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
						        	        	<?php echo date("d.m.Y H:i", $entry["time"]); ?>
						        	        	<?php echo "<br>Vor ".humanTiming($entry["time"]); ?>
						        	        </p>
					        	    </div>
					        	    <div class="col-md-10">
					        	        <p>
					        	            <a class="float-left" href="akte.php?user=<?php echo $entry["offz_steamid"]; ?>"><strong><?php if($isAvailable == false) {echo $entry["offz_name"]." (Nicht mehr im Dienst)"; } else { echo getFullMTFName($offz_akte["steamid"]); } ?></strong></a>
					        	            <a class="float-right text-danger" href="akte.php?user=<?php echo $entry["steamid"]; ?>&hidden&delete=<?php echo $entry["id"]; ?>"><strong>Löschen</strong></a>
					        	       </p>
					        	       <div class="clearfix"></div>
					        	        <p><?php echo $entry["text"]; ?></p>
					        	    </div>
						        </div>
						    </div>
						</div>
					</div>
					<?php
				}

				echo "</section>";
				require("system/footer.php");
				return;
			}

            $kek = runQuery("SELECT * FROM mtf_character WHERE steamid='".$_GET["user"]."'");

            if(mysqli_num_rows($kek) == 0) {
            	errorBox("Es ist ein Fehler aufgetreten!", "Die angegebene SteamID32 in der URL existiert nicht!");
            	echo "<br><br><br><br><br><br><br><br><br><br><br><br>";
            	require("system/footer.php");
            	die();
            }

            $kekw = array();

            while($row = mysqli_fetch_assoc($kek)) {
            	$kekw = $row;
                $user = runQuery("SELECT * FROM mtf_user WHERE steamid32='".$row["steamid"]."'");
                if(mysqli_num_rows($user) == 0) {
                    $user = array(
                        "avatarfull" => "assets/img/einheiten/pb_".$row["job"].".png",
                        "mg_profile" => "",
                        "url" => "",
                    );
                } else {
                    $user = mysqli_fetch_array($user);
                }


                ?>
                    <div class="container">
                      <div class="content border border-primary rounded" style=" height: auto; padding: 25px;">
                        <center>
                          <div class="media position-relative">
                            <img width="184px" height="184px" src="<?php echo $user["avatarfull"]; ?>" class="rounded border border-primary" alt="">
                            <div class="media-body" style="height: 184px;">
                              <div class="text-center" style="height: 184px;">
                                <h2 class="section-heading"><?php echo getFullMTFName($row["steamid"]); ?></h2>
                                <h3 class="section-subheading text-muted"><?php echo getRankByShortname($row["rank"])." | MTF ".getFullJobName($row["job"]); ?></h3>
                              </div>
	                            <div class="btn-group" role="group">
	                              <?php
	                              if($user["url"] != "") {
	                              ?>
	                                <a type="button" role="button" target="_blank" href="<?php echo $user["url"] ?>" class="btn btn-secondary"><i class="fab fa-steam"></i>  Steamprofil</a>
	                              <?php
	                              }
	                              if($user["mg_profile"] != "") {
	                                echo '<a type="button" target="_blank" href="'.$user["mg_profile"].'" class="btn btn-info"><i class="fa fa-sitemap"></i>  MG-Forum</a>';
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
            <br>
            <div class="text-center">
            <div class="btn-group float-middle" role="group">
            <?php
            $curRank = getRankIDByName(getUserRank());
            $aktenRank = $kekw["rank"];
	        $positives = runQuery("SELECT * FROM mtf_entries WHERE steamid='".$_GET["user"]."' AND type='positive'");
	        $positives = mysqli_num_rows($positives);
	        if(($curRank > getRankIDByName($aktenRank) OR isAdmin())) {
	            echo '<a href="akte.php?user='.$_GET["user"].'&positive"  class="btn btn-success" role="button" aria-pressed="true"><i class="fa fa-thumbs-up"></i>  Positiv aufgefallen  <span class="badge badge-light">'.strval($positives).'</span></a>';
	        }
	        $promotes = runQuery("SELECT * FROM mtf_entries WHERE steamid='".$_GET["user"]."' AND type='promote'");
	        $promotes = mysqli_num_rows($promotes);
	        $negatives = runQuery("SELECT * FROM mtf_entries WHERE steamid='".$_GET["user"]."' AND type='negative'");
	        $negatives = mysqli_num_rows($negatives);
	        if(getRankIDByName($aktenRank) <= getRankIDByName($canPromoteTo[getUserRank()]) OR isAdmin() AND ($aktenRank != "col") or isAdmin()) {
	            echo '<a href="akte.php?user='.$_GET["user"].'&promote"  class="btn btn-primary" role="button" aria-pressed="true"><i class="fa fa-plus-square"></i>  Befördern  <span class="badge badge-light">'.strval($promotes).'</span></a>';
	            echo '<a href="akte.php?user='.$_GET["user"].'&negative"  class="btn btn-danger" role="button" aria-pressed="true"><i class="fa fa-thumbs-down"></i>  Negativ aufgefallen  <span class="badge badge-light">'.strval($negatives).'</span></a>';
	        }
	        $demotes = runQuery("SELECT * FROM mtf_entries WHERE steamid='".$_GET["user"]."' AND type='demote'");
	        $demotes = mysqli_num_rows($demotes);
	        if($curRank > getRankIDByName($aktenRank) OR isAdmin()) {
	            echo '<a href="akte.php?user='.$_GET["user"].'&demote"  class="btn btn-danger" role="button" aria-pressed="true"><i class="fa fa-minus-square"></i>  Degradieren  <span class="badge badge-light">'.strval($demotes).'</span></a>';
	        }
	        $hiddenentry = runQuery("SELECT * FROM mtf_entries WHERE steamid='".$_GET["user"]."' AND type='hidden'");
	        $hiddenentry = mysqli_num_rows($hiddenentry);
	        if(hasRank("maj") OR isAdmin()) {
	            echo '<a href="akte.php?user='.$_GET["user"].'&hidden"  class="btn btn-secondary" role="button" aria-pressed="true"><i class="fa fa-align-justify"></i>  Geheimakte einsehen  <span class="badge badge-light">'.strval($hiddenentry).'</span></a>';
	        }

	        ?>
	    	</div>
	    </div>
	        <?php      
       
		} else {
			// nicht eingeloggt der homo

			?>

			   <div class="container">
			        <div class="text-center">
						<div class="container">
			                <br><br><br>
                        	<div class="row">
                        		<div style="border-color: red;" class="col-md-12 col-md-offset-4 col-sm-6 col-sm-offset-3">
                        			<div class="panel panel-danger" style="border: 2px solid red;">
										<div class="panel-heading text-white" style="background-color: red; padding: 5px;">
											<i class="fa fa-sign-in "></i> Bitte Anmelden
										</div>
									
										<div class="panel-body text-center">
											<h4 style="margin-top:0;" class="page-header"><br>Du musst angemeldet sein, um diese Seite zu sehen</h4>
												<hr> </hr>
											Du erhälst Zugang zu deiner Akte, Informationen, Dokumente und der Aktenverwaltung, falls dein Rang dies zulässt.
											<br>
											<br>

									            <?php
									            	$button = array();

													$buttonstyle = "square";
													$button['rectangle'] = "01";
													$button['square'] = "02";
													$button = "<a href='login.php?login=true'><img src='https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_".$button[$buttonstyle].".png'></a>";
													
													echo $button;
									            ?>
									        <br>
									        <br>

										</div>
									</div>
                        		</div>
                        	</div>
						</div>
			        </div>
			    </div>

			<?php

		}
	?>

</section>

<?php require("system/footer.php"); ?>