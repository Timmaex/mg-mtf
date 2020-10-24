<?php 
  ob_start();
  session_start();
  //require 'system/database.php';

  if (isset($_GET['logout'])){
    require 'steamauth/SteamConfig.php';
    session_unset();
    session_destroy();
    header('Location: '.$steamauth['logoutpage']);
    exit;
  }

  if (isset($_GET['login'])){
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

          $db_res = runQuery("SELECT * FROM mtf_user WHERE steamid='".$steamprofile['steamid']."'");

          if (!$db_res) {
              printf("Error: %s\n", mysqli_error($db));
              exit();
          }

          $row = mysqli_fetch_array($db_res);

          $sn = $steamprofile["personaname"];
          $pu = $steamprofile["profileurl"];
          $si = $steamprofile["steamid"];
          $av = $steamprofile["avatarfull"];

          if(is_null($row["id"])){
            runQuery("INSERT INTO mtf_user (name, url, steamid, avatar) VALUES ('". $sn ."', '". $pu ."', '". $si ."', '". $av ."')");            
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
              <meta http-equiv="refresh" content="0;url=<?=$steamauth['loginpage']?>" />
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