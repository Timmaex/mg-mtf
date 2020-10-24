<?php
	require("system/database.php");

	$header = "Personalakte";
	$subheader = "keko";

	require("system/navbar.php"); 

?>

<section class="page-section bg-light" id="akte">

	<?php
		if(isLoggedIn() == true) {

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