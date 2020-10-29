<?php

$db = mysqli_connect("90.186.173.187", "mtf", "mImdfhoxdGM2mdpD", "mtf_site");

 
if(isset($_REQUEST["term"])){
    // Prepare a select statement
    $sql = "SELECT * FROM mtf_character WHERE codename LIKE ? OR dienstnummer LIKE ? OR steamid LIKE ?";
    
    if($stmt = mysqli_prepare($db, $sql)){
        // Bind variables to the prepared statement as parameters
        //if($param_term == "s" or $param_term == "S") {
        //    mysqli_stmt_bind_param($stmt, "sss", $param_term, $param_term, $param_term);
        //} else {
            mysqli_stmt_bind_param($stmt, "sss", $param_term, $param_term, $param_term);
        //}
        // Set parameters
        $param_term = $_REQUEST["term"] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    echo "<p><a href='index.php'>" . ucfirst($row["job"])." ".$row["dienstnummer"]." ".$row["codename"] . "</a></p>";
                }
            } else{
                echo "<p>No matches found</p>";
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