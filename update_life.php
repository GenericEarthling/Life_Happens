<?php
session_start();
include_once("config.php");









// save sql query to variables    
// need to be in this order which is the same as the database table      
/*
$insert_health = "INSERT INTO health VALUES (".$date.", ".$level.", ".$checkbox.", ".$cause.", ".$notes.")";
$insert_activity = "INSERT INTO activity VALUES (".$date.", ".$level.", ".$checkbox.", ".$cause.", ".$notes.")";
$insert_mood = "INSERT INTO mood VALUES (".$date.", ".$level.", ".$checkbox.", ".$cause.", ".$notes.")";
*/ 
  
    
 // set the current URL to redirect back to
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$SERVER['REQUEST_URI']);   
    
?>