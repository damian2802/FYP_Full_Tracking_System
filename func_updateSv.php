<?php
include 'conn.php';

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
                $username = $line[0];
                $svName = $line[1];
                $field = $line[2];
                $assignedCount = 0;
                $accessLevel = 1;
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT * FROM supervisor WHERE username = '$line[0]'";
                $prevResult= mysqli_query($conn,$prevQuery);
                //$prevResult = $conn->query($prevQuery);
                
                if(mysqli_num_rows($prevResult) > 0){
                    // Update member data in the database
                    echo '<script language="javascript">';
                    echo 'alert("Data already exist!"); location.href="cdr_updateSupervisorList.php"';
                    echo '</script>';
                exit;
                }else{
                    //Insert member data in the database
                    $hashedPassword = password_hash($username, PASSWORD_DEFAULT);
                    mysqli_query($conn, "INSERT INTO supervisor (username, password, svName, field, assignedCount) VALUES ('".$username."', '".$hashedPassword."', '".$svName."', '".$field."', '".$assignedCount."')");
                    echo '<script language="javascript">';
                    echo 'alert("Data Successfully Saved!"); location.href="cdr_updateSupervisorList.php"';
                    echo '</script>';
            
                }
              

           
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
        }else{
            echo '<script language="javascript">';
            echo 'alert("Please select a file!");';
            echo 'window.location.href = "cdr_updateSupervisorList.php";';
            echo '</script>';
        exit;
        }
    }else{
        echo '<script language="javascript">';
        echo 'alert("Please select a file!");';
        echo 'window.location.href = "cdr_updateSupervisorList.php";';
        echo '</script>';
        exit;
    }
}
 ?>