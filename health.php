<?php
session_start();
include_once("config.php");

// set the current URL to redirect back to
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$SERVER['REQUEST_URI']);
?>

<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Life Happens</title>
        <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
        <link rel="stylesheet" href="main.css">
    </head>
    <style>
        input, h1, a {
            color: white;
        }
        h3,h4,h5 {
            color:#6b9023;
        }
        a {
            font-size: 12px;
            background-color:#6b9023;
            color: white;
        }
    </style>    
    <body>
        
    
        
        
        
        
        
    <!---------------------- background ------------------------->
    <div class="w3-margin-top w3-card-2 w3-center" style="width:400px; margin:auto;">
        <header class="w3-container w3-block" style="background-color:#6b9023;">
            <div class="w3-bar">
                <a class=" w3-padding-small w3-button w3-bar-item" href="index.php">HOME</a>
                <a class=" w3-padding-small w3-button w3-bar-item" href="activity.php">ACTIVITY</a>
                <a class=" w3-padding-small w3-button w3-bar-item" href="health.php">HEALTH</a>
                <a class=" w3-padding-small w3-button w3-bar-item" href="mood.php">MOOD</a>
                <a class=" w3-padding-small w3-button w3-bar-item" href="graph.php">MY STATS</a>
            </div>
            <h1>Health</h1>
        </header>
    <!---------------------- bkgd working area ------------------------->    
        <div class="w3-container w3-metro-darken">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    
        
            
            
        <!-- LEVEL -->
        <h4 class="w3-left">RATE YOUR HEALTH</h4>
        <div>
            <input type="range" min="0" max="10" class="w3-margin-top w3-block" name="level" value="0">
             <label style="color: grey;">Poor ------------------------------------ Excellent</label>       
        </div>
        
        <!-- DATE -->
        <h4 class="w3-left">DATE</h4>
        <input class="w3-block w3-border w3-dark-grey" type="date" name="date" ><br>

        <!-- CHECKBOX -->
        <div class="w3-block"><h3 class="w3-left">HOW DO YOU FEEL TODAY?</h3></div>
              <table>
                <tr>
                    <td>
                        <input class="w3-check w3-left" type="checkbox" name="checkbox" value="Headache"><label class="w3-left">&nbsp;Headache &nbsp;</label>
                    </td>
                    <td>
                        <input class="w3-check w3-left" type="checkbox" name="checkbox" value="Stomach"><label class="w3-left">&nbsp;Stomach &nbsp;</label>
                    </td>
                    <td>
                        <input class="w3-check w3-left" type="checkbox" name="checkbox" value="Pooper"><label class="w3-left">&nbsp;Pooper &nbsp;</label>
                    </td>                
                </tr>
                <tr>
                    <td>
                        <input class="w3-check w3-left" type="checkbox" name="checkbox" value="Fatigue"><label class="w3-left">&nbsp;Fatigue &nbsp;</label>
                    </td>
                    <td>
                        <input class="w3-check w3-left" type="checkbox" name="checkbox" value="Sick"><label class="w3-left">&nbsp;Sick &nbsp;</label>
                    </td>
                    <td>
                        <input class="w3-check w3-left" type="checkbox" name="checkbox" value="Backache"><label class="w3-left">&nbsp;Backache &nbsp;</label>
                    </td>                
                </tr>
                <tr>
                    <td>
                        <input class="w3-check w3-left" type="checkbox" name="checkbox" value="No Pain"><label class="w3-left">&nbsp;No Pain &nbsp; </label>
                    </td>
                    <td>
                        <input class="w3-check w3-left" type="checkbox" name="checkbox" value="Injury"><label class="w3-left">&nbsp;Injury &nbsp;</label>
                    </td>
                    <td>
                        <input class="w3-check w3-left" type="checkbox" name="checkbox" value="Feet/Hands"><label class="w3-left">&nbsp;Feet/Hands &nbsp;</label>
                    </td>                
                </tr>            
            </table>        


        <!-- CAUSE -->
        <h4 class="w3-left">CAUSE</h4>
        <input class="w3-input w3-border w3-dark-grey" type="text" name="cause"><br>
        
        
        <!-- NOTES -->
        <h4 class="w3-left">NOTES</h4>
            <textarea class="w3-block w3-border w3-dark-grey" type="text" name="notes"></textarea><br>
            
        <!-- SUBMIT -->
          <input type="submit" class="w3-button w3-block w3-xlarge w3-metro-dark-red" value="KAPOW!">            
            
            
        </form>
        </div> 
    <!---------------------- END OF bkgd working area ------------------------->

        
<?php
/* On submit (aka: KAPOW!), data is sent to database */
        
// check for post submit imput        
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect user input 
    $date = $_POST['date'];
    $location = $_POST['checkbox'];
    $level = $_POST['level'];
    $cause = $_POST['cause'];
    $notes = $_POST['notes'];
    
    // escape out single and double quotes
    $cause = $mysqli->real_escape_string($cause);
    $notes = $mysqli->real_escape_string($notes);
    
    // make sure date and level is selected
    //     -- only recording the last checkbox selected and not all of them... hmmm
    if ( (empty($date)) || (empty($level)) || (empty($location)) ) {
        echo "Rating, Date, and a Checkbox must be entered.";
    } else {
        // create prepared statement
        $insert_health = "INSERT INTO health (date, level, location, cause, notes) VALUES ('".$date."', ".$level.", '".$location."', '".$cause."', '".$notes."')";
        
        // pass database connection and prepared statement as parameters        
        if ( mysqli_query($mysqli, $insert_health) ) {
            //echo "<br>" . "the row was added to health";
        } else {
            echo "<br>" . "Error: <br>" . $insert_health . "<br>" . mysqli_error($mysqli);
        }
    }
}        
?>


        
 </div>     
    </body>
</html>