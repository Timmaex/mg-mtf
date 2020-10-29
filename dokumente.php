<?php
	require("system/database.php");

	$header = "Dokumente";
	$subheader = "Hier findest du alle derzeitig verfügbaren Dokumente.";

	require("system/navbar.php"); 

?>

<section class="page-section bg-light" id="akte">

	<?php

	if(isset($_GET["dokument"])) {
		$kek = runQuery("SELECT value FROM mtf_dokumente WHERE short='".$_GET["dokument"]."'");
		$kek = mysqli_fetch_array($kek);
		echo $kek["value"];
		require("system/footer.php");
		return;
	}




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
		$minRank = 13;
		foreach ($v as $key => $value) {
			if($value["restriction"] < $minRank) {
				$minRank = $value["restriction"];
			}
		}
		if($minRank > getRankIDByName(getUserRank())) {
			continue;
		}

		?>
		<div class="container">
		    <div class="text-center">
		        <h2 class="section-heading text-uppercase"><?php echo $k ?></h2>
		    </div>
		    <div class="row text-center">
		    <?php

		    	foreach ($v as $key => $value) {
		    		if($value["restriction"] > getRankIDByName(getUserRank())) { continue; }
		    		?>
			        <div class="col-lg-4">
			            <h4 class="my-3 text-black"><?php echo $value["header"] ?></h4>
			            <h3 class="section-subheading text-muted"><?php echo $value["info"] ?></h3>
			        	<a class="btn btn-primary" role="button" <?php if($value["typ"] == "external") { echo 'target="_blank"'; } ?> href="<?php if($value["typ"] == "external") { echo $value["value"]; } else { echo "dokumente.php?dokument=".$value["short"]; }?>">Öffnen</a>
			        </div>
			        <?php
		    	}
	    	?>
			</div>
		</div>
		<br>
		<?php
	}
?>








































</section>

<?php require("system/footer.php"); ?>