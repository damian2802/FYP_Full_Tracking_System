<?php
include 'conn.php';
session_start();
$activeuser = $_SESSION["username"];
$accessLevel = $_SESSION["accessLevel"];
$name = $_SESSION['name'];

$infoID = $_GET['infoID'];
$attachmentPath = $_GET['attachment'];

// Delete the attachment file from the server if it exists
if (!empty($attachmentPath) && file_exists($attachmentPath)) {
    unlink($attachmentPath); // Delete the file from the server
}

 
    $result = mysqli_query($conn, "DELETE FROM fypinfo WHERE infoID='$infoID'");

    if($result == true){
        echo '<script language="javascript">';
        echo 'alert("Succesfully Deleted!"); location.href="cdr_fypInfo.php"';
        echo '</script>';

    }else{
        echo '<script language="javascript">';
        echo 'alert("Error deleting!"); location.href="cdr_fypInfo.php"';
        echo '</script>';
    }

?>