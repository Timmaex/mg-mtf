<?php
	require("system/database.php");

	$header = "Personalakte";
	$subheader = "keko";

	require("system/navbar.php"); 

?>

<section class="page-section bg-light" id="akte">

	<?php
		if(isLoggedIn() == true) {
   			$s32 = runQuery("SELECT steamid32 FROM mtf_user WHERE steamid64='".$_SESSION["steamid"]."'");
   			$s32 = mysqli_fetch_array($s32);

            $kek = runQuery("SELECT * FROM mtf_character WHERE steamid='".$s32["steamid32"]."'");

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
                        		<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                        			<div class="panel panel-danger">
										<div class="panel-heading">
											<i class="fas fa-sign-in"></i> Bitte Anmelden										</div>

										<div class="panel-body text-center">
											<h4 style="margin-top:0;" class="page-header">Du musst angemeldet sein, um diese Seite zu sehen</h4>Du erhälst Zugang zu deinen Statistiken, Banns, Verwarnungen, Käufen, Tickets und vielem mehr.										</div>
									</div>
                        		</div>
                        	</div>

							<br><br>
								</div>








			            <?php
			            	$button = array();

							$buttonstyle = "square";
							$button['rectangle'] = "01";
							$button['square'] = "02";
							$button = "<a href='login.php?login=true'><img src='https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_".$button[$buttonstyle].".png'></a>";
							
							echo $button;
			            ?>
			        </div>
			    </div>

			<?php

		}
	?>

</section>

<?php require("system/footer.php"); ?>