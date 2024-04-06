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


</head>
<style>
.card{
  width: 25rem;
  height:15rem  ;
  max-height: 100%;
  top:17px;
  left:15px;
  margin-bottom:60px;
}
.card .card-body{
  position: relative;
  border: 2px solid #003300;
  max-width: 100%;
  max-height: 100%;
  height: 100%;
  font-weight:bold;
}

.card .card-header{
  height:4rem;
  padding:5px 0;
  background-color:#003300;
  display:flex;
  justify-content:space-between;

}
.card .card-header .pic{
  margin-left: 5px;

}
.card .card-header .pic img{
  height:3.5rem;
  border:1px solid white;
  width: 3.5rem;
  border-radius: 50%;
  overflow: hidden;
}

.card .time{
  border-radius:1px;
  font-size:14px;
  margin-left:150px;
  background-color:#003300;
  width:fit-content;
  color:black;
  color:white;
  padding:5px 5px 5px 5px;
 
}

.card .card-header .dropdown{
  width:fit-content;
  margin-left: 83%;
  position:absolute; top: 5px;

}

.card .card-header .dropdown button{
  background:none;
  color:white;
  font-size:30px;
  border:1px solid #003300 ;
  margin:5px 0px 0px 25px;
  
}

.card .card-header .dropdown .dropdown-menu{
  background-color:#003300;
  padding:0px;
  box-shadow:0px;
}

.card .card-header .dropdown .dropdown-item{
  color:white;
}

.card .card-header .dropdown .dropdown-menu:hover .dropdown-item a{
  background-color: white;
  color:black;

}

.card .card-header .dropdown .dropdown-menu:hover a{
  color:black;
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

.card .btn{
  border:2px solid green;
  padding:5px 5px 5px 05px;
  margin-right:6px;
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

.src input{
  border:1px solid white;
  padding:5px 500px 5px 0px;
  border-radius:5px;
}

.icon i{
 position:absolute;
 margin:-26px 0px 0px 655px;
 color: black;
 font-size:22px;
}

@media only screen and (max-width: 600px) {
  .src input {
    padding-right: 0.0em; /* Adjust padding for smaller screens */
    margin-left:30px;
  }

  .icon i {
    margin: -26px 0px 0px 210px; /* Adjust icon position for smaller screens */
  }
}

@media only screen and (max-width: 600px) {
  .card {
      width: 90%;
  }
  .pic {
      margin-right:50px;
  }
  .dropdown {
      text-align: right;
  }
  .card-body {
      padding: 10px;
  }
 }

.check-box{
  margin-bottom:-20px;
}

.check-box .enable{
  margin:20px 0px 15px 15px; 
  margin-top:10px;
  font-size:25px;
  background-color:#003300;
  color:white;
  border:2px solid #003300;
  border-radius:5px;
}

.check-box .disable{
  margin:20px 0px 15px 15px; 
  margin-top:10px;
  font-size:25px;
  background-color:gray;
  color:white;
  border:2px solid gray;
  border-radius:5px;
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
    <!------------------------ SEARCH BAR------------------------------------------------------------------ -->
    <div class = "src">
              <form action="" method="GET">
                <input type="text" name="search" value=""<?php if(isset($_GET['search'])){ echo $_GET['search']; } ?> placeholder="Search..."  > 
              </form>
      
            <div class="icon">
              <i class="mdi mdi-magnify menu-icon"></i>
          </div>
      </div>

    
  
      <!-------------------------- END--------------------------------- -->
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
            
    <li class="dropdown-item">
       <a href="#" data-bs-toggle="modal" data-bs-target="#assignStudentsModal" >
          <span><input type="submit" name="tr" value="Register Student" style="background-color: transparent; background-repeat: 
              no-repeat; border: none; cursor: pointer; overflow: hidden; outline: none; color:#003300;"></span>
          </a>
    </li>

    </li>
    <li class="dropdown-item">
        <form action="../process.php" method="POST">
        <form action="../process.php" method="POST">
           <a class=dropdown-item>
            <i class="mdi mdi-export menu-icon " style="color:#003300;"></i>
            <span><input type="submit" name="logout" value="Log Out" href="logout.php" style="background-color: transparent; background-repeat: 
              no-repeat; border: none; cursor: pointer; overflow: hidden; outline: none; color:#003300;"></span>
        </a>
        </form>
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
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
         
          <li class="nav-item">
        <a class="nav-link" href="studentrecords.php" >
           <i class="mdi mdi-account-multiple menu-icon" style="color:white; border:2px solid white;"></i>
           <span class="menu-title text-white">Student Record</span>
        </a>
          <li class="nav-item">
    </li>
        </ul>
      </li><!-- End Components Nav -->
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-fluid">
            <div class="row ">
               <div class="check-box">
                          <?php
                            $select = mysqli_query($conn, "SELECT * FROM attendanceform WHERE teacher_department = 'cite' AND action = 1");

                            if(mysqli_num_rows($select) == 1){
                              $fetch = mysqli_fetch_assoc($select);

                              if($fetch['action'] == TRUE){
                                ?>
                                  <form action="../process.php" method="POST">

                                      <input type="submit" class="disable" name="disable" value="Disable"> 
                                                                                          
                                  </form>
                                <?php
                              }else{
                                ?>
                                  <form action="../process.php" method="POST">

                                      <input type="submit" class="enable" name="enable" value="Enable">  
                                                                        
                                  </form>
                                <?php
                              }
                            }else{
                              ?>
                                <form action="../process.php" method="POST">

                                    <input type="submit" class="enable" name="enable" value="Enable">
                                                    
                                </form>
                              <?php
                            }
                          ?>
                 </div>
                <!--Student Card------------------------------------>
          <?php
            if(!isset($_GET['search'])){
              // Fetch students assigned to the logged-in teacher
              $query = "SELECT * FROM student WHERE assigned_teacher_email = '$teacher_email'";
              $result = mysqli_query($conn, $query);

              // Loop through each student and display their information
              while ($row = mysqli_fetch_assoc($result)) {
                  $studentID = $row['studentid'];
                  $id = $row['id'];

                  // Retrieve student photo
                  $select_photo = mysqli_query($conn, "SELECT * FROM `photo` WHERE `student_id` = '$id'");
                  $fetch_photo = mysqli_fetch_assoc($select_photo);

                  if ($fetch_photo) {
                      $student_photo = $fetch_photo['picture'];
                  } else {
                      $student_photo = "../images/UI.png";
                  }
                ?>
                  <div class="col-lg-5">
                      <!-- Student Card HTML structure -->
                      <div class="card">
                          <div class="card-header d-flex flex-column gap-2">
                              <div class="pic mb-2">
                                  <img src="../student/uploads/<?php echo $student_photo; ?>">

                            <div class="dropdown" >
                                <button class="btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                  <!-- Three dots icon, you can use your own or a Unicode character like &#8942; for vertical ellipsis -->
                                  &#8942;
                                </button>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    
                                    <form action="process_unassign_students.php" method="POST" onsubmit="return confirm('Are you sure you want to unassign this student?');">
                                      <input type="hidden" name="student_id" value="<?php echo $row['studentid']; ?>">
                                      <input type="submit" name="unassign_student" class="dropdown-item" value="Unassigned" >
                                   </form>
                                   
                                </div>
                              </div>   
                              </div>
                          </div>
                          <div class="card-body">
                              <p>First Name: <?php echo $row['fname']; ?></p>
                              <p>Last Name: <?php echo $row['lname']; ?></p>
                              <p>Department: <?php echo $row['department']; ?></p>
                              <p>Student ID: <?php echo $row['studentid']; ?></p>
                              <p>Email: <?php echo $row['email']; ?></p>
                              
                              <div class="time">
                                  TOTAL DUTY:
                                  <b>
                                      <?php
                                      $sum = mysqli_query($conn, "SELECT SUM(total_hours) as total FROM attendance WHERE student_id = '$studentID'");
                                      $total_hours = mysqli_fetch_assoc($sum)['total'];
                                      echo $total_hours ? $total_hours . " Hours" : "0 Hours";
                                      ?>
                                  </b>                    
                              </div>
                              <!-- Button to unassign student -->
                    
                          </div>
                      </div>
                  </div>
                <?php
              }
            }else{
              $filter_search = $_GET['search'];
              $teacher_search = mysqli_query($conn, "SELECT * FROM `student` WHERE CONCAT(fname, lname) LIKE '%$filter_search%' AND assigned_teacher_email = '$teacher_email'");

              if(mysqli_num_rows($teacher_search) > 0){
                while($row = mysqli_fetch_array($teacher_search)){
                  $studentID =$row['studentid'];
                  $id = $row['id'];

                  $select_photo = mysqli_query($conn, "SELECT * FROM `photo` WHERE `student_id` = '$id'");
                  $fetch_photo = mysqli_fetch_assoc($select_photo);

                  if($fetch_photo){
                    $student_photo = $fetch_photo['picture'];
                    
                  }else{
                    $student_photo = "../images/favicon.png";
                  }

                  ?>
                    <div class="col-lg-5">
                        <!-- Student Card HTML structure -->
                        <div class="card">
                            <div class="card-header d-flex flex-column gap-2">
                                <div class="pic mb-2">
                                    <img src="../student/uploads/<?php echo $student_photo; ?>">

                              <div class="dropdown" >
                                  <button class="btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                    <!-- Three dots icon, you can use your own or a Unicode character like &#8942; for vertical ellipsis -->
                                    &#8942;
                                  </button>

                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      
                                      <form action="process_unassign_students.php" method="POST" onsubmit="return confirm('Are you sure you want to unassign this student?');">
                                        <input type="hidden" name="student_id" value="<?php echo $row['studentid']; ?>">
                                        <input type="submit" name="unassign_student" class="dropdown-item" value="Unassigned" >
                                    </form>
                                    
                                  </div>
                                </div>   
                                </div>
                            </div>
                            <div class="card-body">
                                <p>First Name: <?php echo $row['fname']; ?></p>
                                <p>Last Name: <?php echo $row['lname']; ?></p>
                                <p>Department: <?php echo $row['department']; ?></p>
                                <p>Student ID: <?php echo $row['studentid']; ?></p>
                                <p>Email: <?php echo $row['email']; ?></p>
                                
                                <div class="time">
                                    TOTAL DUTY:
                                    <b>
                                        <?php
                                        $sum = mysqli_query($conn, "SELECT SUM(total_hours) as total FROM attendance WHERE student_id = '$studentID'");
                                        $total_hours = mysqli_fetch_assoc($sum)['total'];
                                        echo $total_hours ? $total_hours . " Hours" : "0 Hours";
                                        ?>
                                    </b>                    
                                </div>
                                <!-- Button to unassign student -->
                      
                            </div>
                        </div>
                    </div>
                  <?php
                }
              }
            }      
           ?>
            </div>
        </div>
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
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
            <select name="student_id" class="form-control" style="border:1px solid black;">
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

