  
<head>
    <meta charset="utf-8 unicode"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>MG MTF | Mobile Task Force</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>





    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css"/>

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet"/>
    <?php
      echo '<link href="css/'.getTheme().'.css" rel="stylesheet"/>';
    ?>
    

    <!--<link href="css/slate.css" rel="stylesheet"/>       echo getTheme();            -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 




</head>
<?php
  if(!isset($_GET["submit"]) and !isset($_GET["text"]) and !isset($_GET["comment"])) {

?>
<nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
          <a class="navbar-brand" href="#">
            <img src="assets/img/favicon.ico" style="filter: brightness(0) invert(1);" width="30" height="30" class="d-inline-block align-top" alt="">
            Mobile Task Force
          </a>
        </ul>
    </div>


    <div class="mx-auto order-0">
       <ul class="navbar-nav mr-auto ml-auto" id="nvbCollapse">
          <li class="nav-item">
            <a class="nav-link" href="index.php"><i class="fa fa-home"></i>Informationen</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="news.php"><i class="fa fa-th-list"></i>News</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="stats.php"><i class="fa fa-info-circle"></i>Statistik</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dokumente.php"><i class="fa fa-file"></i>Dokumente</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="akte.php"><i class="fa fa-user-plus"></i>Akte</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="mitglieder.php"><i class="fa fa-user"></i>Mitglieder</a>
          </li>



          <li class="nav-item">
            <a class="nav-link" href="todolist.php"><i class="fa fa-user"></i>Todo</a>
          </li>











        </ul>
















    </div>



    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">


      <li class="nav-item dropdown">

<?php
        if(isLoggedIn()) {
          $user = runQuery("SELECT * FROM mtf_user WHERE steamid64='".$_SESSION["steamid"]."'");
          $user = mysqli_fetch_array($user);

          ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="mx-auto rounded-circle float-left" width="40px"src="<?php echo $user["avatarfull"]; ?>" alt=""></img>
              </a>
              <div class="pull-right">
                <div class="dropdown-menu dropdown-menu-right pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="akte.php">Persönliche Akte</a>
                  <a class="dropdown-item" href="themes.php">Themes</a>
                  <a class="dropdown-item" href="profile.php">MG-Profil einstellen</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="login.php?logout">Abmelden</a>
                </div>
              </div>
            </li>              
          <?php

        }
?>





                <?php
                    if(isLoggedIn()) {



                        ?>

                        <?php
                        //echo $user["url"];
                    } else {
                            $button = array();

                            $buttonstyle = "square";
                            $button['rectangle'] = "0";
                            $button['square'] = "01";
                            $button = "<a href='login.php?login=true'><img src='https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_".$button[$buttonstyle].".png'></a>";
                            
                            echo $button;                       
                    }
                ?>
            </li>
        </ul>
    </div>
</nav>

<!-- Masthead-->
<header class="masthead">
    <div class="container">
        <?php
            if(isset($header) && isset($subheader)) {
                echo '<div style="margin-bottom: -30%; margin-top: 11%;" class="masthead-subheading">'.$header.'<br>'.$subheader.'</div>';
            } else {
                echo '<div style="margin-bottom: -30%; margin-top: 11%;" class="masthead-subheading">Modern-Gaming SCP-RP Mobile Task Force<br>Wir wünschen dir einen schönen Aufenthalt!</div>';
            }
            
        ?>

    </div>
</header>

<?php
}
