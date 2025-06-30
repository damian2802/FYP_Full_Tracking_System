<?php
include 'conn.php';
session_start();
$activeuser = $_SESSION["username"];
$accessLevel = $_SESSION["accessLevel"];
$name = $_SESSION['name'];
$course = $_SESSION['course'];

if($activeuser=="" || $accessLevel != 2){
    header("location: index.php");
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>

    <title>FYP Full Tracking System</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="std_mainPage.php">
                <img src="assets/logo_left-1024x385.png" width="150" height="56" alt="">
            </a>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="navbar-brand dropdown-toggle fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Profile, <?php echo $name; ?></a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="std_profile.php">Profile Settings</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
          </div>
        </div>
      </nav>
    <!-- Content -->
    <div class="container-fluid">
        <h2 class="py-3 px-5 text-left">FYP Progress</h2>
        <button class="btn btn-primary px-5 ms-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFYP1" aria-expanded="false" aria-controls="collapseExample">FYP Progress 1</button>
        <button class="btn btn-primary px-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFYP2" aria-expanded="false" aria-controls="collapseExample">FYP Progress 2</button>
        <div id="fypAccordion">
            <div class="collapse card card-body" id="collapseFYP1" data-bs-parent="#fypAccordion">
                <?php
                $select = mysqli_query($conn, "SELECT * FROM projectdetails WHERE matricNo = '$activeuser'");
                $row = mysqli_fetch_array($select);
                $count = mysqli_num_rows($select);

                if($count == 1){
                    $title = $row['projectTitle'];
                    $synopsis = $row['projectSynopsis'];
                    $attachmentPath2 = $row['projectProgress2'];
                    $attachmentPath3 = $row['projectProgress3'];
                    $attachmentPath4 = $row['projectProgress4'];
                    $attachmentPath5 = $row['projectProgress5'];
                    $attachmentPath6 = $row['projectProgress6'];
                    $attachmentPath7 = $row['projectProgress7'];
                    $attachmentPath8 = $row['projectProgress8'];
                    $comment2 = $row['supervisorReview2'];
                    $comment3 = $row['supervisorReview3'];
                    $comment4 = $row['supervisorReview4'];
                    $comment6 = $row['supervisorReview6'];
                    $comment7 = $row['supervisorReview7'];

                }else{
                    $title = "";
                    $synopsis = "";
                    $attachmentPath2 = "";
                    $attachmentPath3 = "";
                    $attachmentPath4 = "";
                    $attachmentPath5 = "";
                    $attachmentPath6 = "";
                    $attachmentPath7 = "";
                    $attachmentPath8 = "";
                    $comment2 = "";
                    $comment3 = "";
                    $comment4 = "";
                    $comment6 = "";
                    $comment7 = "";
                }
                ?>
                <form class="px-5 mx-5" action="func_updateProgress.php" method="POST">
                    <h4>Project Title & Sysnopsis Submission</h4>
                    <div class="mb-3">
                        <label class="form-label">Project Title :</label>
                        <input type="text" class="form-control" name="projectTitle" value ="<?php echo $title; ?>" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Project Synopsis</span>
                        <textarea class="form-control" aria-label="With textarea" name="synopsis" required><?php echo $synopsis; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="progress1">Submit</button>
                    </div>
                </form>
                <form class="px-5 mx-5" action="func_updateProgress.php" method="POST" enctype="multipart/form-data">
                    <h4>Chapter 1: Introduction & Chapter 2: Literature Review</h4>
                    <?php
                    $status2 = "";
                    if($attachmentPath2 != "")
                    $status2 = "disabled";
                    ?>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="fileToUpload" accept="application/pdf" <?php echo $status2;?>>
                        <button type="submit" class="btn btn-primary" name="progress2" <?php echo $status2;?>>Upload</button>
                    </div>
                    <div class="input-group mb-3">
                    <?php
                    if($attachmentPath2 != ""){
                        echo"<a class='btn btn-dark' href='view_attachment.php?file=$attachmentPath2' target='_blank'><span class='material-symbols-outlined'>picture_as_pdf</span> $activeuser-Progress2.pdf</a>";
                        echo"<a class='btn btn-danger' href='func_deleteFile.php?attachment=$attachmentPath2&prog=2'><span class='material-symbols-outlined'>delete</span></a>";
                    }
                    ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-info">Supervisor Comment</span>
                        <textarea class="form-control" aria-label="With textarea" name="" readonly><?php echo $comment2;?></textarea>
                    </div>
                </form>
                <form class="px-5 mx-5" action="func_updateProgress.php" method="POST" enctype="multipart/form-data">
                    <h4>Chapter 3: Methodology</h4>
                    <?php
                    $status3 = "";
                    if($attachmentPath3 != "")
                    $status3 = "disabled";
                    ?>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="fileToUpload" accept="application/pdf" <?php echo $status3;?>>
                        <button type="submit" class="btn btn-primary" name="progress3" <?php echo $status3;?>>Upload</button>
                    </div>
                    <div class="input-group mb-3">
                    <?php
                    if($attachmentPath3 != ""){
                        echo"<a class='btn btn-dark' href='view_attachment.php?file=$attachmentPath3' target='_blank'><span class='material-symbols-outlined'>picture_as_pdf</span> $activeuser-Progress3.pdf</a>";
                        echo"<a class='btn btn-danger' href='func_deleteFile.php?attachment=$attachmentPath3&prog=3'><span class='material-symbols-outlined'>delete</span></a>";
                    }
                    ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-info">Supervisor Comment</span>
                        <textarea class="form-control" aria-label="With textarea" name="" readonly><?php echo $comment3;?></textarea>
                    </div>
                </form>
                <form class="px-5 mx-5" action="func_updateProgress.php" method="POST" enctype="multipart/form-data">
                    <h4>Report Draft Submission</h4>
                    <?php
                    $status4 = "";
                    if($attachmentPath4 != "")
                    $status4 = "disabled";
                    ?>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="fileToUpload" accept="application/pdf" <?php echo $status4;?>>
                        <button type="submit" class="btn btn-primary" name="progress4" <?php echo $status4;?>>Upload</button>
                    </div>
                    <div class="input-group mb-3">
                    <?php
                    if($attachmentPath4 != ""){
                        echo"<a class='btn btn-dark' href='view_attachment.php?file=$attachmentPath4' target='_blank'><span class='material-symbols-outlined'>picture_as_pdf</span> $activeuser-Report.pdf</a>";
                        echo"<a class='btn btn-danger' href='func_deleteFile.php?attachment=$attachmentPath4&prog=4'><span class='material-symbols-outlined'>delete</span></a>";
                    }
                    ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-info">Supervisor Comment</span>
                        <textarea class="form-control" aria-label="With textarea" name="" disabled><?php echo $comment4;?></textarea>
                    </div>
                </form>
                <form class="px-5 mx-5" action="func_updateProgress.php" method="POST" enctype="multipart/form-data">
                    <h4>Report Submission</h4>
                    <?php
                    $status5 = "";
                    if($attachmentPath5 != "")
                    $status5 = "disabled";
                    ?>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="fileToUpload" accept="application/pdf" <?php echo $status5;?>>
                        <button type="submit" class="btn btn-primary" name="progress5" <?php echo $status5;?>>Upload</button>
                    </div>
                    <div class="input-group mb-3">
                    <?php
                    if($attachmentPath5 != ""){
                        echo"<a class='btn btn-dark' href='view_attachment.php?file=$attachmentPath5' target='_blank'><span class='material-symbols-outlined'>picture_as_pdf</span> $activeuser-Report.pdf</a>";
                        echo"<a class='btn btn-danger' href='func_deleteFile.php?attachment=$attachmentPath5&prog=5'><span class='material-symbols-outlined'>delete</span></a>";
                    }
                    ?>
                    </div>
                </form>
            </div>
            <div class="collapse card card-body" id="collapseFYP2" data-bs-parent="#fypAccordion">
                <form class="px-5 mx-5" action="" method="POST">
                    <h4>Chapter 4: Developement Phase</h4>
                </form>
                <form class="px-5 mx-5" action="func_updateProgress.php" method="POST" enctype="multipart/form-data">
                    <h4>Poster Submission</h4>
                    <?php
                    $status6 = "";
                    if($attachmentPath6 != "")
                    $status6 = "disabled";
                    ?>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="fileToUpload" accept="application/pdf" <?php echo $status6;?>>
                        <button type="submit" class="btn btn-primary" name="progress6" <?php echo $status6;?>>Upload</button>
                    </div>
                    <div class="input-group mb-3">
                    <?php
                    if($attachmentPath6 != ""){
                        echo"<a class='btn btn-dark' href='view_attachment.php?file=$attachmentPath6' target='_blank'><span class='material-symbols-outlined'>picture_as_pdf</span> $activeuser-PosterSubmission.pdf</a>";
                        echo"<a class='btn btn-danger' href='func_deleteFile.php?attachment=$attachmentPath6&prog=6'><span class='material-symbols-outlined'>delete</span></a>";
                    }
                    ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-info">Supervisor Comment</span>
                        <textarea class="form-control" aria-label="With textarea" name="info" disabled><?php echo $comment6;?></textarea>
                    </div>
                </form>
                <form class="px-5 mx-5" action="func_updateProgress.php" method="POST" enctype="multipart/form-data">
                    <h4>Final Draft Report Submission</h4>
                    <?php
                    $status7 = "";
                    if($attachmentPath7 != "")
                    $status7 = "disabled";
                    ?>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="fileToUpload" accept="application/pdf" <?php echo $status7;?>>
                        <button type="submit" class="btn btn-primary" name="progress7" <?php echo $status7;?>>Upload</button>
                    </div>
                    <div class="input-group mb-3">
                    <?php
                    if($attachmentPath7 != ""){
                        echo"<a class='btn btn-dark' href='view_attachment.php?file=$attachmentPath7' target='_blank'><span class='material-symbols-outlined'>picture_as_pdf</span> $activeuser-FinalDraftReport.pdf</a>";
                        echo"<a class='btn btn-danger' href='func_deleteFile.php?attachment=$attachmentPath7&prog=7'><span class='material-symbols-outlined'>delete</span></a>";
                    }
                    ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-info">Supervisor Comment</span>
                        <textarea class="form-control" aria-label="With textarea" name="info" disabled><?php echo $comment7;?></textarea>
                    </div>
                </form>
                <form class="px-5 mx-5" action="func_updateProgress.php" method="POST" enctype="multipart/form-data">
                    <h4>Final Report Submission</h4>
                    <?php
                    $status8 = "";
                    if($attachmentPath8 != "")
                    $status8 = "disabled";
                    ?>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="fileToUpload" accept="application/pdf" <?php echo $status8;?>>
                        <button type="submit" class="btn btn-primary" name="progress8" <?php echo $status8;?>>Upload</button>
                    </div>
                    <div class="input-group mb-3">
                    <?php
                    if($attachmentPath8 != ""){
                        echo"<a class='btn btn-dark' href='view_attachment.php?file=$attachmentPath8' target='_blank'><span class='material-symbols-outlined'>picture_as_pdf</span> $activeuser-FinalReport.pdf</a>";
                        echo"<a class='btn btn-danger' href='func_deleteFile.php?attachment=$attachmentPath8&prog=8'><span class='material-symbols-outlined'>delete</span></a>";
                    }
                    ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>