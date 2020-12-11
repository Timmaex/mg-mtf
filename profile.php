<!DOCTYPE html>
<html lang="de">

<?php 
    require("system/database.php");

    if(!isLoggedIn()) {
        header("Location: index.php");
    }

    $header = "MG-Profil";
    $subheader = "Hier kannst du dein MG-Profil verlinken.";
    unset($_GET["submit"]);
    require("system/navbar.php");
?>

<!-- To be replaced -->
<section class="page-section bg-light" id="offiziere">
    <div class="container">


<?php

    if(isset($_GET["profile"])) {
        $text = $_GET["profile"];

        $canInput = true;

        if(substr($text, 0, 31) != "https://modern-gaming.net/user/") {

            errorBox("Falsche Angaben!", "Der Link muss mit 'https://modern-gaming.net/user/' beginnen!");

            $canInput = false;
        }


        if($canInput == true) {

            runQuery("UPDATE mtf_user SET mg_profile='".$text."' WHERE steamid32='".getSteamID32()."'");

            successBox("Angabe Gespeichert!", "Dein Profil wurde erfolgreich auf '".htmlspecialchars($text)."' geändert.");
        }

    }
?>



        <form style="margin-left: 0%;">
          <div class="form-group row">
            <label class="col-4 col-form-label" for="profile"></label> 
            <div class="col-12">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fa fa-address-card"></i>
                  </div>
                </div> 
                <input id="profile" name="profile" placeholder="Dein MG-Profillink (beginnend mit 'https://modern-gaming.net/user/')" type="text" class="form-control" value="<?php if(isset($_GET["profile"])) { echo $_GET["profile"]; } else { echo getUserVar(getSteamID32(), "mg_profile"); } ?>" required="required"> 
                <div class="input-group-append">
                  <button name="submit" type="submit" class="btn btn-secondary">Absenden</button>
                </div>
              </div>
            </div>
          </div> 
        </form>



<br>
<br>
<br>
<br>
<br>
    </div>
</section>

    <?php require("system/footer.php"); ?>

</body>
</html>