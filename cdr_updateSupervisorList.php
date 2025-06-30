<?php
include 'conn.php';
session_start();
$activeuser = $_SESSION["username"];
$accessLevel = $_SESSION["accessLevel"];
$name = $_SESSION['name'];

if($activeuser=="" || $accessLevel != 0){
  header("location: index.php");
}

if(isset($_POST['add'])){

  $username = $_POST['username'];
  $password_hashed = password_hash($_POST['username'], PASSWORD_DEFAULT);
  $name = $_POST['name'];
  $course = $_POST['course'];
  $assignedCount = "0";

  $prevQuery = "SELECT * FROM supervisor WHERE username = '$username'";
  $prevResult= mysqli_query($conn,$prevQuery);

  if(mysqli_num_rows($prevResult) > 0){
    echo '<script language="javascript">';
    echo 'alert("Data already exist!"); location.href="cdr_updateSupervisorList.php"';
    echo '</script>';
    exit;
  }else{
    //Insert Data
    mysqli_query($conn, "INSERT INTO supervisor (username, password, svName, field, assignedCount) VALUES ('".$username."', '".$password_hashed."', '".$name."', '".$course."', '".$assignedCount."')");
    echo '<script language="javascript">';
    echo 'alert("Data Successfully Saved!"); location.href="cdr_updateSupervisorList.php"';
    echo '</script>';
  }
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
      <h2 class="py-3 px-5 text-left">Update Supervisor List</h2>
      <form class="px-5 mx-5" action="func_updateSv.php" method="POST" enctype="multipart/form-data">
        <div class="input-group mb-3">
          <input type="file" class="form-control" id="inputGroupFile02" name="file">
          <button type="submit" class="btn btn-primary" name="importSubmit">Upload</button>
        </div>
      </form>
      <h2 class="py-3 px-5 text-left">Update Supervisor</h2>
      <form class="px-5 mx-5" method="POST">
        <div class="mb-3">
          <label class="form-label">Supervisor name :</label>
          <input type="text" class="form-control" name="name" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Phone Number :</label>
          <input type="text" class="form-control" name="username" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Field :</label>
          <select class="form-select" aria-label="Default select example" name="course">
            <option value="PP">PP</option>
            <option value="KRK">KRK</option>
            <option value="KI">KI</option>
            <option value="IM">IM</option>
          </select>
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-primary" name="add">Add Supervisor</button>
        </div>
      </form>
      <h2 class="py-3 px-5 text-left">Supervisor List</h2>
    </div>
    <div class="container">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>SupervisorID</th>
            <th>Supervisor Name</th>
            <th>Field</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query ="SELECT * FROM supervisor";
            $result= mysqli_query($conn,$query);
            while($row = mysqli_fetch_assoc($result)){
              $svID = $row['username'];
              $svName = $row['svName'];
              $field = $row['field'];
              $userLevel = 1;
              echo "
          <tr>
            <td>$svID</td>
            <td>$svName</td>
            <td>$field</td>
            <td><button type='button' class='btn btn-danger'onclick=\"window.location='func_deleteUser.php?userid=".$svID."&usrlvl=".$userLevel."'\">Delete</button></td>
          </tr>";
        }
        ?>
        </tbody>
      </table>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>