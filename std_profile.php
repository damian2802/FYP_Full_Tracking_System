<?php
include 'conn.php';
session_start();
$activeuser = $_SESSION["username"];
$accessLevel = $_SESSION["accessLevel"];
$name = $_SESSION['name'];
$course = $_SESSION['course'];
$error ="";

if($activeuser=="" || $accessLevel != 2){
    header("location: index.php");
  }

if(isset($_POST['editname'])){
  $nameChange = $_POST['name'];
  
  $update = mysqli_query($conn, "UPDATE students SET studentName = '$nameChange' WHERE matricNo='$activeuser'");

  if($update){
    $_SESSION['name'] = $nameChange;
    echo '<script language="javascript">';
    echo 'alert("Successfully Updated Name!"); location.href="std_profile.php"';
    echo '</script>';
  }else{
    echo '<script language="javascript">';
    echo 'alert("Error Updating!"); location.href="std_profile.php"';
    echo '</script>';
  }
}else if(isset($_POST['changepassword'])){
  $oldPassword = $_POST['oldPass'];
  $newPassword = $_POST['newPass'];
  $newConfirmPassword = $_POST['newConPass'];

  $select = mysqli_query($conn, "SELECT * FROM students WHERE matricNo='$activeuser'");
  $row = mysqli_fetch_array($select);

  if($newPassword == $newConfirmPassword){
    if(password_verify($oldPassword, $row['password'])){
      $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
      $update = mysqli_query($conn, "UPDATE students SET password ='$hashedPassword' WHERE matricNo='$activeuser'");
      if($update){
        echo '<script language="javascript">';
        echo 'alert("Password changed successfully!");';
        echo '</script>';   
      }else{
        echo '<script language="javascript">';
        echo 'alert("Error changing password!");';
        echo '</script>'; 
      }
    }else{
      $error = "Incorrect password!";
    }
  }else{
    $error = "Passwords do not match!";
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <title>FYP Full Tracking System</title>

    <style>
      .valid-feedback {
        display: none;
      }
      .is-valid .valid-feedback {
        display: block;
      }
      .is-invalid .invalid-feedback {
        display: block;
      }
      .input-group-text {
        cursor: pointer;
      }
    </style>
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
    <div class="container-fluid">
        <h2 class="mt-3 py-3 px-5 text-left">Student Profile</h2>
        <form class="px-5 mx-5" method="POST">
          <div class="mb-3">
            <label class="form-label">Matric No:</label>
            <input type="text" class="form-control" name="" value="<?php echo $activeuser;?>" disabled>
          </div>
          <div class="mb-3">
            <label class="form-label">Student Name :</label>
            <input type="text" class="form-control" name="name" value="<?php echo $name;?>" required>
          </div>
          <div class="mb-3">
            <button type="submit" name="editname" class="btn btn-primary">Edit Name</button>
          </div>
        </form>  
        <h2 class="mt-3 py-3 px-5 text-left">Change Password</h2>
        <form class="px-5 mx-5" method="POST" id="passwordForm">
          <div class="mb-3">
            <label class="form-label">Old Password :</label>
            <div class="input-group">
              <input type="password" class="form-control" name="oldPass" required>
              <span class="input-group-text"><i class="bi bi-eye-slash" id="toggleOldPass"></i></span>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">New Password :</label>
            <div class="input-group">
              <input type="password" class="form-control" id="newPass" name="newPass" required>
              <span class="input-group-text"><i class="bi bi-eye-slash" id="toggleNewPass"></i></span>
              <div class="valid-feedback">Looks good!</div>
              <div class="invalid-feedback">
                Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Confirm New Password :</label>
            <div class="input-group">
              <input type="password" class="form-control" id="newConPass" name="newConPass" required>
              <span class="input-group-text"><i class="bi bi-eye-slash" id="toggleConPass"></i></span>
              <div class="valid-feedback">Passwords match!</div>
              <div class="invalid-feedback">Passwords do not match!</div>
            </div>
          </div>
          <button type="submit" name="changepassword" class="btn btn-primary">Change Password</button>
          <?php echo "<strong>".$error."</strong>"; ?>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const newPasswordInput = document.getElementById('newPass');
        const confirmPasswordInput = document.getElementById('newConPass');
        const passwordForm = document.getElementById('passwordForm');
        const toggleOldPass = document.getElementById('toggleOldPass');
        const toggleNewPass = document.getElementById('toggleNewPass');
        const toggleConPass = document.getElementById('toggleConPass');

        function validatePassword() {
          const password = newPasswordInput.value;
          const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

          if (passwordRegex.test(password)) {
            newPasswordInput.classList.add('is-valid');
            newPasswordInput.classList.remove('is-invalid');
          } else {
            newPasswordInput.classList.add('is-invalid');
            newPasswordInput.classList.remove('is-valid');
          }
        }

        function validateConfirmPassword() {
          const password = newPasswordInput.value;
          const confirmPassword = confirmPasswordInput.value;

          if (password === confirmPassword && confirmPassword !== "") {
            confirmPasswordInput.classList.add('is-valid');
            confirmPasswordInput.classList.remove('is-invalid');
          } else {
            confirmPasswordInput.classList.add('is-invalid');
            confirmPasswordInput.classList.remove('is-valid');
          }
        }

        function togglePasswordVisibility(input, icon) {
          if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
          } else {
            input.type = "password";
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
          }
        }

        newPasswordInput.addEventListener('input', validatePassword);
        confirmPasswordInput.addEventListener('input', validateConfirmPassword);

        toggleOldPass.addEventListener('click', function() {
          togglePasswordVisibility(document.querySelector('input[name="oldPass"]'), toggleOldPass);
        });

        toggleNewPass.addEventListener('click', function() {
          togglePasswordVisibility(newPasswordInput, toggleNewPass);
        });

        toggleConPass.addEventListener('click', function() {
          togglePasswordVisibility(confirmPasswordInput, toggleConPass);
        });

        passwordForm.addEventListener('submit', function (event) {
          validatePassword();
          validateConfirmPassword();

          if (!newPasswordInput.classList.contains('is-valid') || !confirmPasswordInput.classList.contains('is-valid')) {
            event.preventDefault();
            event.stopPropagation();
          }
        }, false);
      });
    </script>
  </body>
</html>
