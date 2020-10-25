<?php
	require("system/database.php");

	$header = "Personalakte";
	$subheader = "keko";

	require("system/navbar.php"); 

?>

<section class="page-section bg-light" id="akte">

	<?php
		if(isLoggedIn() == true) {
            $kek = runQuery("SELECT * FROM mtf_character WHERE steamid='".getSteamID32()."'");

            while($row = mysqli_fetch_assoc($kek)) {


                ?>
                <div class="col-lg-12">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle"
                             src="<?php echo $user["avatarfull"]; ?>"
                             alt=""/>
                        <h4><?php echo getFullMTFName($row["steamid"]); ?></h4>
                        <p class="text-muted"><?php echo $rankByShort[$row["rank"]]; ?></p>
                        <a class="btn btn-dark btn-social mx-2" href="<?php echo $user['url']; ?>" target="_blank"><i class="fab fa-steam"></i></a>
                        <?php
                            if(isset($user["mg_profile"]) && $user["mg_profile"] != "") {
                                echo '<a class="btn btn-dark btn-social mx-2" href="'.$user['mg_profile'].'" target="_blank"><i class="fa fa-globe"></i></a>';
                            }
                        ?>
                    </div>
                </div>
                <?php
            }
       
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