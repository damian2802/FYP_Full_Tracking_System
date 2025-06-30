<?php
include 'conn.php';

session_start();
$activeuser = $_SESSION["username"];
$accessLevel = $_SESSION["accessLevel"];
$name = $_SESSION['name'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $info = $_POST['info'];
    $choices = isset($_POST['choices']) ? $_POST['choices'] : [];

    // Initialize columns for courses
    $pp = $krk = $ki = $im = 0;

    // Set columns to true if selected
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

    // Handle file upload
    $uploadDir = 'information/';
    $attachmentPath = '';
    
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0) {
        $fileTmpPath = $_FILES['attachment']['tmp_name'];
        $fileName = basename($_FILES['attachment']['name']);
        $uploadFilePath = $uploadDir . $fileName;
        
        // Ensure the upload directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        // Check if a file with the same name already exists
        if (file_exists($uploadFilePath)) {
            echo '<script language="javascript">';
            echo 'alert("File already exists! Please rename the file"); location.href="cdr_fypInfo.php"';
            echo '</script>';
            exit();
        }
        
        if (move_uploaded_file($fileTmpPath, $uploadFilePath)) {
            $attachmentPath = $uploadFilePath;
        } else {
            echo '<script language="javascript">';
            echo 'alert("Error moving the file to the upload directory."); location.href="cdr_fypInfo.php"';
            echo '</script>';
            exit();
        }
    }
    
    // Get the current datetime
    $created_at = date('Y-m-d H:i:s');

    // Prepare an insert statement
    $stmt = $conn->prepare("INSERT INTO fypinfo (infoDetail, attachment, postDate, pp, krk, ki, im, coorID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Check if the prepare() succeeded
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the parameters
    $stmt->bind_param("sssiiiis", $info, $attachmentPath, $created_at, $pp, $krk, $ki, $im, $activeuser);

    // Execute the insert statement
    $stmt->execute();

    // Close the statement
    $stmt->close();

    echo '<script language="javascript">';
    echo 'alert("Succesfully Inserted!"); location.href="cdr_fypInfo.php"';
    echo '</script>';
}

?>