<?php
include 'conn.php';
session_start();
$activeuser = $_SESSION["username"];
$accessLevel = $_SESSION["accessLevel"];
$name = $_SESSION['name'];
$course = $_SESSION['course'];


$projectTitle = $_POST['projectTitle'];
$projectScope = $_POST['projectScope'];
$projectSubmission = $_POST['projectSubmission'];
$status = "InProgress";

if(isset($_POST['Preference'])){
    $select = mysqli_query($conn,"SELECT * FROM projectdetails WHERE matricNo = '$activeuser'");
    $pd = mysqli_fetch_array($select, MYSQLI_ASSOC);
    $count = mysqli_num_rows($select);

        if($count == 1){
            $update = mysqli_query($conn,"UPDATE projectdetails SET projectScope = '$projectScope', projectSubmission = '$projectSubmission', projectTitle = '$projectTitle' WHERE matricNo = '$activeuser'");
            
            if($update == true){
                echo '<script language="javascript">';
                echo 'alert("Preference Updated!"); location.href="std_svAssigning.php"';
                echo '</script>';
             }else{
                echo '<script language="javascript">';
                echo 'alert("Failed to update preference!"); location.href="std_svAssigning.php"';
                echo '</script>';
            }
        }else if($count == 0){
            $query = "INSERT INTO projectdetails (projectTitle, projectScope, projectSubmission, status, matricNo) VALUES ('".$projectTitle."', '".$projectScope."', '".$projectSubmission."', '".$status."', '".$activeuser."')";
            $result = mysqli_query($conn, $query);
            
            if($result){
                echo '<script language="javascript">';
                echo 'alert("Preference Inserted!"); location.href="std_svAssigning.php"';
                echo '</script>';
            }else{
                echo '<script language="javascript">';
                echo 'alert("Failed to insert preference!"); location.href="std_svAssigning.php"';
                echo '</script>';
            }
        }else{
            echo '<script language="javascript">';
            echo 'alert("Something went wrong!"); location.href="std_svAssigning.php"';
            echo '</script>';
        }

}else if(isset($_POST['Assign'])){
    $svData = array();
    $TRUE =  1;
    $confirm = mysqli_query($conn, "UPDATE projectdetails SET confirmStatus = '$TRUE' WHERE matricNo = '$activeuser'");
    if($confirm == true){
        //echo '<script language="javascript">';
        //echo 'alert("You have finalised your update"); location.href="std_svAssigning.php"';
        //echo '</script>';
        
        $sv = mysqli_query($conn, "SELECT * FROM supervisor WHERE field ='$course' AND assignedCount!='5'");
        $count = mysqli_num_rows($sv);
        $assignedSv = array();

        $pairwise = mysqli_query($conn, "SELECT * FROM pairwise WHERE pairwiseID ='1'");
        $rowPair=mysqli_fetch_array($pairwise,MYSQLI_ASSOC);
         
        $select = mysqli_query($conn,"SELECT * FROM projectdetails WHERE matricNo = '$activeuser'");
        $pd = mysqli_fetch_array($select, MYSQLI_ASSOC);

        $stdScope = $pd['projectScope'];
        $stdSubmission = $pd['projectSubmission'];

        //Criteria Weight
        $cw1 = $rowPair['cw1'];
        $cw2 = $rowPair['cw2'];
        $cw3 = $rowPair['cw3'];

        if($count != 0){
            while ($row = mysqli_fetch_assoc($sv)) {

                //data from sv table
                $svUser = $row['username'];
                $svName = $row['svName'];
                $expertise = $row['expertise'];
                $projPref = $row['projectPreference'];
                $assignCount = $row['assignedCount'];
    
                //Criteria 1 score
                if($stdScope == $expertise){
                    $scoreCriteria1 = 1;
                }else{
                    $scoreCriteria1 = 2/5;
                }
    
    
                //Criteria 2 score
                if($stdSubmission  == $projPref){
                    $scoreCriteria2 = 1;
                }else{
                    $scoreCriteria2 = 2/5;
                }
    
    
                //Criteria 3 score
                switch ($assignCount) {
                    case '0':
                        $scoreCriteria3 = 1;
                        break;
                    case '1':
                        $scoreCriteria3 = 4/5;
                        break;
                    case '2':
                        $scoreCriteria3 = 3/5;
                        break;
                    case '3':
                        $scoreCriteria3 = 2/5;
                        break;
                    case '4':
                        $scoreCriteria3 = 1/5;
                        break;
                    default:
                    $scoreCriteria3 = 0;
                    break;

            }
            //Rank =Sum of Score*criteria weight
            $rankScore = ($scoreCriteria1*$cw1)+($scoreCriteria2*$cw2)+($scoreCriteria3*$cw3);
    
            $svData = array(
                'username' => $svUser,
                'svName' => $svName,
                'svScope' => $expertise,
                'svPref' => $projPref,
                'svCount' => $assignCount,
                'rank' => $rankScore
            );
    
            $assignedSv[] = $svData;
        }
        // Push the associative array into the $assignedSv array
        
        function compareRanks($a, $b) {
            // Compare ranks in descending order
            if ($a['rank'] == $b['rank']) {
                return 0;
            }
            return ($a['rank'] > $b['rank']) ? -1 : 1;
        }
        
        // Sort the array using the custom comparison function
        usort($assignedSv, 'compareRanks');
        
    
        $assignSvID = $assignedSv[0]['username'];
        $assignSvCount = $assignedSv[0]['svCount'];

        $std = mysqli_query($conn, "SELECT * FROM students WHERE matricNo='$activeuser'");
        $stdRow = mysqli_fetch_array($std);
        
        $svAssign = $stdRow['assignedSV'];
    
        if($svAssign == "NA"){
            $updateAssign = mysqli_query($conn, "UPDATE students SET assignedSV = '$assignSvID' WHERE matricNo = '$activeuser'");
        
            if($updateAssign == true){
                $newCount = $assignSvCount + 1;
                $updateCount = mysqli_query($conn, "UPDATE supervisor SET assignedCount = '$newCount' WHERE username = '$assignSvID'");
        
                if($updateCount == true){
                    echo '<script language="javascript">';
                    echo 'alert("Supervisor Assigned !");';
                    //echo 'window.location.href = "std_svAssigning.php";';
                    echo '</script>';
                }else{
                    echo '<script language="javascript">';
                    echo 'alert("Error updating !");';
                    echo 'window.location.href = "std_svAssigning.php";';
                    echo '</script>';
                }
        
            }else{
                echo '<script language="javascript">';
                echo 'alert("Error updating !");';
                echo 'window.location.href = "std_svAssigning.php";';
                echo '</script>';
            }
        }
    }
}
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
    <h2 class="mt-3 py-3 px-5 text-left">AHP Assigment Calculation Representation</h2>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Student Project Scope</th>
                    <th>Student Project Submission</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $stdScope ?></td>
                    <td><?php echo $stdSubmission ?></td>
                </tr>
            </tbody>
        </table>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>SV Name</th>
                    <th>Supervisor Scope</th>
                    <th>Supervisor Prefered Project</th>
                    <th>Supervisor Current Assigned students</th>
                    <th>Rank</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($assignedSv as $row): ?>
                    <tr>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['svName']; ?></td>
                        <td><?php echo $row['svScope']; ?></td>
                        <td><?php echo $row['svPref']; ?></td>
                        <td><?php echo $row['svCount']; ?></td>
                        <td><?php echo $row['rank']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
      </table>
      <a class="btn btn-primary" href="std_svAssigning.php">Go Back</a>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>