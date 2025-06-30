<?php
include 'conn.php';
session_start();
$activeuser = $_SESSION["username"];
$accessLevel = $_SESSION["accessLevel"];
$name = $_SESSION['name'];
$course = $_SESSION['course'];

if(isset($_POST['progress1'])){
    $projectTitle = $_POST['projectTitle'];
    $synopsis = $_POST['synopsis'];

    $update = mysqli_query($conn, "UPDATE projectdetails SET projectTitle = '$projectTitle', projectSynopsis = '$synopsis' WHERE matricNo = '$activeuser'");

    if($update){
        echo '<script language="javascript">';
        echo 'alert("Successfully Updated!"); location.href="std_fypProgress.php"';
        echo '</script>';
    }else{
        echo '<script language="javascript">';
        echo 'alert("Error Updating!"); location.href="std_fypProgress.php"';
        echo '</script>';
    }

}else if(isset($_POST['progress2'])){
    $targetDir = "uploads/$activeuser/";

    // Check if directory exists, if not create it
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Define a custom name for the file
    $customFileName = $activeuser . "_Progess2.pdf";
    $targetFile = $targetDir . $customFileName;
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
    
    // Check if file is a PDF
    if($fileType != "pdf") {
        $uploadOk = 0;
        echo '<script language="javascript">';
        echo 'alert("Sorry, only PDF files are allowed."); location.href="std_fypProgress.php"';
        echo '</script>';
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo '<script language="javascript">';
        echo 'alert("Sorry, your file was not uploaded."); location.href="std_fypProgress.php"';
        echo '</script>';
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            $update = mysqli_query($conn, "UPDATE projectdetails SET projectProgress2 ='$targetFile' WHERE matricNo ='$activeuser'");
            echo '<script language="javascript">';
            echo 'alert("Successfully Updated!"); location.href="std_fypProgress.php"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Error moving the file to the upload directory."); location.href="std_fypProgress.php"';
            echo '</script>';
            exit();
        }
    }

}else if(isset($_POST['progress3'])){
    $targetDir = "uploads/$activeuser/";

    // Check if directory exists, if not create it
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Define a custom name for the file
    $customFileName = $activeuser . "_Progess3.pdf";
    $targetFile = $targetDir . $customFileName;
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
    
    // Check if file is a PDF
    if($fileType != "pdf") {
        $uploadOk = 0;
        echo '<script language="javascript">';
        echo 'alert("Sorry, only PDF files are allowed."); location.href="std_fypProgress.php"';
        echo '</script>';
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo '<script language="javascript">';
        echo 'alert("Sorry, your file was not uploaded."); location.href="std_fypProgress.php"';
        echo '</script>';
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            $update = mysqli_query($conn, "UPDATE projectdetails SET projectProgress3 ='$targetFile' WHERE matricNo ='$activeuser'");
            echo '<script language="javascript">';
            echo 'alert("Successfully Updated!"); location.href="std_fypProgress.php"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Error moving the file to the upload directory."); location.href="std_fypProgress.php"';
            echo '</script>';
            exit();
        }
    }
    
}else if(isset($_POST['progress4'])){
    $targetDir = "uploads/$activeuser/";

    // Check if directory exists, if not create it
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Define a custom name for the file
    $customFileName = $activeuser . "_ReportDraftSubmission.pdf";
    $targetFile = $targetDir . $customFileName;
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
    
    // Check if file is a PDF
    if($fileType != "pdf") {
        $uploadOk = 0;
        echo '<script language="javascript">';
        echo 'alert("Sorry, only PDF files are allowed."); location.href="std_fypProgress.php"';
        echo '</script>';
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo '<script language="javascript">';
        echo 'alert("Sorry, your file was not uploaded."); location.href="std_fypProgress.php"';
        echo '</script>';
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            $update = mysqli_query($conn, "UPDATE projectdetails SET projectProgress4 ='$targetFile' WHERE matricNo ='$activeuser'");
            echo '<script language="javascript">';
            echo 'alert("Successfully Updated!"); location.href="std_fypProgress.php"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Error moving the file to the upload directory."); location.href="std_fypProgress.php"';
            echo '</script>';
            exit();
        }
    }
    
}else if(isset($_POST['progress5'])){
    $targetDir = "uploads/$activeuser/";

    // Check if directory exists, if not create it
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Define a custom name for the file
    $customFileName = $activeuser . "_ReportSubmission.pdf";
    $targetFile = $targetDir . $customFileName;
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
    
    // Check if file is a PDF
    if($fileType != "pdf") {
        $uploadOk = 0;
        echo '<script language="javascript">';
        echo 'alert("Sorry, only PDF files are allowed."); location.href="std_fypProgress.php"';
        echo '</script>';
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo '<script language="javascript">';
        echo 'alert("Sorry, your file was not uploaded."); location.href="std_fypProgress.php"';
        echo '</script>';
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            $update = mysqli_query($conn, "UPDATE projectdetails SET projectProgress5 ='$targetFile' WHERE matricNo ='$activeuser'");
            echo '<script language="javascript">';
            echo 'alert("Successfully Updated!"); location.href="std_fypProgress.php"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Error moving the file to the upload directory."); location.href="std_fypProgress.php"';
            echo '</script>';
            exit();
        }
    }
    
}else if(isset($_POST['progress6'])){
    $targetDir = "uploads/$activeuser/";

    // Check if directory exists, if not create it
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Define a custom name for the file
    $customFileName = $activeuser . "_PosterSubmission.pdf";
    $targetFile = $targetDir . $customFileName;
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
    
    // Check if file is a PDF
    if($fileType != "pdf") {
        $uploadOk = 0;
        echo '<script language="javascript">';
        echo 'alert("Sorry, only PDF files are allowed."); location.href="std_fypProgress.php"';
        echo '</script>';
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo '<script language="javascript">';
        echo 'alert("Sorry, your file was not uploaded."); location.href="std_fypProgress.php"';
        echo '</script>';
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            $update = mysqli_query($conn, "UPDATE projectdetails SET projectProgress6 ='$targetFile' WHERE matricNo ='$activeuser'");
            echo '<script language="javascript">';
            echo 'alert("Successfully Updated!"); location.href="std_fypProgress.php"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Error moving the file to the upload directory."); location.href="std_fypProgress.php"';
            echo '</script>';
            exit();
        }
    }
    
}else if(isset($_POST['progress7'])){
    $targetDir = "uploads/$activeuser/";

    // Check if directory exists, if not create it
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Define a custom name for the file
    $customFileName = $activeuser . "_FinalDraftReportSubmission.pdf";
    $targetFile = $targetDir . $customFileName;
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
    
    // Check if file is a PDF
    if($fileType != "pdf") {
        $uploadOk = 0;
        echo '<script language="javascript">';
        echo 'alert("Sorry, only PDF files are allowed."); location.href="std_fypProgress.php"';
        echo '</script>';
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo '<script language="javascript">';
        echo 'alert("Sorry, your file was not uploaded."); location.href="std_fypProgress.php"';
        echo '</script>';
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            $update = mysqli_query($conn, "UPDATE projectdetails SET projectProgress7 ='$targetFile' WHERE matricNo ='$activeuser'");
            echo '<script language="javascript">';
            echo 'alert("Successfully Updated!"); location.href="std_fypProgress.php"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Error moving the file to the upload directory."); location.href="std_fypProgress.php"';
            echo '</script>';
            exit();
        }
    }
    
}else if(isset($_POST['progress8'])){
    $targetDir = "uploads/$activeuser/";

    // Check if directory exists, if not create it
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Define a custom name for the file
    $customFileName = $activeuser . "_FinalReportSubmission.pdf";
    $targetFile = $targetDir . $customFileName;
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
    
    // Check if file is a PDF
    if($fileType != "pdf") {
        $uploadOk = 0;
        echo '<script language="javascript">';
        echo 'alert("Sorry, only PDF files are allowed."); location.href="std_fypProgress.php"';
        echo '</script>';
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo '<script language="javascript">';
        echo 'alert("Sorry, your file was not uploaded."); location.href="std_fypProgress.php"';
        echo '</script>';
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            $update = mysqli_query($conn, "UPDATE projectdetails SET projectProgress8 ='$targetFile' WHERE matricNo ='$activeuser'");
            echo '<script language="javascript">';
            echo 'alert("Successfully Updated!"); location.href="std_fypProgress.php"';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Error moving the file to the upload directory."); location.href="std_fypProgress.php"';
            echo '</script>';
            exit();
        }
    }
    
}

if(isset($_POST['comment2'])){
    $matricNo = $_GET['studentid'];
    $comment = $_POST['comment'];

    $update = mysqli_query($conn, "UPDATE projectdetails SET supervisorReview2 = '$comment' WHERE matricNo = '$matricNo'");

    if($update){
        echo '<script language="javascript">';
        echo 'alert("Successfully Updated Review!"); location.href="sv_fypProgress.php?userid='.$matricNo.'"';
        echo '</script>';
    }else{
        echo '<script language="javascript">';
        echo 'alert("Error Updating Review!"); location.href="sv_fypProgress.php?userid='.$matricNo.'"';
        echo '</script>';

    }
}else if(isset($_POST['comment3'])){
    $matricNo = $_GET['studentid'];
    $comment = $_POST['comment'];

    $update = mysqli_query($conn, "UPDATE projectdetails SET supervisorReview3 = '$comment' WHERE matricNo = '$matricNo'");

    if($update){
        echo '<script language="javascript">';
        echo 'alert("Successfully Updated Review!"); location.href="sv_fypProgress.php?userid='.$matricNo.'"';
        echo '</script>';
    }else{
        echo '<script language="javascript">';
        echo 'alert("Error Updating Review!"); location.href="sv_fypProgress.php?userid='.$matricNo.'"';
        echo '</script>';

    }

}else if(isset($_POST['comment4'])){
    $matricNo = $_GET['studentid'];
    $comment = $_POST['comment'];

    $update = mysqli_query($conn, "UPDATE projectdetails SET supervisorReview4 = '$comment' WHERE matricNo = '$matricNo'");

    if($update){
        echo '<script language="javascript">';
        echo 'alert("Successfully Updated Review!"); location.href="sv_fypProgress.php?userid='.$matricNo.'"';
        echo '</script>';
    }else{
        echo '<script language="javascript">';
        echo 'alert("Error Updating Review!"); location.href="sv_fypProgress.php?userid='.$matricNo.'"';
        echo '</script>';

    }

}else if(isset($_POST['comment5'])){
    $matricNo = $_GET['studentid'];
    $Grade1 = $_POST['grade1'];
    $Grade2 = $_POST['grade2'];
    $Grade3 = $_POST['grade3'];
    $Grade4 = $_POST['grade4'];
    $Grade5 = $_POST['grade5'];
    $Grade6 = $_POST['grade6'];

    $totalGrade = $Grade1 + $Grade2 + $Grade3 + $Grade4 + $Grade5 + $Grade6;


    $update = mysqli_query($conn, "UPDATE projectdetails SET proposalReportGrade1 = '$Grade1', proposalReportGrade2 = '$Grade2', proposalReportGrade3 = '$Grade3', proposalReportGrade4 = '$Grade4', proposalReportGrade5 = '$Grade5', proposalReportGrade6 = '$Grade6', proposalReportTotal = '$totalGrade' WHERE matricNo = '$matricNo'");

    if($update){
        echo '<script language="javascript">';
        echo 'alert("Successfully Updated Grade!"); location.href="sv_fypProgress.php?userid='.$matricNo.'"';
        echo '</script>';
    }else{
        echo '<script language="javascript">';
        echo 'alert("Error Updating Grade!"); location.href="sv_fypProgress.php?userid='.$matricNo.'"';
        echo '</script>';

    }

}else if(isset($_POST['comment6'])){
    $matricNo = $_GET['studentid'];
    $comment = $_POST['comment'];

    $update = mysqli_query($conn, "UPDATE projectdetails SET supervisorReview6 = '$comment' WHERE matricNo = '$matricNo'");

    if($update){
        echo '<script language="javascript">';
        echo 'alert("Successfully Updated Review!"); location.href="sv_fypProgress.php?userid='.$matricNo.'"';
        echo '</script>';
    }else{
        echo '<script language="javascript">';
        echo 'alert("Error Updating Review!"); location.href="sv_fypProgress.php?userid='.$matricNo.'"';
        echo '</script>';

    }

}else if(isset($_POST['comment7'])){
    $matricNo = $_GET['studentid'];
    $comment = $_POST['comment'];

    $update = mysqli_query($conn, "UPDATE projectdetails SET supervisorReview7 = '$comment' WHERE matricNo = '$matricNo'");

    if($update){
        echo '<script language="javascript">';
        echo 'alert("Successfully Updated Review!"); location.href="sv_fypProgress.php?userid='.$matricNo.'"';
        echo '</script>';
    }else{
        echo '<script language="javascript">';
        echo 'alert("Error Updating Review!"); location.href="sv_fypProgress.php?userid='.$matricNo.'"';
        echo '</script>';

    }

}else if(isset($_POST['comment8'])){
    $matricNo = $_GET['studentid'];
    $Grade1 = $_POST['grade1'];
    $Grade2 = $_POST['grade2'];
    $Grade3 = $_POST['grade3'];
    $Grade4 = $_POST['grade4'];
    $Grade5 = $_POST['grade5'];
    $Grade6 = $_POST['grade6'];
    $Grade7 = $_POST['grade7'];
    $Grade8 = $_POST['grade8'];

    $totalGrade = $Grade1 + $Grade2 + $Grade3 + $Grade4 + $Grade5 + $Grade6 + $Grade7 + $Grade8;
  

    $update = mysqli_query($conn, "UPDATE projectdetails SET reportGrade1 = '$Grade1', reportGrade2 = '$Grade2', reportGrade3 = '$Grade3', reportGrade4 = '$Grade4', reportGrade5 = '$Grade5', reportGrade6 = '$Grade6', reportGrade7 = '$Grade7', reportGrade8 = '$Grade8', reportTotal = '$totalGrade' WHERE matricNo = '$matricNo'");

    if($update){
        echo '<script language="javascript">';
        echo 'alert("Successfully Updated Grade!"); location.href="sv_fypProgress.php?userid='.$matricNo.'"';
        echo '</script>';
    }else{
        echo '<script language="javascript">';
        echo 'alert("Error Updating Grade!"); location.href="sv_fypProgress.php?userid='.$matricNo.'"';
        echo '</script>';

    }

}
















?>