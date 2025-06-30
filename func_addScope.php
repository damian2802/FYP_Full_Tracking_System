<?php
include 'conn.php';

session_start();
$activeuser = $_SESSION["username"];
$accessLevel = $_SESSION["accessLevel"];
$name = $_SESSION['name'];



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $scope = $_POST['scope'];
    $choices = isset($_POST['choices']) ? $_POST['choices'] : [];

    $pp = $krk = $ki = $im = 0;

    foreach ($choices as $choice) {
        switch ($choice) {
            case 'PP':
                $pp = 1;
                break;
            case 'KRK':
                $krk = 1;
                break;
            case 'KI':
                $ki = 1;
                break;
            case 'IM':
                $im = 1;
                break;
        }
    }

    $select = mysqli_query($conn, "SELECT * FROM scope WHERE scope='$scope'");
    $count = mysqli_num_rows($select);

    if($count == 0){
        $query = mysqli_query($conn, "INSERT INTO scope (scope, pp, krk, ki, im) VALUES ('$scope','$pp','$krk','$ki','$im')");
        
        if($query){
            echo '<script language="javascript">';
            echo 'alert("Scope Sucessfully Added!"); location.href="cdr_manageAssigning.php"';
            echo '</script>';
        }else{
            echo '<script language="javascript">';
            echo 'alert("Failed to be Added!"); location.href="cdr_manageAssigning.php"';
            echo '</script>';
        }
    }else{
        echo '<script language="javascript">';
        echo 'alert("Scope already Exists!"); location.href="cdr_manageAssigning.php"';
        echo '</script>';
    }
    
}

?>