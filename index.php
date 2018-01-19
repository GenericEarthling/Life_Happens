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
        a {
            color: white;
        }
    </style>
    <body>
    <div class="w3-margin-top w3-card-2 w3-center" style="width:400px; margin:auto;">
        <header class="w3-container w3-block w3-metro-dark-blue">
            <h1>Life Happens</h1>
        </header>
        
        <div class="w3-container w3-metro-darken">
        <!-- Health Button -->
        <br>
        <a href="health.php" class="w3-button w3-block w3-xxlarge" style="background-color:#6b9023; color:white;">HEALTH</a><br>            
            
        <!-- Mood Button -->            
        <a href="mood.php" class="w3-button w3-block w3-xxlarge" style="background-color:#00b3b3; color:white;">MOOD</a><br>

        <!-- Activity Button -->
        <a href="activity.php" class="w3-button w3-block w3-xxlarge" style="background-color:#8f246b; color:white;">ACTIVITY</a><br> 

        <!-- Graph Button -->
        <a href="graph.php" class="w3-button w3-block w3-xxlarge w3-metro-dark-orange" style="color:white;">STATISTICS</a><br>
            
        </div>        
         
        <footer class="w3-container w3-block w3-metro-dark-blue">
             <h5>Inhale good stuff, Exhale bad stuff.</h5>
        </footer>
      </div>
    </body>
</html>