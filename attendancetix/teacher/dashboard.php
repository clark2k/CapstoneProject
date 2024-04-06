<?php
// Start the session
include "../conn.php";
include "../process.php";

// Check if the teacher is logged in
if (!isset($_SESSION['teacher_email'])) {
    // Redirect to the login page if not logged in
    header("Location: index.php");
    exit();
}

// Get the teacher's email from the session
$teacher_email = $_SESSION['teacher_email'];

$check_teacher = mysqli_query($conn, "SELECT * FROM `teachers` WHERE `teacher_id` = '$teacher_email'");
$fetch_teacher = mysqli_fetch_assoc($check_teacher);


// Check if teacher data is fetched successfully
if (!empty($fetch_teacher)) {
  // Teacher data is found
  $session_teachername = $fetch_teacher['teacher_fname'] . " " . $fetch_teacher['teacher_lname'];
  $teacherID = $fetch_teacher['teacher_id'];
} else {
  // No teacher data found, set a default name
  $default_name = "Teacher";
  $session_teachername = isset($fetch_teacher['teacher_fname']) && isset($fetch_teacher['teacher_lname']) ? $fetch_teacher['teacher_fname'] . " " . $fetch_teacher['teacher_lname'] : $default_name;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Teacher's Dashboard</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link href="assets/img/UI.png" rel="icon">
  <link href="assets/img/UI-icon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
 
  <link rel="stylesheet" href="../datatables/css/dataTables.bootstrap5.css" />
  <link rel="stylesheet" href="../datatables/css/responsive.bootstrap5.css" />
</head>
<style>
  
   .dt-paging.paging_full_numbers ul.pagination{
    gap: 5px;
   }
  .dt-paging.paging_full_numbers ul.pagination .dt-paging-button.page-item a{
    border-radius:50%;
    width:30px;
    height:30px;
    display: flex;
    align-items:center;
    justify-content:center;
    background-color:white;
    color:black;
    border:1px solid gray;
  }
  .dt-paging.paging_full_numbers ul.pagination .dt-paging-button.page-item.active a{
      border:1px solid white;
      background-color:#003300;
      color:white;
  }

  .calendar input{
    width:30%;
    border:1px solid black;
  }

  .dt-search input{
    border:1px solid black;
  }

  .dt-length .form-select{
    border:1px solid black;
  }

  .download-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
  }

  .download-btn:hover {
    background-color: #45a049;
  }

  .download-btn .menu-icon {
    margin-right: 10px;
  }
  
  .container-fluid .sidebar{
  box-shadow:0px 0px 0px 2px gray;
}

  .container-fluid .sidebar  .nav .nav-item{
  background-color:#003300;
  border-radius:10px;
}

.container-fluid .sidebar  .nav .nav-item .nav-content{
  border:1px solid red;
  color:blue;
  background-color:white;
}

.container-fluid .sidebar  .nav .nav-item a{
  background-color:white;
  color:#003300;
  font-weight:bold;
}

.container-fluid .sidebar  .nav .nav-item i{
  border:2px solid #003300;
  font-weight:bold;
}

.container-fluid .sidebar  .nav .nav-item:hover span{
  color:white;
}

.container-fluid .sidebar  .nav .nav-item:hover i{
  color:white;
  border:2px solid white;
  font-weight:bold;
}

table {
  border-collapse: collapse;
  width: 140%; /* Set width to 100% for responsiveness */
  border: 1px solid black; /* Border for the entire table */
}

th, td {
  border: 1px solid black; /* Border for table cells */
  padding: 8px;
  text-align: left;
}

th {
  background-color: #003300;
    color:white;  /* Background color for table header */
}

@media only screen and (max-width: 600px) {
  table {
    width: 100%; /* Set width to 100% for responsiveness */

  }

  th,
  td {
    font-size: 14px; /* Adjust font size for smaller screens */
  }

}



</style>
<body>
  
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center" style="background-color:#003300;">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100"  style="background-color:#003300;">  
          <a class="navbar-brand brand-logo" hrf="adminhome.php" style="color:white; background-color:#003300;">Dashboard</a>
          <a class="navbar-brand brand-logo-mini" href="adminhome.php"><img src="images/UI-icon.png" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-view-headline" style="color:white;"></span>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end" style="background-color:#003300;">
        <ul class="navbar-nav mr-lg-4 w-100">
          <li class="nav-item nav-search d-none d-lg-block w-100">
            <div class="input-group">
              <div class="input-group-prepend">
                
                 
            

          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown me-1">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-bs-toggle="dropdown">
             
              
            </a>
          
            

          </li>

          <li class="nav-item nav-profile dropdown" style="color:white;">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <img src="images/UI.png" alt="profile"/>
              <span class="nav-profile-name text-white"><?php echo  $session_teachername;  ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
             
              
            <ul>
                <li class="dropdown-item">
                    <a href="Certificate.docx" id="downloadBtn" download class="download-btn">
                        <i class="mdi mdi-download menu-icon" style="color:#003300;"></i>
                        Download Default Certificate
                    </a>
                </li> 

                </li>
                <li class="dropdown-item">
                    <form action="../process.php" method="POST">
                      <a class=dropdown-item>
                        <i class="mdi mdi-export menu-icon " style="color:#003300;"></i>
                        <span><input type="submit" name="logout" value="Log Out" href="logout.php" style="background-color: transparent; background-repeat: 
                          no-repeat; border: none; cursor: pointer; overflow: hidden; outline: none; color:#003300;"></span>
                    </a>
                    </form>
                </li>
            </ul>

            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
              <i class="mdi mdi-home menu-icon" style="color:white; border:2px solid white;"></i>
              <span class="menu-title text-white">Dashboard</span>
            </a>
          </li>
         
          <li class="nav-item">
        <a class="nav-link" href="studentrecords.php" >
           <i class="mdi mdi-account-multiple menu-icon"></i>
           <span class="menu-title">Student Record</span>
        </a>
          <li class="nav-item">
    </li>

        
         

        </ul>
    
      </li><!-- End Components Nav -->



        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          
        <div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-end flex-wrap">
                <div class="me-md-3 me-xl-5">
                    <!-- Attendance Table -->
                      <table border="1px solid" id="example" >
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Student ID</th>
                                    <th>Date Recorded</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Execute SQL query to fetch attendance data for students assigned to the logged-in teacher
                                $query = "SELECT s.fname, s.lname, s.studentid, a.date_recorded, a.time_in, a.time_out
                                          FROM attendance a
                                          INNER JOIN student s ON a.student_id = s.studentid
                                          WHERE s.assigned_teacher_email = '$teacher_email'";
                                $result = mysqli_query($conn, $query);

                                // Display the fetched data in an HTML table
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['fname'] . "</td>";
                                    echo "<td>" . $row['lname'] . "</td>";
                                    echo "<td>" . $row['studentid'] . "</td>";
                                    echo "<td>" . $row['date_recorded'] . "</td>";
                                    echo "<td>" . $row['time_in'] . "</td>";
                                    echo "<td>" . $row['time_out'] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
         
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/data-table.js"></script>
  <script src="js/jquery.dataTables.js"></script>
  <script src="js/dataTables.bootstrap4.js"></script>
  <script src="../datatables/js/jquery-3.7.0.js"></script>
  <script src="../datatables/js/dataTables.js"></script>
  <script src="../datatables/js/dataTables.bootstrap5.js"></script>
  <script src="../datatables/js/dataTables.responsive.js"></script>
  <script src="../datatables/js/responsive.bootstrap5.js"></script>
  <script src="../datatables/js/script.js"></script>
  <!-- End custom js for this page-->


  <script src="js/jquery.cookie.js" type="text/javascript"></script>
 

<!-- ASSIGN STUDENTS -->
<div class="modal fade" id="assignStudentsModal" tabindex="-1" aria-labelledby="assignStudentsModalLabel" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #1a6600;">
        <h5 class="modal-title text-white" id="assignStudentsModalLabel" style="font-weight:bold;">Assign Students</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="process_assign_students.php" method="POST">

          <div class="input-group mb-3">
            <div class="input-group-text text-white" style="background-color: #1a6600;">
              <i class="bi bi-person-circle"></i>
            </div>
            <select name="student_id" class="form-control">
              <option value="">Select Student</option>
              <?php
              include "../conn.php";

              $departmentFilter = "CITE"; // Change this to the desired department

              $getStudents = mysqli_query($conn, "SELECT * FROM `student` WHERE TRIM(`department`) = '$departmentFilter'");
              if (!$getStudents) {
                  die('Query failed: ' . mysqli_error($conn));
              }

              // Check if there are rows returned
              if (mysqli_num_rows($getStudents) > 0) {
                  while ($studentRow = mysqli_fetch_assoc($getStudents)) {
                      echo '<option value="' . $studentRow['studentid'] . '">' . $studentRow['fname'] . ' ' . $studentRow['lname'] . '</option>';
                  }
              } else {
                  echo '<option value="">No students found</option>';
              }
              ?>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <input type="reset" value="Clear" class="btn" style="background-color:black; color:white;">
          <input type="submit" name="assign_students_button" value="Assign" class="btn" style="background-color: #1a6600; color:white;">
        </div>
      </form>
    </div>
  </div>
</div>
  
</body>

</html>
<?php
       


?>