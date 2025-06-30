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
    <h2 class="py-3 px-5 text-left">Assigned List</h2>
    <div class="container">
      <table class="table table-dark">
        <thead>
          <tr>
            <th>No</th>
            <th>Supervisor Name</th>
            <th>Supervisor Details</th>
            <th>Student Name</th>
            <th>Project Title</th>
            <th>Project Scope</th>
            <th>Project Submission</th>
            <th>Course</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $query ="SELECT * FROM supervisor WHERE assignedCount != 0";
          
          $result= mysqli_query($conn,$query);
          $no = 0;
          while($row = mysqli_fetch_assoc($result)){
            $no += 1;
            $username = $row['username'];
            $svName = $row['svName'];
            $field = $row['field'];
            $scope = $row['expertise'];
            $submission = $row['projectPreference'];

            $resultStd = mysqli_query($conn, "SELECT * FROM students JOIN projectdetails ON students.matricNo = projectdetails.matricNo WHERE assignedSv = '$username'");
            $studentNames = array(); // Array to store student names
            $projectTitle = array();
            $projectScope = array();
            $projectSubmission = array();
            $course = array();

            while($rowStd = mysqli_fetch_assoc($resultStd)){
              $studentNames[] = $rowStd['studentName']; // Add each student name to the array
              $projectTitle[] = $rowStd['projectTitle']; 
              $projectScope[] = $rowStd['projectScope'];
              $projectSubmission[] = $rowStd['projectSubmission'];
              $course[] = $rowStd['course'];
            }
            // Calculate the number of rows needed for the student names
            $rowspan = count($studentNames);
            echo "
            <tr onclick=\"window.location='cdr_studentProgress.php?svID=".$username."'\">
            <td rowspan='$rowspan'>$no</td>
            <td rowspan='$rowspan'>$svName</td>
            <td rowspan='$rowspan'>$field , $scope, $submission</td>";
            
            // Display the first student name
            if (!empty($studentNames)) {
              echo "<td>{$studentNames[0]}</td>";
              echo "<td>{$projectTitle[0]}</td>";
              echo "<td>{$projectScope[0]}</td>";
              echo "<td>{$projectSubmission[0]}</td>";
              echo "<td>{$course[0]}</td>";
            } else {
              echo "<td>No students assigned</td>";
            }
            
            // Close the first row
            echo "</tr>";
            //Display the remaining student names, if any
            for ($i = 1; $i < count($studentNames); $i++) {
              echo "<tr><td>{$studentNames[$i]}</td>
                        <td>{$projectTitle[$i]}</td>
                        <td>{$projectScope[$i]}</td>
                        <td>{$projectSubmission[$i]}</td>
                        <td>{$course[$i]}</td>
              </tr>";
            }

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