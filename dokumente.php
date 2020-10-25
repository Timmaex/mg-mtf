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