<head>
    <meta charset="utf-8 unicode"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>MG MTF | Mobile Task Force</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet"
          type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet"/>
    <!--<link href="css/slate.css" rel="stylesheet"/>-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">



    <script src="ckeditor/ckeditor.js"></script>
</head>
<body id="page-top">
<!-- Navigation-->
<!--
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="assets/img/navbar-logo.png" alt=""/></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ml-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php">Informationen</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="news.php">News</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="stats.php">Statistik</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="dokumente.php">Dokumente</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="akte.php">Akte</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="mitglieder.php">Mitglieder</a></li>
                <?php
                  /*  if(isLoggedIn()) {
                        $user = runQuery("SELECT * FROM mtf_user WHERE steamid64='".$_SESSION["steamid"]."'");
                        $user = mysqli_fetch_array($user);
                        echo '<a href="login.php?logout" style="width: 5%;"><img class="mx-auto rounded-circle float-left" width="125%"src="'.$user["avatarfull"].'" alt=""></img></a>';
                        //echo $user["url"];
                    } else {
                            $button = array();

                            $buttonstyle = "square";
                            $button['rectangle'] = "0";
                            $button['square'] = "01";
                            $button = "<a href='login.php?login=true'><img src='https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_".$button[$buttonstyle].".png'></a>";
                            
                            echo $button;                       
                    }*/
                ?>
            </ul>
        </div>
    </div>
</nav>
-->
<style>
.navbar { background-color: #303030; position: fixed; top: 0; width: 100%; z-index: 999;}
.navbar .navbar-nav .nav-link { color: #fff; }
.navbar .navbar-nav .nav-link:hover { color: #007bff; }
.navbar .navbar-nav .active > .nav-link { color: #007bff; }

footer a.text-light:hover { color: #fed136!important; text-decoration: none; }
footer .cizgi { border-right: 1px solid #535e67; }

.dropbtn {
  background-color: none;
  color: white;
  padding: 0px;
  font-size: 0px;
  border: none;
  cursor: pointer;
  border: none;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.property-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.property-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {color: #007bff;}

.dropdown a {color: white; background-color: #303030;}

.show {display: block;}
</style>
<nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand text-white" href="#"><i class="fa fa-graduation-cap fa-lg mr-2"></i>MOBILE TASK FORCE</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nvbCollapse" aria-controls="nvbCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nvbCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item pl-1">
                        <a class="nav-link" href="index.php"><i class="fa fa-home fa-fw mr-1"></i>Informationen</a>
                    </li>
                    <li class="nav-item pl-1">
                        <a class="nav-link" href="news.php"><i class="fa fa-th-list fa-fw mr-1"></i>News</a>
                    </li>
                    <li class="nav-item pl-1">
                        <a class="nav-link" href="stats.php"><i class="fa fa-info-circle fa-fw mr-1"></i>Statistik</a>
                    </li>
                    <li class="nav-item pl-1">
                        <a class="nav-link" href="dokumente.php"><i class="fa fa-file fa-fw mr-1"></i>Dokumente</a>
                    </li>
                    <li class="nav-item pl-1">
                        <a class="nav-link" href="akte.php"><i class="fa fa-user-plus fa-fw mr-1"></i>Akte</a>
                    </li>
                    <li class="nav-item pl-1">
                        <a class="nav-link" href="mitglieder.php"><i class="fa fa-user fa-fw mr-1"></i>Mitglieder</a>
                    </li>
                <?php
                    if(isLoggedIn()) {
                        $user = runQuery("SELECT * FROM mtf_user WHERE steamid64='".$_SESSION["steamid"]."'");
                        $user = mysqli_fetch_array($user);
                        //echo '<a href="login.php?logout"><img width="25%" class="ml-3 float-right rounded-circle float-left" src="'.$user["avatarfull"].'" alt=""></img></a>';
                        ?>
                            <div class="dropdown">
                              <input type="image" onclick="openPropertySheet()" src="<?php echo $user["avatarfull"]?>" width="32" class="rounded-circle dropbtn mt-2 ml-2" height="32">
                              <div id="propertySheet" class="property-content" style="background-color: #303030;">
                                <a href="#home">Home</a>
                                <a href="#about">About</a>
                                <div style="height: 1px; width: 95%; background-color: #007bff; margin-left: 2.5%;"></div>
                                <a href="login.php?logout">Ausloggen</a>
                              </div>
                            </div>
                        <?php
                        //echo $user["url"];
                    } else {
                            $button = array();

                            $buttonstyle = "square";
                            $button['rectangle'] = "0";
                            $button['square'] = "01";
                            $button = "<a href='login.php?login=true' class='ml-3 float-right rounded-circle float-left'><img src='https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_".$button[$buttonstyle].".png'></a>";
                            
                            echo $button;                       
                    }
                ?>                    
                </ul>
            </div>
        </div>
    </nav>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function openPropertySheet() {
  document.getElementById("propertySheet").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("property-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

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


