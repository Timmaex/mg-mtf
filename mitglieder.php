<?php
	require("system/database.php");

	$header = "Mitgliedersuche";
	$subheader = "Hier kannst du die Akten deiner Kollegen suchen";

	require("system/navbar.php"); 

?>
<?php
    if(isset($_GET["user"])) {
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
<?php
    require("system/footer.php");
    return;
}
?>



<section class="page-section" id="services">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12 ">
                <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
                <script type="text/javascript">
                $(document).ready(function(){
                    $('.search-box input[type="text"]').on("keyup input", function(){
                        /* Get input value on change */
                        var inputVal = $(this).val();
                        var resultDropdown = $(this).siblings(".result");
                        if(inputVal.length){
                            $.get("backend-search.php", {term: inputVal}).done(function(data){
                                // Display the returned data in browser
                                resultDropdown.html(data);
                            });
                        } else{
                            resultDropdown.empty();
                        }
                    });
                    
                    // Set search input value on click of result item
                    $(document).on("click", ".result p", function(){
                        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                        $(this).parent(".result").empty();
                    });
                });
                </script>

                <div class="search-box">
                    <input type="text" class="form-control" autocomplete="off" placeholder="Nach Name oder Dienstnummer suchen" />
                    <div class="result"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require("system/footer.php"); ?>