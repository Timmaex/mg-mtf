<!DOCTYPE html>
<html lang="de">

<?php 
    require("system/database.php");
    require("system/navbar.php");

    if(isset($_GET["information"])) {

        $info = runQuery("SELECT * FROM mtf_einheiten WHERE shortname='".$_GET["information"]."'");

        $info = mysqli_fetch_array($info);

        ?>

        
        <section class="page-section" id="info">
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
                                                <img src="assets/img/einheiten/<?php echo $row["shortname"]; ?>.png"
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
                    <br>
                    <div class="col-md-10 text-center">
                        <h4>
                            Aktuelle Leitung
                        <h4>
                        <h6 class="text-muted"><?php echo "Leitung " . getFullMTFName($info["leitung"]) . "<br>". "StV. Leitung " . getFullMTFName($info["coleitung"]); ?></h6>
                    </div>
                </center>
            </div>
        </section>
            <br><br>
        <?php
        require("system/footer.php"); 
        return;
    } elseif(isset($_GET["serverinfo"])) {

        require("system/footer.php"); 
        return;
    }

?>

<!-- Einheiten -->
<section class="page-section bg-light" id="services">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Die MTF Einheiten</h2>
            <h3 class="section-subheading text-muted">Dies sind die 3 derzeitigen Einheiten der Mobile Task Force.</h3>
        </div>
        <div class="row text-center">

        <?php
            $kek = runQuery("SELECT * FROM mtf_einheiten ORDER BY FIELD(shortname, 'n7', 'd5', 'e6')");

            while($row = mysqli_fetch_assoc($kek)) {
                ?>
                    <div class="col-md-4">
                            
                                <span class="fa-stack fa-8x unitcircle">
                                    <img src="assets/img/einheiten/<?php echo $row["shortname"]; ?>.png"
                                         alt=""/>
                                </span>
                            
                        <h4 class="my-3"><?php echo $row["name"] ?></h4>
                        <a class="btn btn-primary" role="button" href="index.php?information=<?php echo $row["shortname"]."#info"; ?>">Mehr Infos</a>
                    </div>
                <?php
            }
        ?> 
        </div>
    </div>
</section>

<!-- Leitung-->
<section class="page-section bg-dark text-white" id="leitung">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">MTF LEITUNG</h2>
            <h3 class="section-subheading text-muted">Dies ist die aktuelle Leitung der MTF</h3>
        </div>
        <div class="row">
        <?php
            $kek = runQuery("SELECT * FROM mtf_character WHERE rank='col' OR rank='lcol' OR rank='maj' ORDER BY FIELD(rank, 'col', 'lcol', 'maj')");
            $leitungen = mysqli_num_rows($kek);

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
                <div class="col-lg-<?php echo strval(12/$leitungen); ?>">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle"
                             src="<?php echo $user["avatarfull"]; ?>"
                             alt=""/>
                        <h4><?php echo getFullMTFName($row["steamid"]); ?></h4>
                        <p class="text-muted"><?php echo getRankByShortname($row["rank"]) . " | MTF " . getFullJobname($row["job"]); ?></p>
                        
                        <?php
                            if(isset($user["url"])) {
                                echo '<a class="btn btn-primary btn-social mx-2" href="'.$user['url'].'" target="_blank"><i class="fab fa-steam"></i></a>';
                            }
                            if(isset($user["mg_profile"]) && $user["mg_profile"] != "") {
                                echo '<a class="btn btn-primary btn-social mx-2" href="'.$user['mg_profile'].'" target="_blank"><i class="fa fa-globe"></i></a>';
                            }
                            echo '<a class="btn btn-primary btn-social mx-2" href="akte.php?user='.$row['steamid'].'"><i class="fa fa-id-card"></i></a>';
                        ?>
                    </div>
                </div>
                <?php
            }
        ?> 



        </div>
</section>

<!-- Offiziere -->
<section class="page-section bg-light" id="offiziere">
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
                        <p class="text-muted"><?php echo getRankByShortname($row["rank"]) . " | MTF " . getFullJobname($row["job"]); ?></p>
                        <?php
                            if(isset($user["url"])) {
                                echo '<a class="btn btn-primary btn-social mx-2" href="'.$user['url'].'" target="_blank"><i class="fab fa-steam"></i></a>';
                            } 
                            if(isset($user["mg_profile"]) && $user["mg_profile"] != "") {
                                echo '<a class="btn btn-primary btn-social mx-2" href="'.$user['mg_profile'].'" target="_blank"><i class="fa fa-globe"></i></a>';
                            }
                            echo '<a class="btn btn-primary btn-social mx-2" href="akte.php?user='.$row['steamid'].'"><i class="fa fa-id-card"></i></a>';
                        ?>
                    </div>
                </div>
                <?php
            }
        ?> 
        </div>

    </div>
</section>

<!-- Unteroffiziere (9) -->
<section class="page-section bg-light" id="offiziere">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">UNTEROFFIZIERE</h2>
            <h3 class="section-subheading text-muted">Dies sind die aktuellen Unteroffiziere der MTF</h3>
        </div>
        <div class="row">
        <?php
            $kek = runQuery("SELECT * FROM mtf_character WHERE rank='csm' OR rank='sgm' OR rank='fsg' OR rank='sfc' OR rank='ssgt' OR rank='sgt' ORDER BY FIELD(rank, 'csm', 'sgm', 'fsg', 'sfc', 'ssgt', 'sgt') LIMIT 10");

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
                        <p class="text-muted"><?php echo getRankByShortname($row["rank"]) . " | MTF " . getFullJobname($row["job"]); ?></p>
                        <?php
                            if(isset($user["url"])) {
                                echo '<a class="btn btn-primary btn-social mx-2" href="'.$user['url'].'" target="_blank"><i class="fab fa-steam"></i></a>';
                            } 
                            if(isset($user["mg_profile"]) && $user["mg_profile"] != "") {
                                echo '<a class="btn btn-primary btn-social mx-2" href="'.$user['mg_profile'].'" target="_blank"><i class="fa fa-globe"></i></a>';
                            }
                            echo '<a class="btn btn-primary btn-social mx-2" href="akte.php?user='.$row['steamid'].'"><i class="fa fa-id-card"></i></a>';
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