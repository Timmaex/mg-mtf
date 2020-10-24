<!-- test -->
<!DOCTYPE html>
<html lang="en">

<?php 
    require("system/navbar.php");
    require("system/database.php");

    $rankByShort = array(
        "r" => "Rekrut",
        "pvt" => "Private",
        "pfc" => "Private First Class",
        "spc" => "Specialist",
        "lcpl" => "Lance Corporal",
        "cpl" => "Corporal",

        "sgt" => "Sergeant",
        "ssgt" => "Staff Sergeant",
        "sfc" => "Sergeant First Class",
        "fsg" => "First Sergeant",
        "sgm" => "Sergeant Major",
        "csm" => "Command Sergeant Major",

        "2lt" => "2. Lieutenant",
        "1lt" => "1. Lieutenant",
        "cpt" => "Captain",
        "maj" => "Major",
        "lcol" => "Lieutenant Colonel",
        "col" => "Colonel"
    );
?>

<!-- Services-->
<section class="page-section" id="services">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Die MTF Einheiten</h2>
            <h3 class="section-subheading text-muted">Dies sind die 3 derzeitigen Einheiten der Mobile Task Force</h3>
        </div>
        <div class="row text-center">
            <div class="col-md-4">
                        <span class="fa-stack fa-8x unitcircle">
                            <img src="http://scp-wiki.wdfiles.com/local--resized-images/task-forces/Epsilon6village.png/small.jpg"
                                 alt=""/>
                        </span>
                <h4 class="my-3">MTF Epsillon-6</h4>
                <p class="text-muted">-Dies ist die E6-</p>
            </div>
            <div class="col-md-4">
                        <span class="fa-stack fa-8x unitcircle">
                            <img src="http://scp-wiki.wdfiles.com/local--resized-images/task-forces/Nu7.png/small.jpg"
                                 alt=""/>
                        </span>
                <h4 class="my-3">MTF Nu-7</h4>
                <p class="text-muted">-Dies ist die Nu7-</p>
            </div>
            <div class="col-md-4">
                        <span class="fa-stack fa-8x unitcircle">
                            <img src="http://scp-wiki.wdfiles.com/local--resized-images/task-forces/Delta5.png/small.jpg"
                                 alt=""/>
                        </span>
                <h4 class="my-3">MTF Delta-5</h4>
                <p class="text-muted">-Dies ist die D5-</p>
            </div>
        </div>
    </div>
</section>
<!-- Leitung-->
<section class="page-section bg-light" id="team">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">MTF LEITUNG</h2>
            <h3 class="section-subheading text-muted">Dies ist die aktuelle Leitung der MTF</h3>
        </div>
        <div class="row">
        <?php
            $kek = runQuery("SELECT * FROM mtf_character WHERE rank='col' OR rank='lcol'");

            while($row = mysqli_fetch_assoc($kek)) {
                $user = runQuery("SELECT * FROM mtf_user WHERE steamid32='".$row["steamid"]."'");
                $uer = mysqli_fetch_array($user);
                if(!empty($user)) {
                    $user = array(
                        "profile" => "index.php",
                    );
                }
                ?>
                <div class="col-lg-6">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle"
                             src="https://modern-gaming.net/images/avatars/68/14152-6813c55149add5ff1d59e9d92c8ed025c65e270f.png"
                             alt=""/>
                        <h4><?php echo $row["codename"]; ?></h4>
                        <p class="text-muted"><?php echo $rankByShort[$row["rank"]]; ?></p>
                        <a class="btn btn-dark btn-social mx-2" href="<?php echo $user['profile']; ?>" target="_blank"><i class="fab fa-steam"></i></a>
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
            <div class="col-lg-4">
                <div class="team-member">
                    <img class="mx-auto rounded-circle"
                         src="https://modern-gaming.net/images/avatars/68/14152-6813c55149add5ff1d59e9d92c8ed025c65e270f.png"
                         alt=""/>
                    <h4>Wobba | "Ackerman"</h4>
                    <p class="text-muted">MTF Colonel</p>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="team-member">
                    <img class="mx-auto rounded-circle"
                         src="https://modern-gaming.net/images/avatars/0a/15508-0a8719930978e2c20583700e1b435ba56ef37627.png"
                         alt=""/>
                    <h4>M1tsinn | "Rho"</h4>
                    <p class="text-muted">MTF Lieutenant Colonel</p>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="team-member">
                    <img class="mx-auto rounded-circle" src="assets/img/team/3.jpg" alt=""/>
                    <h4>Hidden</h4>
                    <p class="text-muted">Captain</p>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <p class="large text-muted">Bottom text</p>
            </div>
        </div>
    </div>
</section>
<!-- Footer-->
<footer class="footer py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 text-lg-left">Copyright © Modern-Gaming.net 2020</div>
            <div class="col-lg-4 my-3 my-lg-0">
                <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <div class="col-lg-4 text-lg-right">
                <a class="mr-3" href="#!">Privacy Policy</a>
                <a href="#!">Terms of Use</a>
            </div>
        </div>
    </div>
</footer>
<!-- Portfolio Modals-->

<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<!-- Contact form JS-->
<script src="assets/mail/jqBootstrapValidation.js"></script>
<script src="assets/mail/contact_me.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
