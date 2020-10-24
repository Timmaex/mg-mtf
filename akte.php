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
			            <h2 class="section-heading text-uppercase">NICHT EINGELOGGT</h2>
			            <h3 class="section-subheading text-muted">Um deine eigene Akte zu sehen, musst du mich mit Steam anmelden.</h3>
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