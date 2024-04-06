<?php
session_start();

if (!isset($_SESSION['admin'])) {
  // Redirect to login page or display an error message
  echo "<script>alert('Please log in first!'); window.location.href='../index.php';</script>";
  exit();
}

// Include database connection
include "../conn.php";

// Fetch records based on the selected department, if any
$department_filter = isset($_GET['department']) ? $_GET['department'] : '';
$query = "SELECT * FROM `attendance` a INNER JOIN `student` s ON a.student_id = s.studentid";
if ($department_filter) {
    $query .= " WHERE TRIM(s.department) = '$department_filter'";
}
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
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

  .dt-search input{
    border:1px solid black;
  }

  .dt-length .form-select{
    border:1px solid black;
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

.icon i{
 position:absolute;
 margin:-26px 0px 0px 655px;
 color: black;
 font-size:22px;
 
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
  color:white; /* Background color for table header */
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

  <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex justify-content-center" style="background-color:#003300;">
      <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100" style="background-color:#003300;">  
        <a class="navbar-brand brand-logo" href="adminhome.php" style="color:white; background-color:#003300;">Admin's Dashboard</a>
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
            </div>
          </div>
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
            <span class="nav-profile-name" style="color:white;">Admin</span>
          </a>

          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
         <ul>
            <form action="../process.php" method="POST">
                <ul>
                    <a class="nav-link collapsed text-primary" href="#" data-bs-toggle="modal" data-bs-target="#registerModal" >
                        <span style="color:#003300; padding-left:40px;">Register</span>
                    </a>
                </ul>
                <ul>
                    <button class="dropdown-item" type="submit" name="logout">
                        <i class="mdi mdi-export menu-icon" style="color:#003300;"></i>
                        <span style="color:#003300; ">Log Out</span>
                    </button>
                </ul>
            </form>

          </ul>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>

  <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="adminhome.php">
              <i class="mdi mdi-home menu-icon" style="color:white; border:2px solid white;"></i>
              <span class="menu-title" style="color:white;">Dashboard</span>
            </a>
          </li>
         
          <li class="nav-item">
        <a class="nav-link" href="adminstudentrecord.php" >
           <i class="mdi mdi-format-list-bulleted menu-icon">
           </i><span class="menu-title">Student Record</span>
        </a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="adminreports.php">
            <i class="mdi mdi-account-alert menu-icon"></i>
            <span class="menu-title">Student Reports</span>
          </a>
        </li>
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
                                <!-- Department selection form -->
                                <form method="GET">
                                    <select name="department" onchange="this.form.submit()">
                                        <option value="">Select Department</option>
                                        <?php
                                            // Query to fetch all distinct departments from the database
                                            $department_query = "SELECT DISTINCT TRIM(department) AS department FROM `student`";
                                            $department_result = mysqli_query($conn, $department_query);
                                            
                                            // Loop through the result and generate the options
                                            while ($department_row = mysqli_fetch_assoc($department_result)) {
                                                $department_name = htmlspecialchars($department_row['department']); // Escape department name
                                                echo "<option value=\"$department_name\">$department_name</option>";
                                            }
                                        ?>                          
                                    </select>
                                    <noscript><input type="submit" value="View Records"></noscript>
                                </form>


                                <!-- Display records based on the selected department -->
                                <div id="records-table">
                                <table border="1px solid" id="example">
                                        <!-- Table headers -->
                                        <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Student ID</th>
                                            <th>Date Recorded</th>
                                            <th>Time-In</th>
                                            <th>Time-Out</th>
                                        </tr>
                                        </thead>
                                        <!-- Table body -->
                                        <tbody>
                                        <?php
                                        // Loop through the records and display them in the table
                                        while ($attendanceRow = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $attendanceRow['fname']; ?></td>
                                                <td><?php echo $attendanceRow['lname']; ?></td>
                                                <td><?php echo $attendanceRow['studentid']; ?></td>
                                                <td><?php echo $attendanceRow['date_recorded']; ?></td>
                                                <td><?php echo $attendanceRow['time_in']; ?></td>
                                                <td><?php echo $attendanceRow['time_out']; ?></td>
                                            </tr>
                                            <?php
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
        </div>
    </div>
    
     <!-- .content-wrapper -->
  </div> <!-- .main-panel -->
</div> <!-- .container-fluid -->

<!-- Department Registration Form Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"  style="background-color:#003300; color:white;">
        <h5 class="modal-title" id="registerModalLabel">Register Department</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../process.php" method="POST">
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="department_email" placeholder="Enter email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="department_password" placeholder="Enter password" required>
          </div>
          <div class="mb-3">
            <label for="department" class="form-label">Department</label>
            <select class="form-select" id="department" name="department_name" required>
              <option selected disabled>Select department</option>
              <option value="csdl">CSDL</option>
              <option value="marketing">Marketing</option>
              <option value="registrar">Registrar</option>
              <option value="cite">Cite</option>
              <option value="clinic">Clinic</option>
              <!-- Add more options for other departments -->
            </select>
          </div>
          <button type="submit" class="btn btn-primary" name="dep_reg_button"  style="background-color:#003300; color:white;">Register</button>
        </form>
      </div>
    </div>
  </div>
</div>

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

<script>
document.addEventListener("DOMContentLoaded", function() {
  const registerButton = document.querySelector('.nav-link[data-bs-target="#registerModal"]');
  registerButton.addEventListener("click", function(event) {
    event.preventDefault();
    const registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
    registerModal.show();
  });

  // Listen for modal close event
  const registerModal = document.getElementById('registerModal');
  registerModal.addEventListener('hidden.bs.modal', function () {
    // Remove backdrop element to restore website interactivity
    const backdrop = document.querySelector('.modal-backdrop');
    backdrop.parentNode.removeChild(backdrop);
  });
});
</script>

</body>
</html>
