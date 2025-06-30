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
      <h2 class="py-3 px-5 text-left">Unassigned Student</h2>
      <div class="container">
      <table class="table table-dark">
        <thead>
          <tr>
            <th>Matric No</th>
            <th>Student Name</th>
            <th>Course</th>
            <th>Project Details Update Status</th>
          </tr>
        </thead>
        <tbody>
            <?php
            $unassigned = mysqli_query($conn, "SELECT * FROM students WHERE assignedSv ='NA'");
            $unCount = mysqli_num_rows($unassigned);

            echo"$unCount students have not been assigned";

            while($rowUnassignedStd = mysqli_fetch_array($unassigned)){

                $uMatricNo = $rowUnassignedStd['matricNo'];
                $uName = $rowUnassignedStd['studentName'];
                $uCourse = $rowUnassignedStd['course'];

                $sProjectDetails = mysqli_query($conn, "SELECT * FROM projectdetails WHERE matricNo='$uMatricNo'");
                $countProject = mysqli_num_rows($sProjectDetails);

                if($countProject == 0)
                $projectStatus = "Have not updated";
                else
                $projectStatus = "Updated";
                echo"<tr>
                <td>$uMatricNo</td>
                <td>$uName</td>
                <td>$uCourse</td>
                <td>$projectStatus</td>
                </tr>";

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