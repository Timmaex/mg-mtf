<!DOCTYPE html>
<html lang="de">

<?php 
    require("system/database.php");

    if(!isLoggedIn()) {
        header("Location: index.php");
    }

    $header = "Themes";
    $subheader = "Hier kannst du verschiedene Themes für die MTF-Seite auswählen";

    require("system/navbar.php");
?>

<?php
    if(isset($_GET["submit"]) && isLoggedIn()) {
        runQuery("UPDATE mtf_user SET theme='".$_GET["theme"]."' WHERE steamid64='".$_SESSION["steamid"]."'");
        header("Location: themes.php");
    }
?>

<!-- To be replaced -->
<section class="page-section bg-light" id="offiziere">
    <div class="container">
        <div class="row text-center">
            <?php

            ?>
            <div class="col-md-4">         
                <h4 class="my-3">Standart</h4>
                <p>Das Standarttheme bestehend aus hellen und dunklen Farben</p>
                <a class="btn btn-primary" role="button" href="themes.php?submit=true&theme=default">Auswählen</a>
            </div>

            <div class="col-md-4">         
                <h4 class="my-3">Dark</h4>
                <p>Eine Auswahl</p>
                <a class="btn btn-primary" role="button" href="themes.php?submit=true&theme=dark">Auswählen</a>
            </div>

            <div class="col-md-4">         
                <h4 class="my-3">Flat</h4>
                <p>Eine Auswahl</p>
                <a class="btn btn-primary" role="button" href="themes.php?submit=true&theme=flat">Auswählen</a>
            </div>

            <div class="col-md-4">         
                <h4 class="my-3">Solar</h4>
                <p>Eine Auswahl</p>
                <a class="btn btn-primary" role="button" href="themes.php?submit=true&theme=solar">Auswählen</a>
            </div>

            <div class="col-md-4">         
                <h4 class="my-3">Slate</h4>
                <p>Eine Auswahl</p>
                <a class="btn btn-primary" role="button" href="themes.php?submit=true&theme=slate">Auswählen</a>
            </div>

        </div>
    </div>
</section>

    <?php require("system/footer.php"); ?>

</body>
</html>