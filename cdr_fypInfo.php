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
      <h2 class="py-3 px-5 text-left">Update FYP Information</h2>
      <form class="px-5 mx-5" action="func_updateFypInfo.php" method="POST" enctype="multipart/form-data">
        <div class="input-group mb-3">
          <span class="input-group-text">Information</span>
          <textarea class="form-control" aria-label="With textarea" name="info" Required></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Attachment :</label>
          <input type="file" class="form-control" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="attachment" accept="application/pdf">
        </div>
        <div class="mb-3 btn-group" role="Group">
          <label class="form-label me-3">Select course of student :</label>
          <input type="checkbox" class="btn-check" id="btncheck1" name="choices[]" value="PP" autocomplete="off">
          <label class="btn btn-outline-primary" for="btncheck1">PP</label>
          <input type="checkbox" class="btn-check" id="btncheck2" name="choices[]" value="KRK" autocomplete="off">
          <label class="btn btn-outline-primary" for="btncheck2">KRK</label>
          <input type="checkbox" class="btn-check" id="btncheck3" name="choices[]" value="KI" autocomplete="off">
          <label class="btn btn-outline-primary" for="btncheck3">KI</label>
          <input type="checkbox" class="btn-check" id="btncheck4" name="choices[]" value="IM" autocomplete="off">
          <label class="btn btn-outline-primary" for="btncheck4">IM</label>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <h2 class="mt-3 py-3 px-5 text-left">FYP Information</h2>
    </div>
    <div class="container">
    <table class="table table-striped">
        <thead>
          <tr>
            <th>Coordinator</th>
            <th>Information</th>
            <th>Post Date</th>
            <th>Course</th>
            <th>Attachment</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query ="SELECT * FROM fypinfo JOIN coordinator ON fypinfo.coorID = coordinator.username";

            
            $count = 1;
            $result= mysqli_query($conn,$query);
            while($row = mysqli_fetch_assoc($result)){
              $infoID = $row['infoID'];
              $coorID = $row['coorID'];
              $info = $row['infoDetail'];
              $postDate = $row['postDate'];
              $attachmentPath = $row['attachment'];
              $PP = $row['pp'];
              $KRK = $row['krk'];
              $KI = $row['ki'];
              $IM = $row['im'];
              $coorName = $row['coorName'];



              $course = "";

              if($PP == true)
                $course .= " | PP";
              
              if($KRK == true)
                $course .= " | KRK";
              
              if($KI == true)
                $course .= " | KI";
              
              if($IM == true)
                $course .= " | IM";
              
  
    // Create a link for the attachment if it exists
    $attachmentLink = "No attachment";
    $attachmentView = "";
    if ($attachmentPath) {
        $attachmentLink = "<a href='$attachmentPath' target='_parent'>Download</a> ";
    }

    if ($attachmentPath) {
      $attachmentView = "| <a href='view_attachment.php?file=$attachmentPath' target='_blank'>View</a>";
    }
              echo "
          <tr>
            <td>$coorName</td>
            <td>$info</td>
            <td>$postDate</td>
            <td>$course</td>
            <td>$attachmentLink  $attachmentView</td>
            <td><button type='button' class='btn btn-primary' onclick=\"window.location='cdr_editFypInfo.php?infoID=".$infoID."'\">Edit</button></td>
            <td><button type='button' class='btn btn-danger' onclick=\"window.location='func_deleteInfo.php?infoID=".$infoID."&attachment=".$attachmentPath."'\">Delete</button></td>
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