<?php
include 'conn.php';
session_start();
$activeuser = $_SESSION["username"];
$accessLevel = $_SESSION["accessLevel"];
$name = $_SESSION['name'];


if($activeuser=="" || $accessLevel != 0){
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

    <title>FYP Full Tracking System</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="cdr_mainPage.php">
                <img src="assets/logo_left-1024x385.png" width="150" height="56" alt="">
            </a>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item dropdown">
                <a class="navbar-brand dropdown-toggle fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Profile, <?php echo $name; ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <!-- Content -->
    <div class="container-fluid">
    <h2 class="mt-3 py-3 px-5 text-left">Student Progress</h2>
    <div class="container">
    <table class="table table-dark">
        <thead>
            <tr>
                <th>Student Matric</th>
                <th>Student Name</th>
                <th>Project title</th>
                <th>Progress</th>
                <th>Supervised</th>
                <th>Proposal Grade</th>
                <th>Report Grade</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $svID = $_GET['svID'];
        $select = mysqli_query($conn,"SELECT * FROM students JOIN projectdetails ON students.matricNo = projectdetails.matricNo WHERE assignedSv='$svID'");

        while($row = mysqli_fetch_array($select)){
            $matricNo = $row['matricNo'];
            $studentName = $row['studentName'];
            $projectTitle = $row['projectTitle'];
            $projectScope = $row['projectScope'];
            $projectSubmission = $row['projectSubmission'];
            $progress = 0;
            $supervised = 0;
            
            $p1 = $row['projectSynopsis'];
            $p2 = $row['projectProgress2'];
            $p3 = $row['projectProgress3'];
            $p4 = $row['projectProgress4'];
            $p5 = $row['projectProgress5'];
            $p6 = $row['projectProgress6'];
            $p7 = $row['projectProgress7'];
            $p8 = $row['projectProgress8'];
            $s2 = $row['supervisorReview2'];
            $s3 = $row['supervisorReview3'];
            $s4 = $row['supervisorReview4'];
            $s5 = $row['proposalReportTotal'];
            $s6 = $row['supervisorReview6'];
            $s7 = $row['supervisorReview7'];
            $s8 = $row['reportTotal'];
            
            if($p1 != NULL)
            $progress += 1;

            if($p2 != NULL)
            $progress += 1;

            if($p3 != NULL)
            $progress += 1;
            
            if($p4 != NULL)
            $progress += 1;

            if($p5 != NULL)
            $progress += 1;
            
            if($p6 != NULL)
            $progress += 1;

            if($p7 != NULL)
            $progress += 1;

            if($p8 != NULL)
            $progress += 1;

            if($s2 != NULL)
            $supervised += 1;

            if($s3 != NULL)
            $supervised += 1;
            
            if($s4 != NULL)
            $supervised += 1;

            if($s5 != NULL)
            $supervised += 1;
            
            if($s6 != NULL)
            $supervised += 1;

            if($s7 != NULL)
            $supervised += 1;

            if($s8 != NULL)
            $supervised += 1;

            $percentS = $supervised/7 * 100;

            $percent = $progress/8 * 100;

            if($s5 == NULL)
            $s5 = "-";

            if($s8 == NULL)
            $s8 = "-";

            echo"
            <tr>
                <td>$matricNo</td>
                <td>$studentName</td>
                <td>$projectTitle</td>
                <td><div class='progress'>
                <div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='$progress' aria-valuemin='0' aria-valuemax='8' style='width: $percent%'></div>
                </div>
                $progress/8</td>
                <td><div class='progress'>
                <div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='$supervised' aria-valuemin='0' aria-valuemax='7' style='width: $percentS%'></div>
                </div>
                $supervised/7</td>
                <td>$s5/30</td>
                <td>$s8/40</td>
            </tr>
            ";

        }
        ?>
        </tbody>
    </table>
</div>
</div>
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>