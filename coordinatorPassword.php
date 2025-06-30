<?php
include 'conn.php';
$username = "01658586879";
$password = "Admin@";
$coorName = "Mr Coordinator";
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
mysqli_query($conn, "INSERT INTO coordinator (username, password, coorName) VALUES ('".$username."', '".$hashedPassword."', '".$coorName."')");

?>



