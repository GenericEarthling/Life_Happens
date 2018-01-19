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
        p {
            font-size: 12px;
            text-align: left;
            line-height: 5px;
            color:darkgray;
        }
        h2,h4,h5 {
            font-size: 28px;
            text-align: left;
            line-height: 5px;
        }
        h3 {
            font-size: 12px;
            text-align: left;
            line-height: 1px; 
            margin-left:-30px;
            color:darkgray;
        }
        #graph {
            max-width: 380px;
            padding-left: 30px;
        }
        a {
            font-size: 12px;
        }
    </style>
    <body>

            <!---------------------- background ------------------------->
    <div class="w3-margin-top w3-card-2 w3-center" style="width:400px; margin:auto;">
        <header class="w3-container w3-block w3-metro-dark-orange">            
            <div class="w3-bar">
                <a class=" w3-padding-small w3-button w3-bar-item w3-metro-dark-orange" href="index.php">HOME</a>
                <a class=" w3-padding-small w3-button w3-bar-item w3-metro-dark-orange" href="activity.php">ACTIVITY</a>
                <a class=" w3-padding-small w3-button w3-bar-item w3-metro-dark-orange" href="health.php">HEALTH</a>
                <a class=" w3-padding-small w3-button w3-bar-item w3-metro-dark-orange" href="mood.php">MOOD</a>
                <a class=" w3-padding-small w3-button w3-bar-item w3-metro-dark-orange" href="graph.php">MY STATS</a>
            </div>
            <h1>My Statistics</h1>
        </header>
    <!---------------------- bkgd working area ------------------------->    
        <div class="w3-container w3-metro-darken">
        <div>    
<?php
// get the date from 30 days prior to today
$today = new DateTime();
$todayString = $today->format('m-d-Y');
$today->sub(new DateInterval('P30D'));
$date30prior = $today->format('m-d-Y');

// display date range charted in the graph
echo "<p class='w3-left w3-block'> 30 day overview from ". $date30prior . " to " . $todayString . "</p>";
?> 

            
 <!--------- legend --------->           
<p class="w3-left w3-block">
<span style="color:#6b9023">Health: &#9648;&emsp;</span>
<span style="color:#cc3399">Activity: &#9648;&emsp;</span>
<span style="color:#00b3b3">Mood: &#9648;</span></p><br><br><br>
            
<hr class="w3-block w3-metro-dark-orange">
 <div id="graph">
    <p>
    0&ensp;&#8193;&#8193;&#8193;2&ensp;&#8193;&#8193;&#8193;4&ensp;&#8193;
    &#8193;&#8193;6&ensp;&#8193;&#8193;&#8193;8&ensp;&#8193;&#8193;&#8193;
    10
    </p><hr class="w3-block w3-metro-dark-orange">
            
            
<?php>       

// date for loop           
$thisday = new DateTime();
$now = $thisday->format('Y-m-d');
$now_formated = $thisday->format('m-d');
     echo "<h3>" . $now_formated . "</h3>";
$index = 30;            
while( $index > 0) {
    // display the date for the current graphic 
    echo "<h3>" . $display_now . "</h3>";
    
    // get health level
    $health_q = "SELECT level FROM health WHERE date='" .$now. "'";   
    $result = $mysqli->query($health_q);
    $row = mysqli_fetch_assoc($result);
    $healthLevel = $row['level'];
    
    // get activity level
    $activity_q = "SELECT level FROM activity WHERE date='" .$now. "'";   
    $resultA = $mysqli->query($activity_q);
    $rowA = mysqli_fetch_assoc($resultA);
    $activityLevel = $rowA['level'];
    
    // get mood level
    $mood_q = "SELECT level FROM mood WHERE date='" .$now. "'";   
    $resultM = $mysqli->query($mood_q);
    $rowM = mysqli_fetch_assoc($resultM);
    $moodLevel = $rowM['level'];
   
    
    
    /*  if data for current date is not null, echo the level's value. Else echo ""   */
    if ( $healthLevel != null ) {
        echo "<h2 style='color:#6b9023'>";    
        for ( $i=0; $i<$healthLevel; $i++ ) {
            echo "&#9602;";        
        }
        echo "</h2>";        
    } else {
        echo "";
    }
    if ( $activityLevel != null ) {
        echo "<h2 style='color:#cc3399'>";    
        for ( $i=0; $i<$activityLevel; $i++ ) {
            echo "&#9602;";        
        }
        echo "</h2>";        
    } else {
        echo "";
    }
    if ( $moodLevel != null ) {
        echo "<h2 style='color:#00b3b3'>";    
        for ( $i=0; $i<$moodLevel; $i++ ) {
            echo "&#9602;";        
        }
        echo "</h2>";        
    } else {
        echo "";
    }
    echo "<br>";
     
    // subtract one day from the $now variable and save new value back to it
    $thisday->sub(new DateInterval('P1D'));
    $now = $thisday->format('Y-m-d');
    $display_now = $thisday->format('m-d'); 
    $display_now = $thisday->format('m-d'); 
    
    // decrement while loop
    $index--;
}           

       
?>            
            </div>      
        </div>     
        </div> 
    <!---------------------- END OF bkgd working area ------------------------->
         

      </div>
    </body>
</html>