<?php
include 'conn.php';
session_start();
$activeuser = $_SESSION["username"];
$accessLevel = $_SESSION["accessLevel"];


$username = $_GET['userid'];
$userlevel = $_GET['usrlvl'];

if($userlevel == 1){

    $result = mysqli_query($conn, "DELETE FROM supervisor WHERE username='$username'");

    if($result == true){
        echo '<script language="javascript">';
        echo 'alert("Succesfully Deleted!"); location.href="cdr_updateSupervisorList.php"';
        echo '</script>';

    }else{
        echo '<script language="javascript">';
        echo 'alert("Error deleting!"); location.href="cdr_updateSupervisorList.php"';
        echo '</script>';
    }

}else if($userlevel == 2){
    
    $result = mysqli_query($conn, "DELETE FROM students WHERE matricNo ='$username'");

    if($result == true){
        echo '<script language="javascript">';
        echo 'alert("Succesfully Deleted!"); location.href="cdr_updateStudentList.php"';
        echo '</script>';

    }else{
        echo '<script language="javascript">';
        echo 'alert("Error deleting!"); location.href="cdr_updateStudentList.php"';
        echo '</script>';
    }


}else{
    echo '<script language="javascript">';
    echo 'alert("Error deleting!"); location.href="cdr_mainPage.php"';
    echo '</script>';
}




                
    


?>