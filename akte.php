<?php
	require("system/database.php");

	$header = "Personalakte";
	$subheader = "Hier findest du alle Einträge deiner Akte";

	require("system/navbar.php"); 

?>

<section class="page-section bg-light" id="akte">

	<?php
		if(isLoggedIn() == true or isset($_GET["user"])) {

			if(!isset($_GET["user"])) {
				header("Location: akte.php?user=".getSteamID32());
			}

            $kek = runQuery("SELECT * FROM mtf_character WHERE steamid='".$_GET["user"]."'");

            while($row = mysqli_fetch_assoc($kek)) {

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
                            <img width="184px" height="184px" src="<?php echo $user["avatarfull"]; ?>" class="mr-3" alt="">
                            <div class="media-body" style="height: 184px;">
                              <div class="text-center" style="height: 184px;">
                                <h2 class="section-heading"><?php echo getFullMTFName($row["steamid"]); ?></h2>
                                <h3 class="section-subheading text-muted"><?php echo getRankByShortname($row["rank"]); ?></h3>
                                <h4 class="">Mitglied der MTF <?php echo getFullJobName($row["job"]); ?></h4>
                              </div>
                            <div class="btn-group" role="group" aria-label="Basic example">
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
	        if(true) {
	            echo '<a href="akte.php?user='.$_GET["user"].'&positive"  class="btn btn-success" role="button" aria-pressed="true"><i class="fa fa-thumbs-up"></i>  Positiv aufgefallen</a>';
	            echo '<a href="akte.php?user='.$_GET["user"].'&negative"  class="btn btn-danger" role="button" aria-pressed="true"><i class="fa fa-thumbs-down"></i>  Negativ aufgefallen</a>';
	        }
	        if(true) {
	            echo '<a href="akte.php?user='.$_GET["user"].'&promote"  class="btn btn-primary" role="button" aria-pressed="true"><i class="fa fa-plus-square"></i>  Befördern</a>';
	        }
	        if(true) {
	            echo '<a href="akte.php?user='.$_GET["user"].'&promote"  class="btn btn-danger" role="button" aria-pressed="true"><i class="fa fa-minus-square"></i>  Degradieren</a>';
	        }
	        if(hasRank("maj") OR isAdmin()) {
	            echo '<a href="akte.php?user='.$_GET["user"].'&positive"  class="btn btn-secondary" role="button" aria-pressed="true"><i class="fa fa-align-justify"></i>  Geheimakte einsehen</a>';
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