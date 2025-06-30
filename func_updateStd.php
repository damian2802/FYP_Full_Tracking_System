<?php
include 'conn.php';
session_start();
$activeuser = $_SESSION["username"];
$accessLevel = $_SESSION["accessLevel"];

if(isset($_POST['importSubmit'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $matricNo = $line[0];
                $fullname = $line[1];
                $course = $line[2];
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT * FROM students WHERE matricno = '$line[0]'";
                $prevResult= mysqli_query($conn,$prevQuery);
                //$prevResult = $conn->query($prevQuery);
                
                if(mysqli_num_rows($prevResult) > 0){
                    // Update member data in the database
                    echo '<script language="javascript">';
                    echo 'alert("Data already exist!"); location.href="cdr_updateStudentList.php"';
                    echo '</script>';
                exit;
                }else{
                    //Insert member data in the database
                    $hashedPassword = password_hash($matricNo, PASSWORD_DEFAULT);
                    mysqli_query($conn, "INSERT INTO students (matricNo, password, studentName, course) VALUES ('".$matricNo."', '".$hashedPassword."', '".$fullname."', '".$course."')");
                    echo '<script language="javascript">';
                    echo 'alert("Data Successfully Saved!"); location.href="cdr_updateStudentList.php"';
                    echo '</script>';
            
                }
              

           
            }
            
            // Close opened CSV file
            fclose($csvFile);
        }else{
            echo '<script language="javascript">';
            echo 'alert("Error Occured Updating Student List!");';
            echo 'window.location.href = "cdr_updateStudentList.php";';
            echo '</script>';
            exit;
        }
    }else{
        echo '<script language="javascript">';
        echo 'alert("Please select a file!");';
        echo 'window.location.href = "cdr_updateStudentList.php";';
        echo '</script>';
        exit;
    }
}
 ?>