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
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>
<body>
  
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center"  style="background-color:#003300;">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100"  style="background-color:#003300;">  
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
              <span class="nav-profile-name text-white">Admin</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
             
              
              <ul>
                  <form action="../process.php" method="POST">
                      
                      <a class=dropdown-item>
                      <i class="mdi mdi-export menu-icon" style="color:#003300;"></i>
                      <span><input type="submit" name="logout" value="Log Out" style="background-color: transparent; background-repeat: 
                             no-repeat; border: none; cursor: pointer; overflow: hidden; outline: none; color:#003300;"></span>
                      </a>
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
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-color:#003300;">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="adminhome.php">
              <i class="mdi mdi-home menu-icon text-white"></i>
              <span class="menu-title text-white">Admin's Dashboard</span>
            </a>
          </li>
         
          <li class="nav-item">
        <a class="nav-link collapsed text-white" data-bs-target="#components-nav" data-bs-toggle="collapse"  href="" >
           <i class="mdi mdi-arrow-down menu-icon text-white"></i><span class="menu-title text-white">Department</span>
        </a>

        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <a class="nav-link collapsed text-white" href="csdl.php">
              <i class="mdi mdi-account menu-icon text-white"  style="border:1px solid white;"></i><span>CSDL</span>
            </a>
            <a class="nav-link collapsed text-white" href="marketing.php">
              <i class="mdi mdi-account menu-icon text-white"  style="border:1px solid white;"></i><span>Marketing</span>
            </a>
            <a class="nav-link collapsed text-white" href="registrar.php">
              <i class="mdi mdi-account menu-icon text-white"  style="border:1px solid white;"></i><span>Registrar</span>
            </a>
            <a class="nav-link collapsed text-white" href="cite.php">
              <i class="mdi mdi-account menu-icon text-white"  style="border:1px solid white;"></i><span>Cite</span>
            </a>
            <a class="nav-link collapsed text-white" href="clinic.php">
              <i class="mdi mdi-account menu-icon text-white"  style="border:1px solid white;"></i><span>Clinic</span>
            </a>
          </ul>
        </li>
        <li class="nav-item">
                <a class="nav-link  text-white" data-bs-target="#components-nav"  href="marketing.php" >
                <i class="mdi mdi-arrow-down menu-icon text-white"></i><span class="menu-title text-white">Student Record</span>
                </a>
         </li>
        <!-- End Components Nav -->
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
                    <h2>Clinic Admin</h2>
                    <p class="mb-md-0">You can check the record history of the attendances of scholars here.</p>
                    <br> </br>
                     <!--Student Form Attendance------------------------------------>
                     <table border="1px solid" style="width: 230%">
                      <tr>
                        <th>First Name </th>
                        <th>Last Name </th>
                        <th>Student ID </th>
                        <th>Date Recorded </th>
                        <th>Time-In </th>
                        <th>Time-Out</th>
                      </tr>
                      <tr>
                      <?php
                      include "../conn.php";

                      $departmentFilter = "clinic"; // Change this to the desired department

                      $getCiteAttendance = mysqli_query($conn, "SELECT * FROM `attendance` a
                      INNER JOIN `student` s ON a.student_id = s.studentid
                      WHERE TRIM(s.department) = '$departmentFilter'");
                      if (!$getCiteAttendance) {
                          die('Query failed: ' . mysqli_error($conn));
                      }

                      // Check if there are rows returned
                      if (mysqli_num_rows($getCiteAttendance) > 0) {
                          while ($attendanceRow = mysqli_fetch_assoc($getCiteAttendance)) {
                      ?>
                              <tr>
                                  <td><?php echo $attendanceRow['fname']; ?> </td>
                                  <td><?php echo $attendanceRow['lname']; ?> </td>
                                  <td><?php echo $attendanceRow['studentid']; ?> </td>
                                  <td><?php echo $attendanceRow['date_recorded']; ?>  </td>
                                  <td><?php echo $attendanceRow['time_in']; ?>  </td>
                                  <td><?php echo $attendanceRow['time_out']; ?> </td>
                              </tr>
                              <?php
                          }
                      } else {
                          echo "No attendance data found for the specified department.";
                      }
                      ?>
                        
                      </tr>
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
  <!-- End custom js for this page-->

  <script src="js/jquery.cookie.js" type="text/javascript"></script>
</body>

</html>

