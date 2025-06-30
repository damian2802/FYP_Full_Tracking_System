<?php
include 'conn.php';
session_start();
$activeuser = $_SESSION["username"];
$accessLevel = $_SESSION["accessLevel"];
$name = $_SESSION['name'];


if($activeuser=="" || $accessLevel != 0){
  header("location: index.php");
}

if(isset($_POST['edit'])){
    $ID = $_POST['ID'];
    $info = $_POST['info'];
    $choices = isset($_POST['choices']) ? $_POST['choices'] : [];
    $created_at = date('Y-m-d H:i:s');

    // Initialize columns for courses
    $pp = $krk = $ki = $im = 0;

    // Set columns to true if selected
    foreach ($choices as $choice) {
        switch ($choice) {
            case 'PP':
                $pp = 1;
                break;
            case 'KRK':
                $krk = 1;
                break;
            case 'KI':
                $ki = 1;
                break;
            case 'IM':
                $im = 1;
                break;
        }
    }

    $update = mysqli_query($conn, "UPDATE fypinfo SET infoDetail ='$info', postDate ='$created_at', pp ='$pp', krk ='$krk', ki ='$ki', im ='$im', coorID ='$activeuser' WHERE infoID='$ID'");

    if($update){
        echo '<script language="javascript">';
        //echo 'alert("Succesfully Updated!"); location.href="cdr_fypInfo.php"';
        echo '</script>';

    }else{
        echo '<script language="javascript">';
        //echo 'alert("Error Updating!"); location.href="cdr_fypInfo.php"';
        echo '</script>';
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
      <h2 class="py-3 px-5 text-left">Edit FYP Information</h2>
      <?php
      $infoID = $_GET['infoID'];
      $select = mysqli_query($conn, "SELECT * FROM fypinfo WHERE infoID='$infoID'");
      $row = mysqli_fetch_assoc($select);

      $infoDetail = $row['infoDetail'];
      $attachment = $row['attachment'];
      $pp = $row['pp'];
      $krk = $row['krk'];
      $ki = $row['ki'];
      $im = $row['im'];
      $coorID = $row['coorID'];
      $checkedPP = "";
      $checkedKRK = "";
      $checkedKI = "";
      $checkedIM = "";


      if($pp == true)
      $checkedPP = "checked";
      if($krk == true)
      $checkedKRK = "checked";
      if($ki == true)
      $checkedKI = "checked";
      if($im == true)
      $checkedIM = "checked";
      
      ?>
      <form class="px-5 mx-5" action="" method="POST">
      <div class="mb-3">
          <label class="form-label">InfoID :</label>
          <input type="text" class="form-control" name="ID" value="<?php echo $infoID;?>" readonly>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text">Information</span>
          <textarea class="form-control" aria-label="With textarea" name="info" Required><?php echo $infoDetail;?></textarea>
        </div>
        <div class="mb-3 btn-group" role="Group">
          <label class="form-label me-3">Select course of student :</label>
          <input type="checkbox" class="btn-check" id="btncheck1" name="choices[]" value="PP" autocomplete="off" <?php echo $checkedPP;?>>
          <label class="btn btn-outline-primary" for="btncheck1">PP</label>
          <input type="checkbox" class="btn-check" id="btncheck2" name="choices[]" value="KRK" autocomplete="off" <?php echo $checkedKRK;?>>
          <label class="btn btn-outline-primary" for="btncheck2">KRK</label>
          <input type="checkbox" class="btn-check" id="btncheck3" name="choices[]" value="KI" autocomplete="off" <?php echo $checkedKI;?>>
          <label class="btn btn-outline-primary" for="btncheck3">KI</label>
          <input type="checkbox" class="btn-check" id="btncheck4" name="choices[]" value="IM" autocomplete="off" <?php echo $checkedIM;?>>
          <label class="btn btn-outline-primary" for="btncheck4">IM</label>
        </div>
        <br>
        <button type="submit" name="edit" class="btn btn-primary">Edit</button>
      </form>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>