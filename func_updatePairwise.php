<?php
include 'conn.php';

session_start();
$activeuser = $_SESSION["username"];
$accessLevel = $_SESSION["accessLevel"];
$name = $_SESSION['name'];


// Get the data from POST request
$data = json_decode(file_get_contents('php://input'), true);

// Check if decoding was successful
if ($data === null) {
    // Handle JSON decoding error
    http_response_code(400); // Bad Request
    echo "Error decoding JSON data.";
    exit; // Terminate the script
}

$finalPriorities = $data['finalPriorities'];
$matrix = $data['matrix'];

$c12 = $matrix[0][1];
$c13 = $matrix[0][2];
$c21 = $matrix[1][0];
$c23 = $matrix[1][2];
$c31 = $matrix[2][0];
$c32 = $matrix[2][1];

$cw1 = $finalPriorities[0]; 
$cw2 = $finalPriorities[1]; 
$cw3 = $finalPriorities[2]; 

$check = mysqli_query($conn, "SELECT * FROM pairwise");
$count = mysqli_num_rows($check);

if($count == 0){
    echo "EMPTY";
    $result = mysqli_query($conn, "INSERT INTO pairwise (c12, c13, c21, c23, c31, c32, cw1, cw2, cw3, username) 
    VALUES ('".$c12."', '".$c13."', '".$c21."', '".$c23."', '".$c31."', '".$c32."', '".$cw1."', '".$cw2."','".$cw3."','".$activeuser."')");
                
                
}else{
    echo "NO empty";
    $pairID = 1;
    $update  = mysqli_query($conn,"UPDATE pairwise SET c12 = '$c12', c13 = '$c13', c21 = '$c21', c23 = '$c23', c31 = '$c31', c32 = '$c32', cw1 = '$cw1', cw2 = '$cw2', cw3= '$cw3', username = '$activeuser' WHERE pairwiseID = '$pairID'");
    
}

?>
