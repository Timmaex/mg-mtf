<?php 
  ob_start();
  require 'system/database.php';

  if(!isset($_GET["logout"]) or !isset($_GET["login"])) {
    //header("Location: index.php");
  }

  if (isset($_GET['logout'])){
    require 'steamauth/SteamConfig.php';
    session_unset();
    session_destroy();
    header('Location: '.$steamauth['logoutpage']);
    exit;
  }

  if (isset($_GET['login'])){
    echo "login";
    require 'steamauth/openid.php';
    try {
      require 'steamauth/SteamConfig.php';
      $openid = new LightOpenID($steamauth['domainname']);
      
      if(!$openid->mode) {
        $openid->identity = 'https://steamcommunity.com/openid';
        header('Location: ' . $openid->authUrl());
      } elseif ($openid->mode == 'cancel') {
        echo 'User has canceled authentication!';
      } else {
        if($openid->validate()) { 
          $id = $openid->identity;
          $ptn = "/^https?:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
          preg_match($ptn, $id, $matches);
          $_SESSION['steamid'] = $matches[1];
          require 'steamauth/userInfo.php';

          $db_res = runQuery("SELECT * FROM mtf_user WHERE steamid64='".$steamprofile['steamid']."'");

          if (!$db_res) {
              printf("Error: %s\n", mysqli_error($db));
              exit();
          }

          $row = mysqli_fetch_array($db_res);

          $steamname = $steamprofile["personaname"];
          $profile = $steamprofile["profileurl"];
          $sid64 = $steamprofile["steamid"];
          $avatar = $steamprofile["avatarfull"];

          echo $_SESSION['steamid'];

          $sid32 = strval(toSteamID($_SESSION['steamid']));


        echo "<br>".$sid32;

          if(is_null($row["id"])){
            $kek = runQuery("INSERT INTO mtf_user (name, url, steamid64, steamid32, avatarfull, mg_profile) VALUES ('". $steamname ."', '". $profile ."', '". $sid64 ."', '". $sid32 ."', '". $avatar ."', '')");
            if(!$kek) {
              die("You suck");
            }
          }          
          //userExists($steamprofile['steamid']);

          if (!headers_sent()) {
            header('Location: '.$steamauth['loginpage']);
            exit;
          } else {
            ?>
            <script type="text/javascript">
              window.location.href="<?=$steamauth['loginpage']?>";<
            </script>
            <noscript>
              <meta http-equiv="refresh" content="0;url=index.php" />
            </noscript>
            <?php
            exit;
          }
        } else {
          echo "User is not logged in.\n";
        }
      }
    } catch(ErrorException $e) {
      echo $e->getMessage();
    }
  }

?>
