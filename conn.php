<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
$servername= "localhost";
$username = "root";
$password="";
$dbname ="fypsystem";


$conn = mysqli_connect($servername,$username, $password, $dbname);

if(!$conn) {
 die("Connection failed: " . mysqli_connect_error());
 }
 //echo "Connection s";
 ?>