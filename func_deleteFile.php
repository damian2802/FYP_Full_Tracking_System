<?php
include 'conn.php';
session_start();
$activeuser = $_SESSION["username"];
$accessLevel = $_SESSION["accessLevel"];
$name = $_SESSION['name'];
$course = $_SESSION['course'];

$progress = $_GET['prog'];
$attachmentPath = $_GET['attachment'];


if($progress == 2){
    if (!empty($attachmentPath) && file_exists($attachmentPath)) {
        unlink($attachmentPath); // Delete the file from the server
    }
        $update = mysqli_query($conn, "UPDATE projectdetails SET projectProgress2 = NULL WHERE matricNo='$activeuser'");
        if($update){
            echo '<script language="javascript">';
            echo 'alert("Succesfully Deleted!"); location.href="std_fypProgress.php"';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Error deleting!"); location.href="std_fypProgress.php"';
            echo '</script>';
        }

}else if($progress == 3){
    if (!empty($attachmentPath) && file_exists($attachmentPath)) {
        unlink($attachmentPath); // Delete the file from the server
    }
        $update = mysqli_query($conn, "UPDATE projectdetails SET projectProgress3 = NULL WHERE matricNo='$activeuser'");
        if($update){
            echo '<script language="javascript">';
            echo 'alert("Succesfully Deleted!"); location.href="std_fypProgress.php"';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Error deleting!"); location.href="std_fypProgress.php"';
            echo '</script>';
        }

}else if($progress == 4){
    if (!empty($attachmentPath) && file_exists($attachmentPath)) {
        unlink($attachmentPath); // Delete the file from the server
    }
        $update = mysqli_query($conn, "UPDATE projectdetails SET projectProgress4 = NULL WHERE matricNo='$activeuser'");
        if($update){
            echo '<script language="javascript">';
            echo 'alert("Succesfully Deleted!"); location.href="std_fypProgress.php"';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Error deleting!"); location.href="std_fypProgress.php"';
            echo '</script>';
        }

}else if($progress == 5){
    if (!empty($attachmentPath) && file_exists($attachmentPath)) {
        unlink($attachmentPath); // Delete the file from the server
    }
        $update = mysqli_query($conn, "UPDATE projectdetails SET projectProgress5 = NULL WHERE matricNo='$activeuser'");
        if($update){
            echo '<script language="javascript">';
            echo 'alert("Succesfully Deleted!"); location.href="std_fypProgress.php"';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Error deleting!"); location.href="std_fypProgress.php"';
            echo '</script>';
        }

}else if($progress == 6){
    if (!empty($attachmentPath) && file_exists($attachmentPath)) {
        unlink($attachmentPath); // Delete the file from the server
    }
        $update = mysqli_query($conn, "UPDATE projectdetails SET projectProgress6 = NULL WHERE matricNo='$activeuser'");
        if($update){
            echo '<script language="javascript">';
            echo 'alert("Succesfully Deleted!"); location.href="std_fypProgress.php"';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Error deleting!"); location.href="std_fypProgress.php"';
            echo '</script>';
        }

}else if($progress == 7){
    if (!empty($attachmentPath) && file_exists($attachmentPath)) {
        unlink($attachmentPath); // Delete the file from the server
    }
        $update = mysqli_query($conn, "UPDATE projectdetails SET projectProgress7 = NULL WHERE matricNo='$activeuser'");
        if($update){
            echo '<script language="javascript">';
            echo 'alert("Succesfully Deleted!"); location.href="std_fypProgress.php"';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Error deleting!"); location.href="std_fypProgress.php"';
            echo '</script>';
        }

}else if($progress == 8){
    if (!empty($attachmentPath) && file_exists($attachmentPath)) {
        unlink($attachmentPath); // Delete the file from the server
    }
        $update = mysqli_query($conn, "UPDATE projectdetails SET projectProgress8 = NULL WHERE matricNo='$activeuser'");
        echo "8";
        if($update){
            echo '<script language="javascript">';
            echo 'alert("Succesfully Deleted!"); location.href="std_fypProgress.php"';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Error deleting!"); location.href="std_fypProgress.php"';
            echo '</script>';
        }

}
?>