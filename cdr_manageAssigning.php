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
        <h2 class="py-3 text-left">Manage Pairwise Matrix</h2>
      <div>
        <form>
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th class="col-1">Pairwise Matrix</th>
                    <th class="col-1">Project Scope</th>
                    <th class="col-1">Project Submission</th>
                    <th class="col-1">Workload</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Project Scope</th>
                    <td  class="px-3">1</td>
                    <td><select class="form-select" aria-label="Default select example" name="" id="ScopeSubmission">
                    <option value="1" selected disabled>1</option>
                    <option value="2">2 (Intermediate values)</option>
                    <option value="3">3 (Moderate importance)</option>
                    <option value="4">4 (Intermediate values)</option>
                    <option value="5">5 (Strong importance)</option>
                    <option value="6">6 (Intermediate values)</option>
                    <option value="7">7 (Very strong importance)</option>
                    <option value="8">8 (Intermediate values)</option>
                    <option value="9">9 (Extreme importance)</option>
                    <option value="0.500" disabled>1/2</option>
                    <option value="0.333" disabled>1/3</option>
                    <option value="0.250" disabled>1/4</option>
                    <option value="0.200" disabled>1/5</option>
                    <option value="0.167" disabled>1/6</option>
                    <option value="0.143" disabled>1/7</option>
                    <option value="0.125" disabled>1/8</option>
                    <option value="0.111" disabled>1/9</option>
                    </select></td>
                    <td><select class="form-select" aria-label="Default select example" name="" id="ScopeWorkload">
                    <option value="1" selected disabled>1</option>
                    <option value="2">2 (Intermediate values)</option>
                    <option value="3">3 (Moderate importance)</option>
                    <option value="4">4 (Intermediate values)</option>
                    <option value="5">5 (Strong importance)</option>
                    <option value="6">6 (Intermediate values)</option>
                    <option value="7">7 (Very strong importance)</option>
                    <option value="8">8 (Intermediate values)</option>
                    <option value="9">9 (Extreme importance)</option>
                    <option value="0.500" disabled>1/2</option>
                    <option value="0.333" disabled>1/3</option>
                    <option value="0.250" disabled>1/4</option>
                    <option value="0.200" disabled>1/5</option>
                    <option value="0.167" disabled>1/6</option>
                    <option value="0.143" disabled>1/7</option>
                    <option value="0.125" disabled>1/8</option>
                    <option value="0.111" disabled>1/9</option>
                    </select></td>                   
                </tr>
                <tr>
                    <th>Project Submission</th>
                    <td><select class="form-select" aria-label="Default select example" name="" id="SubmissionScope">
                    <option value="1" selected disabled>1</option>
                    <option value="2">2 (Intermediate values)</option>
                    <option value="3">3 (Moderate importance)</option>
                    <option value="4">4 (Intermediate values)</option>
                    <option value="5">5 (Strong importance)</option>
                    <option value="6">6 (Intermediate values)</option>
                    <option value="7">7 (Very strong importance)</option>
                    <option value="8">8 (Intermediate values)</option>
                    <option value="9">9 (Extreme importance)</option>
                    <option value="0.500" disabled>1/2</option>
                    <option value="0.333" disabled>1/3</option>
                    <option value="0.250" disabled>1/4</option>
                    <option value="0.200" disabled>1/5</option>
                    <option value="0.167" disabled>1/6</option>
                    <option value="0.143" disabled>1/7</option>
                    <option value="0.125" disabled>1/8</option>
                    <option value="0.111" disabled>1/9</option>
                    </select></td>
                    <td  class="px-3">1</td>
                    <td><select class="form-select" aria-label="Default select example" name="" id="SubmissionWorkload">
                    <option value="1" selected disabled>1</option>
                    <option value="2">2 (Intermediate values)</option>
                    <option value="3">3 (Moderate importance)</option>
                    <option value="4">4 (Intermediate values)</option>
                    <option value="5">5 (Strong importance)</option>
                    <option value="6">6 (Intermediate values)</option>
                    <option value="7">7 (Very strong importance)</option>
                    <option value="8">8 (Intermediate values)</option>
                    <option value="9">9 (Extreme importance)</option>
                    <option value="0.500" disabled>1/2</option>
                    <option value="0.333" disabled>1/3</option>
                    <option value="0.250" disabled>1/4</option>
                    <option value="0.200" disabled>1/5</option>
                    <option value="0.167" disabled>1/6</option>
                    <option value="0.143" disabled>1/7</option>
                    <option value="0.125" disabled>1/8</option>
                    <option value="0.111" disabled>1/9</option>
                    </select></td>
                </tr>
                <tr>
                    <th>Workload</th>
                    <td><select class="form-select" aria-label="Default select example" name="" id="WorkloadScope">
                    <option value="1" selected disabled>1</option>
                    <option value="2">2 (Intermediate values)</option>
                    <option value="3">3 (Moderate importance)</option>
                    <option value="4">4 (Intermediate values)</option>
                    <option value="5">5 (Strong importance)</option>
                    <option value="6">6 (Intermediate values)</option>
                    <option value="7">7 (Very strong importance)</option>
                    <option value="8">8 (Intermediate values)</option>
                    <option value="9">9 (Extreme importance)</option>
                    <option value="0.500" disabled>1/2</option>
                    <option value="0.333" disabled>1/3</option>
                    <option value="0.250" disabled>1/4</option>
                    <option value="0.200" disabled>1/5</option>
                    <option value="0.167" disabled>1/6</option>
                    <option value="0.143" disabled>1/7</option>
                    <option value="0.125" disabled>1/8</option>
                    <option value="0.111" disabled>1/9</option>
                    </select></td>
                    <td><select class="form-select" aria-label="Default select example" name="" id="WorkloadSubmission">
                    <option value="1" selected disabled>1</option>
                    <option value="2">2 (Intermediate values)</option>
                    <option value="3">3 (Moderate importance)</option>
                    <option value="4">4 (Intermediate values)</option>
                    <option value="5">5 (Strong importance)</option>
                    <option value="6">6 (Intermediate values)</option>
                    <option value="7">7 (Very strong importance)</option>
                    <option value="8">8 (Intermediate values)</option>
                    <option value="9">9 (Extreme importance)</option>
                    <option value="0.500" disabled>1/2</option>
                    <option value="0.333" disabled>1/3</option>
                    <option value="0.250" disabled>1/4</option>
                    <option value="0.200" disabled>1/5</option>
                    <option value="0.167" disabled>1/6</option>
                    <option value="0.143" disabled>1/7</option>
                    <option value="0.125" disabled>1/8</option>
                    <option value="0.111" disabled>1/9</option>
                    </select></td>
                    <td  class="px-3">1</td>
                </tr>
            </tbody>
        </table>
        <table>
          <tr>
            <td><p>Consistency Index:</p></td>
            <td><p id="CI"></p></td>
          </tr>
          <tr>
            <td><p>Consistency Ratio:</p></td>
            <td><p id="CR"></p></td>
          </tr>
        </table>
        Current Priority Vector
        <table class="table table-striped">
          <tr>
            <th>Scope</th>
            <th>Submission</th>
            <th>Workload</th>
          </tr>
          <tr>
            <td><p id="Weight1"></p></td>
            <td><p id="Weight2"></p></td>
            <td><p id="Weight3"></p></td>
          </tr>
        </table>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM pairwise");
        $count = mysqli_num_rows($result);
       

        if($count == 1){
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
          $cw1 = $row['cw1'] * 100;
          $cw2 = $row['cw2'] * 100;
          $cw3 = $row['cw3'] * 100;
          echo"
          Saved priority vector(Database)
          <table class='table table-striped'>
            <tr>
              <th>Scope</th>
              <th>Submission</th>
              <th>Workload</th>
            </tr>
            <tr>
              <td>$cw1%</td>
              <td>$cw2%</td>
              <td>$cw3%</td>
            </tr>
          </table>";

        }
        ?>
        <div class="text-center">
            <button type="button" class="btn btn-primary" id="calc">Check pairwise</button>
            <button type="button" class="btn btn-primary" id="save">Save pairwise</button>
        </div>
      </form>
    </div> 
  </div>
  <div class="container">
    <h2 class="text-left">Add/Update Scope</h2>
    <div class="container-fluid">
      <form class="px-5 mx-5" action="func_addScope.php" method="POST">
        <div class="mb-3">
          <label class="form-label">Add Expertise/Scope :</label>
          <input type="text" class="form-control" name="scope" required>
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
        <button type="submit" class="btn btn-primary">Add</button>
      </form>
      </div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Scope/Expertise</th>
            <th>Course/Field</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $result= mysqli_query($conn,"SELECT * FROM scope");
            while($row = mysqli_fetch_assoc($result)){
              $scopeID = $row['scopeID'];
              $scope = $row['scope'];
              $PP = $row['pp'];
              $KRK = $row['krk'];
              $KI = $row['ki'];
              $IM = $row['im'];

              $course = "";

              if($PP == true)
                $course .= " | PP";
              
              if($KRK == true)
                $course .= " | KRK";
              
              if($KI == true)
                $course .= " | KI";
              
              if($IM == true)
                $course .= " | IM";
              
              echo "
              <tr>
              <td>$scope</td>
              <td>$course</td>
              <td><button type='button' class='btn btn-primary' onclick=\"window.location='func_deleteScope.php?scopeID=".$scopeID."&op=edit'\">Edit</button></td>
              <td><button type='button' class='btn btn-danger' onclick=\"window.location='func_deleteScope.php?scopeID=".$scopeID."&op=delete'\">Delete</button></td>
              </tr>";
            }
            ?>
        </tbody>
      </table>
      <h2 class="text-left">View/Manage Assign</h2>
      <?php
      $total = mysqli_query($conn, "SELECT * FROM students");
      $totalCount = mysqli_num_rows($total);
      $unassigned = mysqli_query($conn, "SELECT * FROM students WHERE assignedSv ='NA'");
      $unCount = mysqli_num_rows($unassigned);
      $assignedCount = $totalCount - $unCount;
      ?>
      <table class="table table-striped">
        <tbody>
          <tr>
            <th>Total assigned Students</th>
            <td><?php echo $assignedCount ."/". $totalCount;?> <a href="cdr_svStdList.php" class="btn btn-primary">View Assigned List</a></td>
          </tr>
          <tr>
            <th>Total Unassigned Students</th>
            <td><?php echo $unCount ."/". $totalCount;?> <a href="cdr_svStdUnassignedList.php" class="btn btn-primary">View Unassigned List</a></td>
          </tr>
        </tbody>
      </table>
      
  </div>
    <!--JavaScript -->
    <script>
    const selectA = document.getElementById('ScopeSubmission');
    const selectB = document.getElementById('SubmissionScope');

    const selectC = document.getElementById('ScopeWorkload');
    const selectD = document.getElementById('WorkloadScope');

    const selectE = document.getElementById('SubmissionWorkload');
    const selectF = document.getElementById('WorkloadSubmission');

    selectA.addEventListener('change', function() {
        const selectedValue = parseFloat(this.value);
        const inverseValue = 1 / selectedValue;
        selectB.value = inverseValue.toFixed(3);
    });

    selectB.addEventListener('change', function() {
        const selectedValue = parseFloat(this.value);
        const inverseValue = 1 / selectedValue;
        selectA.value = inverseValue.toFixed(3);
    });

    selectC.addEventListener('change', function() {
        const selectedValue = parseFloat(this.value);
        const inverseValue = 1 / selectedValue;
        selectD.value = inverseValue.toFixed(3);
    });

    selectD.addEventListener('change', function() {
        const selectedValue = parseFloat(this.value);
        const inverseValue = 1 / selectedValue;
        selectC.value = inverseValue.toFixed(3);
    });

    selectE.addEventListener('change', function() {
        const selectedValue = parseFloat(this.value);
        const inverseValue = 1 / selectedValue;
        selectF.value = inverseValue.toFixed(3);
    });

    selectF.addEventListener('change', function() {
        const selectedValue = parseFloat(this.value);
        const inverseValue = 1 / selectedValue;
        selectE.value = inverseValue.toFixed(3);
    });
    document.getElementById('calc').addEventListener('click', function() {
      let matrix = [
      [1, selectA.value, selectC.value],
      [selectB.value, 1, selectE.value],
      [selectD.value, selectF.value, 1]
    ];
   
    
    // Function to calculate the sum of elements in an array
    function arraySum(arr) {
      return arr.reduce((total, num) => total + num, 0);
    }
    
    // Function to calculate the normalized matrix
    function calculateNormalizedMatrix(matrix) {
      const n = matrix.length;
      const normalizedMatrix = [];
      
      // Calculate the sum of each column
      const colSums = Array.from({ length: n }, () => 0);
      for (let i = 0; i < n; i++) {
        for (let j = 0; j < n; j++) {
          colSums[j] += parseFloat(matrix[i][j]);
        }
      }

      console.log(n);
      console.log(colSums);
      // Normalize the matrix
      for (let i = 0; i < n; i++) {
        const row = [];
        for (let j = 0; j < n; j++) {
          row.push(matrix[i][j] / colSums[j]);
        }
        normalizedMatrix.push(row);
      }
      return normalizedMatrix;
    }
    
    // Function to calculate the final priorities
    function calculateFinalPriorities(normalizedMatrix) {
      const n = normalizedMatrix.length;
      const finalPriorities = [];
      
      for (let i = 0; i < n; i++) {
        const rowSum = arraySum(normalizedMatrix[i]);
        finalPriorities.push((rowSum / n).toFixed(4)); // Display priorities with 4 decimal places
        console.log(rowSum);
      }
      return finalPriorities;
    }
    

  
    // Function to calculate the Consistency Index (CI)
    function calculateConsistencyIndex(matrix, finalPriorities) {
      const n = matrix.length;
      let CI = 0;
      const rowSums = []; // Array to store row sums
      
      for (let i = 0; i < n; i++) {
        let rowSum = 0;
        for (let j = 0; j < n; j++) {
          rowSum += matrix[i][j] * finalPriorities[j];
        }
        
        rowSums.push(rowSum); // Store the row sum
      }
      
      // Calculate CI by dividing the accumulated sum by the respective final priorities
      for (let i = 0; i < n; i++) {
        CI += rowSums[i] / finalPriorities[i];
      }
      
      CI /= n; // Divide by the number of criteria
      CI = (CI - n)/(n - 1);
      return CI; // Return the Consistency Index
    }
    
    // Function to calculate the Random Index (RI) based on the order of the matrix
    function calculateRandomIndex(n) {
      const randomIndices = [0, 0, 0, 0.58, 0.90, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49];
      if (n <= randomIndices.length) {
        return randomIndices[n];
      } else {
        return 0; // Return 0 for larger matrices (n > 10), as RI values are not predefined
      }
    }
    
    // Function to calculate the Consistency Ratio (CR)
    function calculateConsistencyRatio(CI, n) {
      const RI = calculateRandomIndex(n);
      const CR = CI / RI;
      return CR;
    }
    
    // Calculate normalized matrix
    const normalizedMatrix = calculateNormalizedMatrix(matrix);
    console.log("Normalized Matrix:");
    console.table(normalizedMatrix);
    
    // Calculate final priorities
    const finalPriorities = calculateFinalPriorities(normalizedMatrix);
    console.log("Final Priorities:");
    console.table(finalPriorities);

    // Calculate Consistency Index (CI)
    const CI = calculateConsistencyIndex(matrix, finalPriorities);
    console.log("Consistency Index (CI):", CI.toFixed(4));

    // Calculate Consistency Ratio (CR)
    const n = matrix.length;
    const CR = calculateConsistencyRatio(CI, n);
    console.log("Consistency Ratio (CR):", CR.toFixed(4));

    document.getElementById('CI').innerHTML = CI.toFixed(4);
    document.getElementById('CR').innerHTML = CR.toFixed(4) * 100 + "%";
    document.getElementById('Weight1').innerHTML = (finalPriorities[0] * 100).toFixed(2) + "%";
    document.getElementById('Weight2').innerHTML = (finalPriorities[1] * 100).toFixed(2) + "%";
    document.getElementById('Weight3').innerHTML = (finalPriorities[2] * 100).toFixed(2) + "%";

    document.getElementById('save').addEventListener('click', function() {

      const data = {
      finalPriorities: finalPriorities,
      matrix: matrix
      };

      console.log(data);

      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'func_updatePairwise.php', true);
      xhr.setRequestHeader('Content-Type', 'application/json');
      
      xhr.onreadystatechange = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            console.log('Data saved successfully!', xhr.responseText);
            alert("Succesfully Updated!");
            location.href="cdr_manageAssigning.php";
          } else {
            console.error('Error saving data:', xhr.statusText);
          }
        }
      };
      
      xhr.send(JSON.stringify(data));

});


});


   






    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>