<?php 
include 'conn.php';
session_start();
$activeuser = $_SESSION["username"];
$accessLevel = $_SESSION["accessLevel"];
$name = $_SESSION['name'];
$field  = $_SESSION['course'];

$expertise = $_POST['expertise'];
$projectPref = $_POST['preference'];


if(isset($_POST['Update'])){
    
    $result = mysqli_query($conn, "UPDATE supervisor SET expertise = '$expertise', projectPreference = '$projectPref' WHERE username = '$activeuser'");
    if($result == true){
        echo '<script language="javascript">';
        echo 'alert("Successfully Updated Preference!"); location.href="sv_updateExpertise.php"';
        echo '</script>';
    }else{
        echo '<script language="javascript">';
        echo 'alert("Failed to Update!"); location.href="sv_updateExpertise.php"';
        echo '</script>';
    }
}else if(isset($_POST['Confirm'])){
    
    $TRUE = 1;
    $confirm = mysqli_query($conn, "UPDATE supervisor SET confirmStatus = '$TRUE' WHERE username = '$activeuser'");

    if($confirm == true){
        echo '<script language="javascript">';
        echo 'alert("You have finalised your update!"); location.href="sv_updateExpertise.php"';
        echo '</script>';
    }else{
        echo '<script language="javascript">';
        echo 'alert("Error occured!"); location.href="sv_updateExpertise.php"';
        echo '</script>';
    }
}
?>
