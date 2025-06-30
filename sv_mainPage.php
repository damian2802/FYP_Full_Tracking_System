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
    <div class="container">
        <div class="row">
            <div class="col pt-5"><h1 class="pt-5 px-5 text-center fw-bold">Welcome to Final Year Project</h1></div>
        </div>
        <div class="row">
            <div class="col pb-5"><h1 class="px-5 text-center fw-bold">Full Tracking System</h1></div>
        </div>
       <div class="row">
              <div class="col bg-light w-20 h-20 p-5 m-5 text-center">
                <img src="assets/iconmonstr-id-card-25-240.png" class="img-fluid align-items-center" alt="" width="120"><br>
                <a href="sv_updateExpertise.php">Update Expertise</a>
            </div>
            <div class="col bg-light w-20 h-20 p-5 m-5 text-center">
                <img src="assets/iconmonstr-document-thin-240.png" class="img-fluid align-items-center" alt="" width="120"><br>
                <a href="sv_assignStudent.php">FYP 1 & FYP 2</a>
            </div>
      </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>