<?php
	require("system/database.php");

	$header = "Dokumente";
	$subheader = "Hier findest du alle derzeitig verfügbaren Dokumente.";

	require("system/navbar.php"); 

?>

<section class="page-section bg-light" id="akte">

	<?php



	//echo getSteamID32()."<br>";
	//echo getRankByShortname("lcol")."<br>";
	//echo getRankByShortname(getRankByID(getRankIDByName("col")))."<br>";
	//echo getRankByShortname(getRankByID(6))."<br>";


		if(isLoggedIn() == true) {

       
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

<?php
	// Convert all documents to be sorted by category

	$documents = runQuery("SELECT * FROM mtf_dokumente");

	$DocumentByCategory = array();

	while($row = mysqli_fetch_assoc($documents)) {
		if(!isset($DocumentByCategory[$row["category"]])) {
			$DocumentByCategory[$row["category"]] = array();
		}

		array_push($DocumentByCategory[$row["category"]], $row);
	}

	foreach ($DocumentByCategory as $k => $v) {
		?>
		<div class="container">
		    <div class="text-center">
		        <h2 class="section-heading text-uppercase"><?php echo $k ?></h2>
		    </div>
		    <div class="row text-center">
		    <?php
		    	foreach ($v as $key => $value) {
		    		if($value["restriction"] > getRankIDByName(getUserRank())) { return; }
		    		?>
			        <div class="col-lg-4">
			            <h4 class="my-3 text-black"><?php echo $value["header"] ?></h4>
			            <h3 class="section-subheading text-muted"><?php echo $value["info"] ?></h3>
			        	<a class="btn btn-primary" role="button" href="dokumente.php?dokument=<?php echo $value["short"]; ?>">Mehr Infos</a>
			        </div>
			        <?php
		    	}
	    	?>
			</div>
		</div>
		<?php
	}
?>








































</section>

<?php require("system/footer.php"); ?>