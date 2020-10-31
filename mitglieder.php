<?php
	require("system/database.php");

	$header = "Mitgliedersuche";
	$subheader = "Hier kannst du die Akten deiner Kollegen suchen";

	require("system/navbar.php"); 

    $canPromoteTo = array(
        "r" => "r",
        "pvt" => "r",
        "pfc" => "r",
        "spc" => "r",
        "lcpl" => "r",
        "cpl" => "pfc",

        "sgt" => "cpl",
        "ssgt" => "cpl",
        "sfc" => "cpl",
        "fsg" => "cpl",
        "sgm" => "fsg",
        "csm" => "sgm",

        "2lt" => "csm",
        "1lt" => "csm",
        "cpt" => "2lt",
        "maj" => "cpt",
        "lcol" => "maj",
        "col" => "lcol"
    );

?>
<?php
    if(isset($_GET["adduser"])) {
        if(!isset($_GET["anmelden"])) {
            minRankRequired("cpl", "mitglieder.php?adduser&anmelden");
        }

        if(isset($_GET["anmelden"])) {
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
                                            Du kannst hier folglich neue Benutzer eintargen und Ausbildungen abschließen.
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
                <br>
                <br>
                <br>
                <br>
<?php
            if(!isLoggedIn()) {
                require("system/footer.php");
                return;
            }
        }

        if(isset($_GET["success"])) {
            ?>
                <br>
                <div style="width: 50%; margin-left: 25%;" class="alert alert-success col-12" role="alert">
                  <h4 class="alert-heading">Benutzer erfolgreich hinzugefügt</h4>
                  <p>Der Benutzer wurde erfolgreich eingetragen.</p>
                </div>
            <?php
        }

        if(isset($_GET["error"])) {
            ?>
            <br>
                <div style="width: 50%; margin-left: 25%;" class="alert alert-danger col-12" role="alert">
                  <h4 class="alert-heading">Es ist ein Fehler aufgetreten!</h4>
                  <p><?php echo $_GET["errormessage"]; ?></p>
                </div>
            <?php
            if(!isLoggedIn()) {
                require("system/footer.php");
                return;
            }
        }

        if(isset($_GET["submit"])) {
            $codename = $_GET["codename"];
            $steamid = $_GET["steamid"];
            $job = $_GET["job"];
            $rank = $_GET["rank"];

            if(strlen($codename) < 5) {
                // Mehr als 5 Zeichen im Namen
                header("Location: mitglieder.php?adduser&error&errormessage=Der%20Codename%20muss%20länger%20als%205%20Zeichen%20sein!");
            }
            if(count(explode(" ", $codename)) > 1) {
                // Nur ein Wort als Name
                header("Location: mitglieder.php?adduser&error&errormessage=Der%20Codename%20darf%20nur%20ein%20Wort%20sein!");
            }
            if(!toCommunityID($steamid)) {
                // Falsche SteamID bzw inexistente
                header("Location: mitglieder.php?adduser&error&errormessage=Die%20SteamID%20existiert%20nicht!");
            }

            // Check nach Dopplung => SteamID
            $kek = runQuery("SELECT * FROM mtf_character WHERE steamid='".$steamid."'");
            if(mysqli_num_rows($kek) > 0) {
                header("Location: mitglieder.php?adduser&error&errormessage=Es%20existiert%20bereits%20ein%20Nutzer%20mit%20dieser%20SteamID!");
            }

            // Check nach Dopplung => Name
            $kek = runQuery("SELECT * FROM mtf_character WHERE codename='".$codename."'");
            if(mysqli_num_rows($kek) > 0) {
                header("Location: mitglieder.php?adduser&error&errormessage=Es%20existiert%20bereits%20ein%20Nutzer%20mit%20diesem%20Codename!");
            }
            $dienstnummer = substr(toCommunityID($steamid), -3);
            $kek = runQuery("INSERT INTO mtf_character (steamid, job, rank, codename, dienstnummer) VALUES ('".$steamid."', '".$job."', '".$rank."', '".$codename."', '".$dienstnummer."')");
            if($kek) {
                header("Location: mitglieder.php?adduser&success");
            }
        }

        ?>
        <br/>
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Benutzer hinzufügen</h2>
            <h3 class="section-subheading text-muted">Gebe die Daten des neuen Soldaten ein.</h3>
        </div>
        <div class="text-center col-md-9">
            <form action="mitglieder.php" method="get">
              <input type='hidden' name='adduser' value='true' />
              <input type='hidden' name='submit' value='true' />
              <div class="form-group row">
                <label for="codename" class="col-4 col-form-label"></label> 
                <div class="col-8">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fa fa-user"></i>
                      </div>
                    </div> 
                    <input id="codename" name="codename" type="text" aria-describedby="codenameHelpBlock" required="required" class="form-control"> 
                    <div class="input-group-append">
                      <div class="input-group-text">Codename</div>
                    </div>
                  </div> 
                  <span id="codenameHelpBlock" class="form-text text-muted">Gebe den Codename des MTF-Soldaten ein</span>
                </div>
              </div>
              <div class="form-group row">
                <label for="steamid" class="col-4 col-form-label"></label> 
                <div class="col-8">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fa fa-id-card"></i>
                      </div>
                    </div> 
                    <input id="steamid" name="steamid" type="text" aria-describedby="steamidHelpBlock" class="form-control"> 
                    <div class="input-group-append">
                      <div class="input-group-text">SteamID32</div>
                    </div>
                  </div> 
                  <span id="steamidHelpBlock" class="form-text text-muted">Gebe die SteamID32 des MTF-Soldaten ein</span>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-4"></label> 
                <div class="col-8">
                  <div class="custom-control custom-radio custom-control-inline">
                    <input name="job" id="job_0" type="radio" aria-describedby="jobHelpBlock" required="required" class="custom-control-input" value="e6"> 
                    <label for="job_0" class="custom-control-label">Epsilon-6</label>
                  </div>
                  <?php
                    if(hasRank("2lt")) {?>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input name="job" id="job_1" type="radio" aria-describedby="jobHelpBlock" required="required" class="custom-control-input" value="n7"> 
                        <label for="job_1" class="custom-control-label">Nu-7</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input name="job" id="job_2" type="radio" aria-describedby="jobHelpBlock" required="required" class="custom-control-input" value="d5"> 
                        <label for="job_2" class="custom-control-label">Delta-5</label>
                      </div>
                    <?php
                    }
                  ?>
                  <span id="jobHelpBlock" class="form-text text-muted">Wähle die Einheit aus</span>
                </div>
              </div>
              <div class="form-group row">
                <label for="rank" class="col-4 col-form-label"></label> 
                <div class="col-8">
                  <select id="rank" name="rank" required="required" class="custom-select" aria-describedby="rankHelpBlock">

                    <?php
                        $curRank = getUserRank();
                        $can = $canPromoteTo[$curRank];
                        if($can != "r") {
                            $canID = getRankIDByName($can);
                            if(isAdmin()) {
                                $canID = 18;
                            }

                            for($i = 1; $i <= $canID; $i++) {
                                echo '<option value="'.getRankByID($i).'">'.getRankByShortname(getRankByID($i)).'</option>';
                            }
                        }

                    ?>
                  </select> 
                  <span id="rankHelpBlock" class="form-text text-muted">Wähle den Rang des MTF-Soldaten aus</span>
                </div>
              </div> 
              <div class="form-group row">
                <div class="offset-4 col-8">
                  <button name="submit" type="submit" class="btn btn-primary">Absenden</button>
                </div>
              </div>
            </form>
        </div>
        <?php
        require("system/footer.php");
        return;
    }

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
    <?php
        if(hasRank("cpl")) {
            echo '<a href="mitglieder.php?adduser" style="margin-right: 50px;" class="btn btn-primary active float-right" role="button" aria-pressed="true">Benutzer    hinzufügen</a>';
        }
    ?>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
                <script type="text/javascript">
                $(document).ready(function(){
                    $('.cool-search').on("keyup input", function(){

                        var inputVal = $(this).val();
                        var resultDropdown = $(this).siblings(".result");
                        if(inputVal.length){
                            $.get("system/search.php", {term: inputVal}).done(function(data){
                                resultDropdown.html(data);
                            });
                        } else{
                            resultDropdown.empty();
                        }
                    });
                    
                    // Set search input value on click of result item
                    $(document).on("click", ".mtf-data", function(){
                        $('.cool-search').val($(this).text());
                         $('.result').empty();
                    });
                });
                </script>

                <form>
                  <div class="form-group row">
                    <div class="col-12">
                      <div class="input-group">
                        <div class="input-group-prepend daddy-search">
                          <div class="input-group-text">
                            <i class="fa fa-search"></i>
                          </div>
                        </div> 
                        <input id="searchtext" name="searchtext" type="text" class="form-control cool-search" autocomplete="off" placeholder="Nach Name, Dienstnummer oder SteamID32 suchen"> 
                        <div style="width: auto;" class="result bg-dark text-white">
                            <input type='hidden' name='steamid' value='fghfghfg' />
                        </div>                        
                        <div class="input-group-append search-box">
                          <button name="" type="submit" class="btn btn-primary input-group-text">Suchen</button>
                        </div>

                      </div>
                    </div>
                  </div> 
                </form>
            </div>
        </div>
    </div>
</section>

<?php
    if(isset($_GET["searchtext"])) {
        $query = $_GET["searchtext"];
        $query_exp = explode(" ", $query);
        $job = $query_exp[0];
        $dnummer = $query_exp[1];
        $name = $query_exp[2];

        $res = runQuery("SELECT * FROM mtf_character WHERE job='$job' AND codename='$name' AND dienstnummer='$dnummer'");
        $res = mysqli_fetch_array($res);
        print_r($res);
    }
?>
<div class="clearfix">
    <!--<img src="assets/img/einheiten/n7.png" alt="..." class="pull-left mr-2">-->
    <p>Work in Progress!</p>
</div>
<?php require("system/footer.php"); ?>