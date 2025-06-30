<?php
include 'conn.php';
session_start();
$activeuser = $_SESSION["username"];
$accessLevel = $_SESSION["accessLevel"];
$name = $_SESSION['name'];
$field  = $_SESSION['course'];

if($activeuser=="" || $accessLevel != 1){
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
            <a class="navbar-brand" href="sv_mainPage.php"><img src="assets/logo_left-1024x385.png" width="150" height="56" alt=""></a>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                  <a class="navbar-brand dropdown-toggle fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Profile, <?php echo $name; ?></a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="sv_profile.php">Profile Settings</a></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                  </ul>
                </li>
              </ul>
           </div>
        </div>
    </nav>
    <!-- Content -->
    <div class="container-fluid pt-3 ps-3">
        <a class="btn btn-primary" href="sv_assignStudent.php">Go Back</a>
        <?php 
        $matricNo = $_GET['userid'];
        ?>
        <h2 class="py-3 px-5 text-left">FYP Progress</h2>
        <button class="btn btn-primary px-5 ms-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFYP1" aria-expanded="false" aria-controls="collapseExample">FYP Progress 1</button>
        <button class="btn btn-primary px-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFYP2" aria-expanded="false" aria-controls="collapseExample">FYP Progress 2</button>
        <div id="fypAccordion">
            <div class="collapse card card-body" id="collapseFYP1" data-bs-parent="#fypAccordion">
                <?php
                $select = mysqli_query($conn, "SELECT * FROM projectdetails WHERE matricNo = '$matricNo'");
                $row = mysqli_fetch_array($select);
                $count = mysqli_num_rows($select);

                if($count != 0){
                    $title = $row['projectTitle'];
                    $synopsis = $row['projectSynopsis'];
                    $comment2 = $row['supervisorReview2'];
                    $comment3 = $row['supervisorReview3'];
                    $comment4 = $row['supervisorReview4'];
                    //$comment5 = $row['supervisorReview5'];
                    $gradeProposal1 = $row['proposalReportGrade1'];
                    $gradeProposal2 = $row['proposalReportGrade2'];
                    $gradeProposal3 = $row['proposalReportGrade3'];
                    $gradeProposal4 = $row['proposalReportGrade4'];
                    $gradeProposal5 = $row['proposalReportGrade5'];
                    $gradeProposal6 = $row['proposalReportGrade6'];
                    $gradeTotalProposal = $row['proposalReportTotal'];
                    $comment6 = $row['supervisorReview6'];
                    $comment7 = $row['supervisorReview7'];
                    //$comment8 = $row['supervisorReview8'];
                    $gradeReport1 = $row['reportGrade1'];
                    $gradeReport2 = $row['reportGrade2'];
                    $gradeReport3 = $row['reportGrade3'];
                    $gradeReport4 = $row['reportGrade4'];
                    $gradeReport5 = $row['reportGrade5'];
                    $gradeReport6 = $row['reportGrade6'];
                    $gradeReport7 = $row['reportGrade7'];
                    $gradeReport8 = $row['reportGrade8'];
                    $totalReport = $row['reportTotal'];

                    if($totalReport == "")
                    $totalReport = "(Not Graded) ";
                    
                    if($gradeTotalProposal == "")
                    $gradeTotalProposal = "(Not Graded) ";

                }else{
                    $title = "";
                    $synopsis = "";
                    $comment2 = "";
                    $comment3 = "";
                    $comment4 = "";
                    //$comment5 = "";
                    $gradeProposal1 = "";
                    $gradeProposal2 = "";
                    $gradeProposal3 = "";
                    $gradeProposal4 = "";
                    $gradeProposal5 = "";
                    $gradeProposal6 = "";
                    $gradeTotalProposal = "(Not Graded)";
                    $comment6 = "";
                    $comment7 = "";
                    $gradeReport1 = "";
                    $gradeReport2 = "";
                    $gradeReport3 = "";
                    $gradeReport4 = "";
                    $gradeReport5 = "";
                    $gradeReport6 = "";
                    $gradeReport7 = "";
                    $gradeReport8 = "";
                    $totalReport = "(Not Graded)";

                }
                ?>
                <form class="px-5 mx-5" action="func_updateProgress.php" method="POST">
                    <h4>Project Title & Sysnopsis Submission</h4>
                    <div class="mb-3">
                        <label class="form-label">Project Title :</label>
                        <input type="text" class="form-control" name="projectTitle" value ="<?php echo $title; ?>" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Project Synopsis</span>
                        <textarea class="form-control" aria-label="With textarea" name="synopsis" disabled><?php echo $synopsis; ?></textarea>
                    </div>
                </form>
                <form class="px-5 mx-5" action="func_updateProgress.php?studentid=<?php echo $matricNo; ?>" method="POST" enctype="multipart/form-data">
                    <h4>Chapter 1: Introduction & Chapter 2: Literature Review</h4>
                    <?php
                    $attachmentPath2 = $row['projectProgress2'];
                    $status2 = "";
                    if($attachmentPath2 == "")
                    $status2 = "disabled";
                    ?>
                    <div class="input-group mb-3">
                    <?php
                    if($attachmentPath2 != ""){
                        echo"<a class='btn btn-dark' href='view_attachment.php?file=$attachmentPath2' target='_blank'><span class='material-symbols-outlined'>picture_as_pdf</span> $matricNo-ViewProgress2.pdf</a>";
                        echo"<a class='btn btn-info' href='$attachmentPath2' target='_parent'><span class='material-symbols-outlined'>picture_as_pdf</span> $matricNo-DownloadProgress2.pdf</a>";
                    }
                    ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-info">Supervisor Comment</span>
                        <textarea class="form-control" aria-label="With textarea" name="comment" <?php echo $status2;?>><?php echo $comment2; ?></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <button type="submit" class="btn btn-primary" name="comment2" <?php echo $status2;?>>Comment</button>
                    </div>
                </form>
                <form class="px-5 mx-5" action="func_updateProgress.php?studentid=<?php echo $matricNo; ?>" method="POST" enctype="multipart/form-data">
                    <h4>Chapter 3: Methodology</h4>
                    <?php
                    $attachmentPath3 = $row['projectProgress3'];
                    $status3 = "";
                    if($attachmentPath3 == "")
                    $status3 = "disabled";
                    ?>
                    <div class="input-group mb-3">
                    <?php
                    if($attachmentPath3 != ""){
                        echo"<a class='btn btn-dark' href='view_attachment.php?file=$attachmentPath3' target='_blank'><span class='material-symbols-outlined'>picture_as_pdf</span> $matricNo-ViewProgress3.pdf</a>";
                        echo"<a class='btn btn-info' href='$attachmentPath3' target='_parent'><span class='material-symbols-outlined'>picture_as_pdf</span> $matricNo-DownloadProgress3.pdf</a>";
                    }
                    ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-info">Supervisor Comment</span>
                        <textarea class="form-control" aria-label="With textarea" name="comment" <?php echo $status3;?>><?php echo $comment3; ?></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <button type="submit" class="btn btn-primary" name="comment3" <?php echo $status3;?>>Comment</button>
                    </div>
                </form>
                <form class="px-5 mx-5" action="func_updateProgress.php?studentid=<?php echo $matricNo; ?>" method="POST" enctype="multipart/form-data">
                    <h4>Report Draft Submission</h4>
                    <?php
                    $attachmentPath4 = $row['projectProgress4'];
                    $status4 = "";
                    if($attachmentPath4 == "")
                    $status4 = "disabled";
                    ?>
                    <div class="input-group mb-3">
                    <?php
                    if($attachmentPath4 != ""){
                        echo"<a class='btn btn-dark' href='view_attachment.php?file=$attachmentPath4' target='_blank'><span class='material-symbols-outlined'>picture_as_pdf</span> $matricNo-ViewDraftReport.pdf</a>";
                        echo"<a class='btn btn-info' href='$attachmentPath4' target='_parent'><span class='material-symbols-outlined'>picture_as_pdf</span> $matricNo-DownloadDraftReport.pdf</a>";
                    }
                    ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-info">Supervisor Comment</span>
                        <textarea class="form-control" aria-label="With textarea" name="comment" <?php echo $status4;?>><?php echo $comment4; ?></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <button type="submit" class="btn btn-primary" name="comment4" <?php echo $status4;?>>Comment</button>
                    </div>
                </form>
                <form class="px-5 mx-5" action="func_updateProgress.php?studentid=<?php echo $matricNo; ?>" method="POST" enctype="multipart/form-data">
                    <h4>Report Submission</h4>
                    <?php
                    $attachmentPath5 = $row['projectProgress5'];
                    $status5 = "";
                    if($attachmentPath5 == "")
                    $status5 = "disabled";
                    ?>
                    <div class="input-group mb-3">
                    <?php
                    if($attachmentPath5 != ""){
                        echo"<a class='btn btn-dark' href='view_attachment.php?file=$attachmentPath5' target='_blank'><span class='material-symbols-outlined'>picture_as_pdf</span> $matricNo-ViewReport.pdf</a>";
                        echo"<a class='btn btn-info' href='$attachmentPath5' target='_parent'><span class='material-symbols-outlined'>picture_as_pdf</span> $matricNo-DownloadReport.pdf</a>";
                    }
                    ?>
                    </div>
                    <table class="table table-dark">
                        <tbody>
                            <tr>
                                <th rowspan="9" style="vertical-align : middle; text-align:center; width: 30%;">Project Prosposal Report</th>
                                <th style="width: 50%;">Content</th>
                                <th style="width: 20%;">Grade</th>
                            </tr> 
                            <tr>
                                <td>Introduction(Background, Problem statement, Objectives, Scope and Limitation of work)</td>
                                <td><div class="row">
                                    <div class="col-6"><select class="form-select form-control form-control-sm" name="grade1" id="gradeProposal1" onchange="calculateTotalProposal()">
                                        <option value="1" <?php if($gradeProposal1 == 1) echo"Selected";?>>1</option>
                                        <option value="2" <?php if($gradeProposal1 == 2) echo"Selected";?>>2</option>
                                        <option value="3" <?php if($gradeProposal1 == 3) echo"Selected";?>>3</option>
                                    </select></div>
                                    <div class="col-6">/3</div>
                                </div></td>
                            </tr>
                            <tr>
                                <td>Literature</td>
                                <td><div class="row">
                                    <div class="col-6"><select class="form-select form-control form-control-sm" name="grade2" id="gradeProposal2" onchange="calculateTotalProposal()">
                                        <option value="1" <?php if($gradeProposal2 == 1) echo"Selected";?>>1</option>
                                        <option value="2" <?php if($gradeProposal2 == 2) echo"Selected";?>>2</option>
                                        <option value="3" <?php if($gradeProposal2 == 3) echo"Selected";?>>3</option>
                                    </select></div>
                                    <div class="col-6">/3</div>
                                </div></td>
                            </tr>
                            <tr>
                                <td>Methodology</td>
                                <td><div class="row">
                                    <div class="col-6"><select class="form-select form-control form-control-sm" name="grade3" id="gradeProposal3" onchange="calculateTotalProposal()">
                                        <option value="1" <?php if($gradeProposal3 == 1) echo"Selected";?>>1</option>
                                        <option value="2" <?php if($gradeProposal3 == 2) echo"Selected";?>>2</option>
                                        <option value="3" <?php if($gradeProposal3 == 3) echo"Selected";?>>3</option>
                                    </select></div>
                                    <div class="col-6">/3</div>
                                </div></td>
                            </tr>
                            <tr>
                                <td>References</td>
                                <td><div class="row">
                                    <div class="col-6"><select class="form-select form-control form-control-sm" name="grade4" id="gradeProposal4" onchange="calculateTotalProposal()">
                                        <option value="1" <?php if($gradeProposal4 == 1) echo"Selected";?>>1</option>
                                        <option value="2" <?php if($gradeProposal4 == 2) echo"Selected";?>>2</option>
                                        <option value="3" <?php if($gradeProposal4 == 3) echo"Selected";?>>3</option>
                                    </select></div>
                                    <div class="col-6">/3</div>
                                </div></td>
                            </tr>
                            <tr>
                                <td>Format(Writing, Citation, References, Tables and Figures)</td>
                                <td><div class="row">
                                    <div class="col-6"><select class="form-select form-control form-control-sm" name="grade5" id="gradeProposal5" onchange="calculateTotalProposal()">
                                        <option value="1" <?php if($gradeProposal5 == 1) echo"Selected";?>>1</option>
                                        <option value="2" <?php if($gradeProposal5 == 2) echo"Selected";?>>2</option>
                                        <option value="3" <?php if($gradeProposal5 == 3) echo"Selected";?>>3</option>
                                        <option value="4" <?php if($gradeProposal5 == 4) echo"Selected";?>>4</option>
                                        <option value="5" <?php if($gradeProposal5 == 5) echo"Selected";?>>5</option>
                                        <option value="6" <?php if($gradeProposal5 == 6) echo"Selected";?>>6</option>
                                        <option value="7" <?php if($gradeProposal5 == 7) echo"Selected";?>>7</option>
                                        <option value="8" <?php if($gradeProposal5 == 8) echo"Selected";?>>8</option>
                                        <option value="9" <?php if($gradeProposal5 == 9) echo"Selected";?>>9</option>
                                        <option value="10" <?php if($gradeProposal5 == 10) echo"Selected";?>>10</option>
                                        <option value="11" <?php if($gradeProposal5 == 11) echo"Selected";?>>11</option>
                                        <option value="12" <?php if($gradeProposal5 == 12) echo"Selected";?>>12</option>
                                    </select></div>
                                    <div class="col-6">/12</div>
                                </div></td>
                            </tr>
                            <tr>
                                <td>Orginality</td>
                                <td><div class="row">
                                    <div class="col-6"><select class="form-select form-control form-control-sm" name="grade6" id="gradeProposal6" onchange="calculateTotalProposal()">
                                        <option value="1" <?php if($gradeProposal6 == 1) echo"Selected";?>>1</option>
                                        <option value="2" <?php if($gradeProposal6 == 2) echo"Selected";?>>2</option>
                                        <option value="3" <?php if($gradeProposal6 == 3) echo"Selected";?>>3</option>
                                        <option value="4" <?php if($gradeProposal6 == 4) echo"Selected";?>>4</option>
                                        <option value="5" <?php if($gradeProposal6 == 5) echo"Selected";?>>5</option>
                                        <option value="6" <?php if($gradeProposal6 == 6) echo"Selected";?>>6</option>
                                    </select></div>
                                    <div class="col-6">/6</div>
                                </div></td>
                            </tr>
                            <tr>
                                <th style="text-align: right;">Total(Currently Selected) : </th>
                                <td id="totalProposal"> /30</td>
                            </tr>
                            <tr>
                                <th style="text-align: right;">Total(Database) : </th>
                                <td><?php echo $gradeTotalProposal;?>/30</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="input-group">
                        <button type="submit" class="btn btn-primary" name="comment5" <?php echo $status5;?>>Grade</button>
                    </div>
                </form>
            </div>
            <div class="collapse card card-body" id="collapseFYP2" data-bs-parent="#fypAccordion">
                <form class="px-5 mx-5" action="" method="POST">
                    <h4>Chapter 4: Developement Phase</h4>
                </form>
                <form class="px-5 mx-5" action="func_updateProgress.php?studentid=<?php echo $matricNo; ?>" method="POST" enctype="multipart/form-data">
                    <h4>Poster Submission</h4>
                    <?php
                    $attachmentPath6 = $row['projectProgress6'];
                    $status6 = "";
                    if($attachmentPath6 == "")
                    $status6 = "disabled";
                    ?>
                    <div class="input-group mb-3">
                    <?php
                    if($attachmentPath6 != ""){
                        echo"<a class='btn btn-dark' href='view_attachment.php?file=$attachmentPath6' target='_blank'><span class='material-symbols-outlined'>picture_as_pdf</span> $matricNo-ViewPoster.pdf</a>";
                        echo"<a class='btn btn-info' href='$attachmentPath6' target='_parent'><span class='material-symbols-outlined'>picture_as_pdf</span> $matricNo-DownloadPoster.pdf</a>";
                    }
                    ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-info">Supervisor Comment</span>
                        <textarea class="form-control" aria-label="With textarea" name="comment" <?php echo $status6;?>><?php echo $comment6; ?></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <button type="submit" class="btn btn-primary" name="comment6" <?php echo $status6;?>>Comment</button>
                    </div>
                </form>
                <form class="px-5 mx-5" action="func_updateProgress.php?studentid=<?php echo $matricNo; ?>" method="POST" enctype="multipart/form-data">
                    <h4>Final Draft Report Submission</h4>
                    <?php
                    $attachmentPath7 = $row['projectProgress7'];
                    $status7 = "";
                    if($attachmentPath7 == "")
                    $status7 = "disabled";
                    ?>
                    <div class="input-group mb-3">
                    <?php
                    if($attachmentPath7 != ""){
                        echo"<a class='btn btn-dark' href='view_attachment.php?file=$attachmentPath7' target='_blank'><span class='material-symbols-outlined'>picture_as_pdf</span> $matricNo-ViewFinalDraftReport.pdf</a>";
                        echo"<a class='btn btn-info' href='$attachmentPath7' target='_parent'><span class='material-symbols-outlined'>picture_as_pdf</span> $matricNo-DownloadFinalDraftReport.pdf</a>";
                    }
                    ?>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-info">Supervisor Comment</span>
                        <textarea class="form-control" aria-label="With textarea" name="comment" <?php echo $status7;?>><?php echo $comment7; ?></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <button type="submit" class="btn btn-primary" name="comment7" <?php echo $status7;?>>Comment</button>
                    </div>
                </form>
                <form class="px-5 mx-5" action="func_updateProgress.php?studentid=<?php echo $matricNo; ?>" method="POST" enctype="multipart/form-data">
                    <h4>Final Report Submission</h4>
                    <?php
                    $attachmentPath8 = $row['projectProgress8'];
                    $status8 = "";
                    if($attachmentPath8 == "")
                    $status8 = "disabled";
                    ?>
                    <div class="input-group mb-3">
                    <?php
                    if($attachmentPath8 != ""){
                        echo"<a class='btn btn-dark' href='view_attachment.php?file=$attachmentPath8' target='_blank'><span class='material-symbols-outlined'>picture_as_pdf</span> $matricNo-ViewFinalReport.pdf</a>";
                        echo"<a class='btn btn-info' href='$attachmentPath8' target='_parent'><span class='material-symbols-outlined'>picture_as_pdf</span> $matricNo-DownloadFinalReport.pdf</a>";
                    }
                    ?>
                    </div>
                    <table class="table table-dark">
                        <tbody>
                            <tr>
                            <th rowspan="11" style="vertical-align : middle; text-align:center; width: 30%;">Final Project Report</th>
                                <th style="width: 50%;">Content</th>
                                <th style="width: 20%;">Grade</th>
                            </tr>
                            <tr>
                                <td>Abstract</td>
                                <td><div class="row">
                                    <div class="col-6"><select class="form-select form-control form-control-sm" name="grade1" id="gradeReport1" onchange="calculateTotalReport()">
                                        <option value="1" <?php if($gradeReport1 == 1) echo"Selected";?>>1</option>
                                        <option value="2" <?php if($gradeReport1 == 2) echo"Selected";?>>2</option>
                                        <option value="3" <?php if($gradeReport1 == 3) echo"Selected";?>>3</option>
                                        <option value="4" <?php if($gradeReport1 == 4) echo"Selected";?>>4</option>
                                    </select></div>
                                    <div class="col-6">/4</div>
                                </div></td>
                            </tr> 
                            <tr>
                                <td>Introduction(Background, Problem statement, Objectives, Scope and Limitation of work)</td>
                                <td><div class="row">
                                    <div class="col-6"><select class="form-select form-control form-control-sm" name="grade2" id="gradeReport2" onchange="calculateTotalReport()">
                                        <option value="1" <?php if($gradeReport2 == 1) echo"Selected";?>>1</option>
                                        <option value="2" <?php if($gradeReport2 == 2) echo"Selected";?>>2</option>
                                        <option value="3" <?php if($gradeReport2 == 3) echo"Selected";?>>3</option>
                                        <option value="4" <?php if($gradeReport2 == 4) echo"Selected";?>>4</option>
                                    </select></div>
                                    <div class="col-6">/4</div>
                                </div></td>
                            </tr>
                            <tr>
                                <td>Literature</td>
                                <td><div class="row">
                                    <div class="col-6"><select class="form-select form-control form-control-sm" name="grade3" id="gradeReport3" onchange="calculateTotalReport()">
                                        <option value="1" <?php if($gradeReport3 == 1) echo"Selected";?>>1</option>
                                        <option value="2" <?php if($gradeReport3 == 2) echo"Selected";?>>2</option>
                                        <option value="3" <?php if($gradeReport3 == 3) echo"Selected";?>>3</option>
                                        <option value="4" <?php if($gradeReport3 == 4) echo"Selected";?>>4</option>
                                    </select></div>
                                    <div class="col-6">/4</div>
                                </div></td>
                            </tr>
                            <tr>
                                <td>Methodology</td>
                                <td><div class="row">
                                    <div class="col-6"><select class="form-select form-control form-control-sm" name="grade4" id="gradeReport4" onchange="calculateTotalReport()">
                                        <option value="1" <?php if($gradeReport4 == 1) echo"Selected";?>>1</option>
                                        <option value="2" <?php if($gradeReport4 == 2) echo"Selected";?>>2</option>
                                        <option value="3" <?php if($gradeReport4 == 3) echo"Selected";?>>3</option>
                                        <option value="4" <?php if($gradeReport4 == 4) echo"Selected";?>>4</option>
                                    </select></div>
                                    <div class="col-6">/4</div>
                                </div></td>
                            </tr>
                            <tr>
                                <td>Results and Discussion</td>
                                <td><div class="row">
                                    <div class="col-6"><select class="form-select form-control form-control-sm" name="grade5" id="gradeReport5" onchange="calculateTotalReport()">
                                        <option value="1" <?php if($gradeReport5 == 1) echo"Selected";?>>1</option>
                                        <option value="2" <?php if($gradeReport5 == 2) echo"Selected";?>>2</option>
                                        <option value="3" <?php if($gradeReport5 == 3) echo"Selected";?>>3</option>
                                        <option value="4" <?php if($gradeReport5 == 4) echo"Selected";?>>4</option>
                                        <option value="5" <?php if($gradeReport5 == 5) echo"Selected";?>>5</option>
                                        <option value="6" <?php if($gradeReport5 == 6) echo"Selected";?>>6</option>
                                        <option value="7" <?php if($gradeReport5 == 7) echo"Selected";?>>7</option>
                                        <option value="8" <?php if($gradeReport5 == 8) echo"Selected";?>>8</option>
                                    </select></div>
                                    <div class="col-6">/8</div>
                                </div></td>
                            </tr>
                            <tr>
                                <td>Conclusion</td>
                                <td><div class="row">
                                    <div class="col-6"><select class="form-select form-control form-control-sm" name="grade6" id="gradeReport6" onchange="calculateTotalReport()">
                                        <option value="1" <?php if($gradeReport6 == 1) echo"Selected";?>>1</option>
                                        <option value="2" <?php if($gradeReport6 == 2) echo"Selected";?>>2</option>
                                        <option value="3" <?php if($gradeReport6 == 3) echo"Selected";?>>3</option>
                                        <option value="4" <?php if($gradeReport6 == 4) echo"Selected";?>>4</option>
                                    </select></div>
                                    <div class="col-6">/4</div>
                                </div></td>
                            </tr>
                            <tr>
                                <td>Format(Writing, Citation, References, Tables and Figures)</td>
                                <td><div class="row">
                                    <div class="col-6"><select class="form-select form-control form-control-sm" name="grade7" id="gradeReport7" onchange="calculateTotalReport()">
                                        <option value="1" <?php if($gradeReport7 == 1) echo"Selected";?>>1</option>
                                        <option value="2" <?php if($gradeReport7 == 2) echo"Selected";?>>2</option>
                                        <option value="3" <?php if($gradeReport7 == 3) echo"Selected";?>>3</option>
                                        <option value="4" <?php if($gradeReport7 == 4) echo"Selected";?>>4</option>
                                    </select></div>
                                    <div class="col-6">/4</div>
                                </div></td>
                            </tr>
                            <tr>
                                <td>Orginality</td>
                                <td><div class="row">
                                    <div class="col-6"><select class="form-select form-control form-control-sm" name="grade8" id="gradeReport8" onchange="calculateTotalReport()">
                                        <option value="1" <?php if($gradeReport8 == 1) echo"Selected";?>>1</option>
                                        <option value="2" <?php if($gradeReport8 == 2) echo"Selected";?>>2</option>
                                        <option value="3" <?php if($gradeReport8 == 3) echo"Selected";?>>3</option>
                                        <option value="4" <?php if($gradeReport8 == 4) echo"Selected";?>>4</option>
                                        <option value="5" <?php if($gradeReport8 == 5) echo"Selected";?>>5</option>
                                        <option value="6" <?php if($gradeReport8 == 6) echo"Selected";?>>6</option>
                                        <option value="7" <?php if($gradeReport8 == 7) echo"Selected";?>>7</option>
                                        <option value="8" <?php if($gradeReport8 == 8) echo"Selected";?>>8</option>
                                    </select></div>
                                    <div class="col-6">/8</div>
                                </div></td>
                            </tr>
                            <tr>
                                <th style="text-align: right;">Total : </th>
                                <td id="totalReport"> /40</td>
                            </tr>
                            <tr>
                                <th style="text-align: right;">Total : </th>
                                <td><?php echo $totalReport;?>/40</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="input-group mb-3">
                        <button type="submit" class="btn btn-primary" name="comment8" <?php echo $status8;?>>Grade</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->
    <script>
    function calculateTotalReport() {
        const grades = [
            parseInt(document.getElementById('gradeReport1').value),
            parseInt(document.getElementById('gradeReport2').value),
            parseInt(document.getElementById('gradeReport3').value),
            parseInt(document.getElementById('gradeReport4').value),
            parseInt(document.getElementById('gradeReport5').value),
            parseInt(document.getElementById('gradeReport6').value),
            parseInt(document.getElementById('gradeReport7').value),
            parseInt(document.getElementById('gradeReport8').value)
        ];
        
        const total = grades.reduce((sum, grade) => sum + grade, 0);
        document.getElementById('totalReport').innerText = total + " /40";
    }

    function calculateTotalProposal() {
        const grades = [
            parseInt(document.getElementById('gradeProposal1').value),
            parseInt(document.getElementById('gradeProposal2').value),
            parseInt(document.getElementById('gradeProposal3').value),
            parseInt(document.getElementById('gradeProposal4').value),
            parseInt(document.getElementById('gradeProposal5').value),
            parseInt(document.getElementById('gradeProposal6').value)
        ];
        
        const total = grades.reduce((sum, grade) => sum + grade, 0);
        document.getElementById('totalProposal').innerText = total + " /30";
    }

    // Initialize the total when the page loads
    window.onload = calculateTotal;
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>