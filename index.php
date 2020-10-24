<!-- test -->
<!DOCTYPE html>
<html lang="en">

<?php 
    require("system/database.php");
    require("system/navbar.php");


    if(isset($_GET["information"])) {

        $info = runQuery("SELECT * FROM mtf_einheiten WHERE shortname='".$_GET["information"]."'");




        $info = mysqli_fetch_array($info);

        ?>
            <div class="text-center">
                <center>
                    <br>
                    <?php
                        $kek = runQuery("SELECT * FROM mtf_einheiten WHERE shortname='".$info["shortname"]."'");

                        while($row = mysqli_fetch_assoc($kek)) {
                            ?>
                                <div class="col-md-4">
                                        <a href="index.php?information=<?php echo $row["shortname"]; ?>">
                                            <span class="fa-stack fa-8x unitcircle">
                                                <img src="assets/img/einheiten/<?php echo $row["shortname"]; ?>.jpg"
                                                     alt=""/>
                                            </span>
                                        </a>
                                    <h4 class="my-3"><?php echo $row["name"] ?></h4>
                                </div>
                            <?php
                        }
                    ?>
                    <div class="col-md-10">
                        <br>
                        <h2 class="section-heading text-uppercase"><?php echo $info["titel"]; ?></h2>
                        <br>
                        <h5 class="text-muted"><?php echo $info["info"]; ?></h5>
                    </div>
                </center>
            </div>
            <br><br>
        <?php
        require("system/footer.php"); 
        return;
    }

?>


<!-- Einheiten -->
<section class="page-section" id="services">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Die MTF Einheiten</h2>
            <h3 class="section-subheading text-muted">Dies sind die 3 derzeitigen Einheiten der Mobile Task Force<br>Klicke auf eines der 3 Einheitssymbole, um mehr Informationen über diese zu erhalten.</h3>
        </div>
        <div class="row text-center">

        <?php
            $kek = runQuery("SELECT * FROM mtf_einheiten");

            while($row = mysqli_fetch_assoc($kek)) {
                ?>
                    <div class="col-md-4">
                            <a href="index.php?information=<?php echo $row["shortname"]; ?>">
                                <span class="fa-stack fa-8x unitcircle">
                                    <img src="assets/img/einheiten/<?php echo $row["shortname"]; ?>.jpg"
                                         alt=""/>
                                </span>
                            </a>
                        <h4 class="my-3"><?php echo $row["name"] ?></h4>
                    </div>
                <?php
            }
        ?> 
        </div>
    </div>
</section>
<!-- Leitung-->
<section class="page-section bg-dark text-white" id="team">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">MTF LEITUNG</h2>
            <h3 class="section-subheading text-muted">Dies ist die aktuelle Leitung der MTF</h3>
        </div>
        <div class="row">
        <?php
            $kek = runQuery("SELECT * FROM mtf_character WHERE rank='col' OR rank='lcol' ORDER BY FIELD(rank, 'col', 'lcol')");

            while($row = mysqli_fetch_assoc($kek)) {
                $user = runQuery("SELECT * FROM mtf_user WHERE steamid32='".$row["steamid"]."'");
                if(mysqli_num_rows($user) == 0) {
                    $user = array(
                        "avatarfull" => "assets/img/einheiten/pb_".$row["job"].".png",
                    );
                } else {
                    $user = mysqli_fetch_array($user);
                }

                ?>
                <div class="col-lg-6">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle"
                             src="<?php echo $user["avatarfull"]; ?>"
                             alt=""/>
                        <h4><?php echo getFullMTFName($row["steamid"]); ?></h4>
                        <p class="text-muted"><?php echo $rankByShort[$row["rank"]]; ?></p>
                        
                        <?php
                            if(isset($user["url"])) {
                                echo '<a class="btn btn-info btn-social mx-2" href="'.$user['url'].'" target="_blank"><i class="fab fa-steam"></i></a>';
                            }
                            if(isset($user["mg_profile"]) && $user["mg_profile"] != "") {
                                echo '<a class="btn btn-info btn-social mx-2" href="'.$user['mg_profile'].'" target="_blank"><i class="fa fa-globe"></i></a>';
                            }
                        ?>
                    </div>
                </div>
                <?php
            }
        ?> 



        </div>
</section>
<!-- Team-->
<section class="page-section bg-light" id="team">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">OFFIZIERSSTAB</h2>
            <h3 class="section-subheading text-muted">Dies sind die aktuellen Offiziere der MTF</h3>
        </div>
        <div class="row">
        <?php
            $kek = runQuery("SELECT * FROM mtf_character WHERE rank='col' OR rank='lcol' OR rank='maj' OR rank='cpt' OR rank='1lt' OR rank='2lt' ORDER BY FIELD(rank, 'col', 'lcol', 'maj', 'cpt', '1lt', '2lt')");

            while($row = mysqli_fetch_assoc($kek)) {
                $user = runQuery("SELECT * FROM mtf_user WHERE steamid32='".$row["steamid"]."'");
                if(mysqli_num_rows($user) == 0) {
                    $user = array(
                        "avatarfull" => "assets/img/einheiten/pb_".$row["job"].".png",
                    );
                } else {
                    $user = mysqli_fetch_array($user);
                }

                ?>
                <div class="col-lg-4">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle"
                             src="<?php echo $user["avatarfull"]; ?>"
                             alt=""/>
                        <h4><?php echo getFullMTFName($row["steamid"]); ?></h4>
                        <p class="text-muted"><?php echo $rankByShort[$row["rank"]]; ?></p>
                        <?php
                            if(isset($user["url"])) {
                                echo '<a class="btn btn-info btn-social mx-2" href="'.$user['url'].'" target="_blank"><i class="fab fa-steam"></i></a>';
                            } 
                            if(isset($user["mg_profile"]) && $user["mg_profile"] != "") {
                                echo '<a class="btn btn-info btn-social mx-2" href="'.$user['mg_profile'].'" target="_blank"><i class="fa fa-globe"></i></a>';
                            }
                        ?>
                    </div>
                </div>
                <?php
            }
        ?> 
        </div>

    </div>
</section>

    <?php require("system/footer.php"); ?>

</body>
</html>
