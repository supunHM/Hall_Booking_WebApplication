<?php
$dbuser="root";
$dbpass="";
$host="localhost";
$db="finalHallBookings";
$mysqli=new mysqli($host,$dbuser, $dbpass, $db);

if($mysqli->connect_errno){
    echo "Failed to connect to MySql: " . $mysqli->connect_errno;
}
?>
