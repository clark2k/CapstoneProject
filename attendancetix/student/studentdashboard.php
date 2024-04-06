<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Student Record</title>
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

  
.container-fluid .sidebar{
  box-shadow:0px 0px 0px 2px gray;
}

.container-fluid .sidebar  .nav .nav-item{
  background-color:#003300;
  border-radius:10px;
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
  <?php
    include "../conn.php";
    include "../process.php";

    if(isset($_SESSION['session_id'])){
      $loggedInID = $_SESSION['session_id'];

      $check_students = mysqli_query($conn, "SELECT * FROM `student` WHERE `id` = '$loggedInID'");
      $fetch_students = mysqli_fetch_assoc($check_students);

      if(!empty($fetch_students)){
        $session_studentname = $fetch_students['fname']." ".$fetch_students['lname'];
        $studentID = $fetch_students['studentid'];
        
        

        ?>    
          <!-- partial:partials/_navbar.html -->
          <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" >
            <div class="navbar-brand-wrapper d-flex justify-content-center" style="background-color:#003300;">
              <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100" style="background-color:#003300;">  
                <a class="navbar-brand brand-logo" href="adminhome.php"  style="color:white; background-color:#003300;">Student's Dashboard</a>
                <a class="navbar-brand brand-logo-mini" href="adminhome.php"><img src="images/UI-icon.png" alt="logo"/></a>
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                  <span class="mdi mdi-view-headline" style="color:white;"></span>
                </button>
              </div>  
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end" style="background-color:#003300;">
              <ul class="navbar-nav mr-lg-4 w-100" >
                <li class="nav-item nav-search d-none d-lg-block w-100" >
                  <div class="input-group">
                    <div class="input-group-prepend" >
                      
                      
                  

                </li>
              </ul>
              <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown me-1">
                  <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-bs-toggle="dropdown" >
                  
                    
                  </a>
                
                  

                </li>

                <li class="nav-item nav-profile dropdown" style="color:white;">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                    <img src="images/UI.png" alt="profile"/>
                    <span class="nav-profile-name" style="color:white;"><?php echo $session_studentname; ?></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown" >
                    
                    <ul>
                        <form action="../process.php" method="POST">
                            
                            <a class=dropdown-item>
                            <i class="mdi mdi-export menu-icon " style="color:#003300;"></i>
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
            <nav class="sidebar sidebar-offcanvas">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="studentdashboard.php">
              <i class="mdi mdi-home menu-icon" style="color:white; border:2px solid white;"></i>
              <span class="menu-title text-white">Dashboard</span>
            </a>
          </li>
         
          <li class="nav-item">
        <a class="nav-link" href="studentprofile.php" >
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
                          <h2>View Student Records</h2>
                          
                          <!--Student Form Attendance------------------------------------>
                        <table border="1px solid" style="width: 100%" id="example">
                          <thead>
                            <tr>                      
                              <th>Student ID </th>
                              <th>Date Recorded </th>
                              <th>Time-In </th>
                              <th>Time-Out</th>
                            </tr>
                          </thead>

                            <tbody>
                              <?php
                                include "../conn.php";

                                $getAttendance = mysqli_query($conn, "SELECT * FROM `attendance` WHERE student_id = '$studentID'");
                                while($attendanceRow = mysqli_fetch_assoc($getAttendance)){

                                ?>
                                <tr>
                          
                                  <td><?php echo $attendanceRow['student_id']; ?> </td>
                                  <td><?php echo $attendanceRow['date_recorded']; ?>  </td>
                                  <td><?php echo $attendanceRow['time_in']; ?>  </td>
                                  <td><?php echo $attendanceRow['time_out']; ?> </td>
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
        <?php
      }
    }else{
      ?>
          <script>
            alert("Log-In first to enter student dashboard");
            window.location.href="../index.php"
          </script>
      <?php
    }

  ?>

</body>

</html>

