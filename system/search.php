<?php

$db = mysqli_connect("90.186.122.152", "mtf", "mImdfhoxdGM2mdpD", "mtf_site");

 
if(isset($_REQUEST["term"])){
    // Prepare a select statement
    $sql = "SELECT * FROM mtf_character WHERE codename LIKE ? OR dienstnummer LIKE ? LIMIT 5";
    
    $req = $_REQUEST["term"];

    if(substr($req, 0, 6) == "STEAM_") {
        $sql = "SELECT * FROM mtf_character WHERE codename LIKE ? OR dienstnummer LIKE ? OR steamid LIKE ? LIMIT 5";
    }

    if($stmt = mysqli_prepare($db, $sql)){

        if(substr($req, 0, 6) == "STEAM_") {
            mysqli_stmt_bind_param($stmt, "sss", $param_term, $param_term, $param_term);
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $param_term, $param_term);
        }
            

        $param_term = $_REQUEST["term"] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                   // <a href='index.php'>" . ucfirst($row["job"])." ".$row["dienstnummer"]." ".$row["codename"] . "</a>
                    //echo "<div style='padding: 5px; padding-left: 20px; padding-right: 20px;'><button> </button></div>";
                    echo "<button class='search btn-primary mtf-data' style='padding: 5px; padding-left: 20px; padding-right: 20px;'>".ucfirst($row["job"])." ".$row["dienstnummer"]." ".$row["codename"]."</button>";
                }
            } else{
                echo "<p>Kein Treffer...</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($db);
        }
        mysqli_stmt_close($stmt);
    }
     
    // Close statement
    
}
 
// close connection
mysqli_close($db);
?>