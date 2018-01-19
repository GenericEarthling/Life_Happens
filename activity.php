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
            color:#cc3399;
        }
        a {
            font-size: 12px;
        }
    </style> 
    <body>
    <!---------------------- background ------------------------->
    <div class="w3-margin-top w3-card-2 w3-center" style="width:400px; margin:auto;">
        <header class="w3-container w3-block w3-metro-purple">
            <div class="w3-bar">
                <a class=" w3-padding-small w3-button w3-bar-item w3-metro-purple" href="index.php">HOME</a>
                <a class=" w3-padding-small w3-button w3-bar-item w3-metro-purple" href="activity.php">ACTIVITY</a>
                <a class=" w3-padding-small w3-button w3-bar-item w3-metro-purple" href="health.php">HEALTH</a>
                <a class=" w3-padding-small w3-button w3-bar-item w3-metro-purple" href="mood.php">MOOD</a>
                <a class=" w3-padding-small w3-button w3-bar-item w3-metro-purple" href="graph.php">MY STATS</a>
            </div>
            <h1>Activity</h1>
        </header>
    <!---------------------- bkgd working area ------------------------->    
        <div class="w3-container w3-metro-darken">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        
        
            
            
        <!-- LEVEL -->
        <h4 class="w3-left">RATE YOUR ACTIVITY LEVEL</h4>
        <div>
            <input type="range" min="0" max="10" class="w3-margin-top w3-block" name="level" value="0">
             <label style="color: grey;">Low ----------------------------------------- High</label>       
        </div>
        
        <!-- DATE -->
        <h4 class="w3-left">DATE</h4>
        <input class="w3-block w3-border w3-dark-grey" type="date" name="date" ><br>

        <!-- CHECKBOX -->
        <h4 class="w3-left">WHAT DID YOU DO TODAY?</h4>           
            <table>
                <tr>
                    <td>
                        <input class="w3-check w3-left" type="checkbox" name="checkbox" value="Walked"><label class="w3-left">&nbsp;Walked &nbsp;</label>                        
                    </td>
                    <td>
                        <input class="w3-check w3-left" type="checkbox" name="checkbox" value="Nothing"><label class="w3-left">&nbsp;Nothing &nbsp;</label>
                    </td>
                    <td>
                        <input class="w3-check w3-left" type="checkbox" name="checkbox" value="Aerobics"><label class="w3-left">&nbsp;Aerobics &nbsp;</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="w3-check w3-left" type="checkbox" name="checkbox" value="Stairstep"><label class="w3-left">&nbsp;Stairstep &nbsp;</label>
                    </td>
                    <td>
                        <input class="w3-check w3-left" type="checkbox" name="checkbox" value="Weights"><label class="w3-left">&nbsp;Weights &nbsp;</label>
                    </td>
                    <td>
                        <input class="w3-check w3-left" type="checkbox" name="checkbox" value="Cycled"><label class="w3-left">&nbsp;Cycled &nbsp;</label>
                    </td>                
                </tr>
                <tr>
                    <td>
                        <input class="w3-check w3-left" type="checkbox" name="checkbox" value="Run"><label class="w3-left">&nbsp;Run &nbsp;</label>
                    </td>
                    <td>
                        <input class="w3-check w3-left" type="checkbox" name="checkbox" value="Yoga"><label class="w3-left">&nbsp;Yoga &nbsp;</label>
                    </td>
                    <td>
                        <input class="w3-check w3-left" type="checkbox" name="checkbox" value="Stretched"><label class="w3-left">&nbsp;Stretched &nbsp;</label>
                    </td>                
                </tr>
            </table>    

           
            

        <!-- CAUSE -->
        <h4 class="w3-left">WHY OR WHY NOT EXERCISE TODAY?</h4>
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
    $activity = $_POST['checkbox'];
    $level = $_POST['level'];
    $cause = $_POST['cause'];
    $notes = $_POST['notes'];
    
    // escape out single and double quotes
    $cause = $mysqli->real_escape_string($cause);
    $notes = $mysqli->real_escape_string($notes);
    
    // make sure date and level is selected
    //     -- only recording the last checkbox selected and not all of them... hmmm
    if ( (empty($date)) || (empty($level)) || (empty($activity)) ) {
        echo "Rating, Date, and a Checkbox must be entered.";
    } else {
        // create prepared statement
        $insert_activity = "INSERT INTO activity (date, level, activity, cause, notes) VALUES ('".$date."', ".$level.", '".$activity."', '".$cause."', '".$notes."')";
        
        // pass database connection and prepared statement as parameters        
        if ( mysqli_query($mysqli, $insert_activity) ) {
            //echo "<br>" . "the row was added to activity";
        } else {
            echo "<br>" . "Error: <br>" . $insert_activity . "<br>" . mysqli_error($mysqli);
        }
    }
}        
?>       
        
      </div>
    </body>
</html>