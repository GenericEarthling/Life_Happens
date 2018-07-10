<?php

$db_username = 'stender';
$db_password = '';
$db_name = 'LifeHappens';
$db_host = 'mysql.yaacotu.com'; // 107.180.40.137  // localhost

// can declare global variables here


//connect to MySql						
$mysqli = new mysqli($db_host, $db_username, $db_password,$db_name);						
if ($mysqli->connect_error) {
    die('FROM Config.php ERROR: ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}


?>
