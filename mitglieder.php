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

			        </div>
			    </div>

			<?php

		}
	?>

</section>

<?php require("system/footer.php"); ?>