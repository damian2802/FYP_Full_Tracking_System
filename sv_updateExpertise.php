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
    <?php

    $result = mysqli_query($conn, "SELECT * FROM supervisor WHERE username ='$activeuser'");
    $count = mysqli_num_rows($result);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $expertise = $row['expertise'];
    $pref = $row['projectPreference'];

    
    ?>
    <div class="container-fluid">
        <h2 class="py-3 px-5 text-left">Update Expertise</h2>
        <form class="px-5 mx-5" action="func_updateSvExpertise.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Expertise :</label>
                <select class="form-select" aria-label="Default select example" name="expertise">
                    <?php
                    $query = mysqli_query($conn, "SELECT * FROM scope WHERE $field=TRUE");
                    
                    while($rowScope = mysqli_fetch_assoc($query)){
                      $scopeID = $rowScope['scopeID'];
                      $scopeName = $rowScope['scope'];
                      echo "
                        <option>$scopeName</option>
                        ";
                    }   
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Prefered Project :</label>
                <select class="form-select" aria-label="Default select example" name="preference">
                    <option value="Research Based">Research Based</option>
                    <option value="Development Based">Development Based</option>
                </select>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary" name="Update">Submit</button>
                <button type="submit" class="btn btn-primary" name="Confirm">Confirm your Update</button>
            </div>
          </form>
          <h2 class="py-3 px-5 text-left">Update Profile Infomation</h2>
          <div class="container">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Expertise Selected</th>
                  <th>Prefered Project Selected</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php

                if($expertise == "" || $pref ==""){
                  $status = "Not Updated";
                }else{
                    $status = "Status Updated";
                }

                if($row['confirmStatus'] == true){
                  $confirm = "(Confirmed)";
                }else{
                    $confirm = "(Not Confirmed)";
                }
                
                if($count  ==  1){
                    echo"
                    <tr>
                    <td>$expertise</td>
                    <td>$pref</td>
                    <td>$status $confirm</td>
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