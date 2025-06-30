<?php
include 'conn.php';

session_start();
$activeuser = $_SESSION["username"];
$accessLevel = $_SESSION["accessLevel"];
$name = $_SESSION['name'];

$scopeID = $_GET['scopeID'];
$op = $_GET['op'];

if($op == "delete"){
    $result = mysqli_query($conn, "DELETE FROM scope WHERE scopeID='$scopeID'");

    if($result == true){
        echo '<script language="javascript">';
        echo 'alert("Succesfully Deleted!"); location.href="cdr_manageAssigning.php"';
        echo '</script>';

    }else{
        echo '<script language="javascript">';
        echo 'alert("Error deleting!"); location.href="cdr_manageAssigning.php"';
        echo '</script>';
    }
}elseif ($op="edit") {
    $select = mysqli_query($conn, "SELECT * FROM scope WHERE scopeID='$scopeID'");
    $row = mysqli_fetch_array($select);

}

if(isset($_POST['update'])){
    $scope = $_POST['scope'];
    $choices = $_POST['choices'];

    $pp = $krk = $ki = $im = 0;

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

    $update = mysqli_query($conn, "UPDATE scope SET scope = '$scope', pp ='$pp', krk ='$krk', ki ='$ki', im ='$im' WHERE scopeID='$scopeID'");
    
    if($update){
        echo '<script language="javascript">';
        echo 'alert("Succesfully Updated!"); location.href="cdr_manageAssigning.php"';
        echo '</script>';
    }else{
        echo '<script language="javascript">';
        echo 'alert("Error Updating!"); location.href="cdr_manageAssigning.php"';
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
    <div class="container">
        <h2 class="text-left">Add/Update Scope</h2>
        <div class="container-fluid">
            <?php
            $scopeName = $row['scope'];
            ?>
            <form class="px-5 mx-5" action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">Add Expertise/Scope :</label>
                    <input type="text" class="form-control" name="scope" value="<?php echo $scopeName; ?>" required>
                </div>
                <div class="mb-3 btn-group" role="Group">
                  <label class="form-label me-3">Select course of student :</label>
                  <input type="checkbox" class="btn-check" id="btncheck1" name="choices[]" value="PP" autocomplete="off" <?php if($row['pp'] == true) echo 'checked="checked"'; ?>>
                  <label class="btn btn-outline-primary" for="btncheck1">PP</label>
                  <input type="checkbox" class="btn-check" id="btncheck2" name="choices[]" value="KRK" autocomplete="off" <?php if($row['krk'] == true) echo 'checked="checked"'; ?>>
                  <label class="btn btn-outline-primary" for="btncheck2">KRK</label>
                  <input type="checkbox" class="btn-check" id="btncheck3" name="choices[]" value="KI" autocomplete="off" <?php if($row['ki'] == true) echo 'checked="checked"'; ?>>
                  <label class="btn btn-outline-primary" for="btncheck3">KI</label>
                  <input type="checkbox" class="btn-check" id="btncheck4" name="choices[]" value="IM" autocomplete="off" <?php if($row['im'] == true) echo 'checked="checked"'; ?>>
                  <label class="btn btn-outline-primary" for="btncheck4">IM</label>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" name="update">Update</button>
            </form>
        </div>
    </div>
    <!--JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>