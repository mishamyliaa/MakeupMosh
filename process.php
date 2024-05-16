<?php
 
$servername = "lrgs.ftsm.ukm.my";
$username = "a186913";
$password = "cutewhitecat";
$dbname = "a186913";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
?>