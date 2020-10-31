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
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="dokumente.php">Dokumente</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="akte.php">Personalakte</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="mitglieder.php">Mitglieder</a></li>
                <?php
                    if(isLoggedIn()) {
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
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>


<!-- Masthead-->
<header class="masthead">
    <div class="container">
        <?php
            if(isset($header) && isset($subheader)) {
                echo '<div style="margin-bottom: -30%;" class="masthead-subheading">'.$header.'<br>'.$subheader.'</div>';
            } else {
                echo '<div style="margin-bottom: -30%;" class="masthead-subheading">Modern-Gaming SCP-RP Mobile Task Force<br>Wir wünschen dir einen schönen Aufenthalt!</div>';
            }
            
        ?>

    </div>
</header>


