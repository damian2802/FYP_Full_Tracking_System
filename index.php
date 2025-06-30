<?php
include 'conn.php';

$error = "";
if($_SERVER["REQUEST_METHOD"]=="POST") {

  $myusername = mysqli_real_escape_string($conn,$_POST['username']);
  $mypassword = mysqli_real_escape_string($conn,$_POST['password']);
  $hashedPassword = password_hash($username, PASSWORD_DEFAULT);
  
  $queryStd ="SELECT * FROM students WHERE matricNo ='$myusername'";
  $querySv ="SELECT * FROM supervisor WHERE username ='$myusername'";
  $queryCoor ="SELECT * FROM coordinator WHERE username ='$myusername'";


  $resultStd= mysqli_query($conn,$queryStd);
  $rowStd=mysqli_fetch_array($resultStd,MYSQLI_ASSOC);
  $countStd= mysqli_num_rows($resultStd);

  $resultSv= mysqli_query($conn,$querySv);
  $rowSv=mysqli_fetch_array($resultSv,MYSQLI_ASSOC);
  $countSv= mysqli_num_rows($resultSv);

  $resultCoor= mysqli_query($conn,$queryCoor);
  $rowCoor=mysqli_fetch_array($resultCoor,MYSQLI_ASSOC);
  $countCoor= mysqli_num_rows($resultCoor);
  
  if ($countCoor==1 && password_verify($mypassword, $rowCoor['password'])){
    session_start();
    $_SESSION['username'] = $myusername;
    $_SESSION['accessLevel'] = 0;
    $_SESSION['name'] = $rowCoor['coorName'];
    header("location: cdr_mainPage.php");

  } else if($countSv == 1 && password_verify($mypassword, $rowSv['password'])){
    session_start();
    $_SESSION['username'] = $myusername;
    $_SESSION['accessLevel'] = 1;
    $_SESSION['name'] = $rowSv['svName'];
    $_SESSION['course'] = $rowSv['field'];
    header("location: sv_mainPage.php");

  } else if($countStd == 1 && password_verify($mypassword, $rowStd['password'])){
    session_start();
    $_SESSION['username'] = $myusername;
    $_SESSION['accessLevel'] = 2;
    $_SESSION['name'] = $rowStd['studentName'];
    $_SESSION['course'] = $rowStd['course'];
    header("location: std_mainPage.php");

  } else {
    $error= "Your Username or Password is invalid";
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
    <div class="container-fluid">
       <div class="row min-vh-100">
        <div class="col-4 bg-dark position-relative">
          <div class="position-relative top-50 start-50 translate-middle px-5">
          <img src="assets/Color3D_for Dark Background.png" class="img-fluid align-items-center" alt="...">
          </div>
        </div>
        <div class="col-8 bg-light position-relative">
          <div class="position-relative top-50 start-50 translate-middle px-5">
          <h1 class="text-align-center">Welcome to FYP Full Tracking System</h1>
          <form action="" method="post">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Log In</button>
            <?php echo "<strong>".$error."</strong>"; ?>
          </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>