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
    <?php
    $select = mysqli_query($conn, "SELECT * FROM projectdetails WHERE matricNo = '$activeuser'");

    $count = mysqli_num_rows($select);

    $projectTitle = "";
    $projectScope = "";
    $projectSubmission = "";
    $pref = "-";
    $expertise = "-";

    if($count == 1){
      $rowPd = mysqli_fetch_array($select, MYSQLI_ASSOC);
      $projectTitle = $rowPd['projectTitle'];
      $projectScope = $rowPd['projectScope'];
      $projectSubmission = $rowPd['projectSubmission'];

    }
    
    ?>
    <div class="container-fluid">
        <h2 class="py-3 px-5 text-left">Update Project Details</h2>
        <form class="px-5 mx-5" action="func_updateStdPreference.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Project Title</label>
                <input type="text" class="form-control" name="projectTitle" value="<?php echo $projectTitle;?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Project Scope</label>
                <select class="form-select" aria-label="Default select example" name="projectScope">
                    <?php
                    $query = mysqli_query($conn, "SELECT * FROM scope WHERE $course=TRUE");
                    
                    while($row = mysqli_fetch_assoc($query)){
                      $scopeID = $row['scopeID'];
                      $scopeName = $row['scope'];
                      echo "
                        <option>$scopeName</option>
                        ";
                    }   
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Project Submission</label>
                <select class="form-select" aria-label="Default select example" name="projectSubmission">
                    <option value="Research Based">Research Based</option>
                    <option value="Development Based">Development Based</option>
                </select>
            </div>
            <div class="mb-3">
                <table class="table table-striped">
                  <tr>
                    <th colspan="2" class="text-center">Currrently Selected</th>
                  </tr>
                  <tr>
                  <th>Project Scope :</th>
                  <td><?php echo $projectScope?></td>
                  </tr>
                  <tr>
                  <th>Project Submission :</th>
                  <td><?php echo $projectSubmission?></td>
                  </tr>
                </table>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary" name="Preference">Submit</button>
                <button type="submit" class="btn btn-primary" name="Assign">Assign Supervisor</button>
            </div>
          </form>


          <?php
          
          $select= mysqli_query($conn, "SELECT * FROM students WHERE matricNo='$activeuser'");
          $row = mysqli_fetch_array($select, MYSQLI_ASSOC);

          $svID = $row['assignedSV'];
          $svName = "-";
          $svExpertise = "-";
          $status = "Not Assigned";


          if($svID != "NA"){

            $svDetails = mysqli_query($conn, "SELECT * FROM supervisor WHERE username = '$svID'");

            if($svDetails==true){
  
              $rowSV = mysqli_fetch_array($svDetails, MYSQLI_ASSOC);
              $svName = $rowSV['svName'];
              $svExpertise = $rowSV['expertise'];
              $status = "Assigned";
  
            }

          }
          ?>
          <h2 class="py-3 px-5 text-left">Supervisor Assignement Status</h2>
          <div class="cointainer px-5 mx-5">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Supervisor Assigned</th>
                  <th>Expertise</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $svName; ?></td>
                  <td><?php echo $svExpertise; ?></td>
                  <td><?php echo $status; ?></td>
                </tr>
              </tbody>
            </table>
          </div>     
    </div>
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>