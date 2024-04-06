<?php
session_start();



include "../conn.php";

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
  margin-left:100px;
  background-color:#003300;
  width:fit-content;
  color:white;
  padding:3px 3px 2px 3px;
 
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
    padding: 5px 50px 5px 5px; /* Adjust padding for smaller screens */
  }

  .icon i {
    margin: -26px 0px 0px 210px; /* Adjust icon position for smaller screens */
  }
}

</style>
<body>
  
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center" style="background-color:#003300;">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100"  style="background-color:#003300;">  
          <a class="navbar-brand brand-logo" hrf="adminhome.php" style="color:white; background-color:#003300;">Admin Dashboard</a>
          <a class="navbar-brand brand-logo-mini" href="adminhome.php"><img src="images/UI-icon.png" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-view-headline" style="color:white;"></span>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end" style="background-color:#003300;">
          <div class = "src">
                  <form action="" method="GET">
                    <input type="text" name="search" value=""<?php if(isset($_GET['search'])){ echo $_GET['search']; } ?> placeholder="Search..."  > 
                  </form>

                <div class="icon">
                  <i class="mdi mdi-magnify menu-icon"></i>
              </div>
          </div>

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
      <nav class="sidebar sidebar-offcanvas">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="adminhome.php">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title" >Dashboard</span>
            </a>
          </li>
         
          <li class="nav-item">
        <a class="nav-link" href="adminstudentrecord.php" >
           <i class="mdi mdi-format-list-bulleted menu-icon" style="border:2px solid white; color:white;">
           </i><span class="menu-title" style="color:white;">Student Record</span>
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

        <div class="content-fluid">
          
          <div class="row ">                 
            <!--Student Form Attendance------------------------------------>
            <?php
              if(!isset($_GET['search'])){
                $query = mysqli_query($conn, "SELECT * FROM student WHERE department IN ('cite', 'registrar', 'clinic', 'csdl', 'marketing')");

                while($row = mysqli_fetch_array($query)){
                  $studentID =$row['studentid'];
                  $id = $row['id'];

                  $select_photo = mysqli_query($conn, "SELECT * FROM `photo` WHERE `student_id` = '$id'");
                  $fetch_photo = mysqli_fetch_assoc($select_photo);

                  if($fetch_photo){
                    $student_photo = $fetch_photo['picture'];
                    
                  }else{
                    $student_photo = "../images/UI.png";
                  }

                  ?>

                    <div class="col-lg-5">
                      <div class="card" >
                                                
                        <div class="card-header d-flex flex-column gap-2">
                          <div class="pic mb-2" >
                            <img src="../student/uploads/<?php echo $student_photo; ?>" >

                            <div class="dropdown" >
                              <button class="btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                <!-- Three dots icon, you can use your own or a Unicode character like &#8942; for vertical ellipsis -->
                                &#8942;
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#" onclick="confirmUpdate()">Update Account</a>
                                <a class="dropdown-item" href="#" onclick="confirmDelete()">Delete Account</a>
                              </div>
                            </div>   
                          </div>   
                        </div>

                        <div class="card-body" >
                          <p>First Name: <?php echo $row['fname']; ?></p>
                          <p>Last Name: <?php echo $row['lname']; ?></p>
                          <p>Department: <?php echo $row['department']; ?></p>
                          <p>Student: <?php echo $row['studentid']; ?></p>  
                          <p>Email: <?php echo $row['email']; ?></p>  

                          <div class="time" >
                            TOTAL RENDERED TIME: 
                            <b>
                              <?php
                                $sum = mysqli_query($conn,"SELECT SUM(total_hours) as total FROM attendance WHERE student_id = '$studentID'");
                                while ($total = mysqli_fetch_assoc($sum)){
                                echo $total['total']." Hours";
                                }
                                ?>
                            </b>    
                          </div>                          
                        </div>
                      </div>
                    </div>
                  <?php
                }
              }else{
                $filter_search = $_GET['search'];
                $admin_search = mysqli_query($conn, "SELECT * FROM `student` WHERE CONCAT(fname, lname) LIKE '%$filter_search%'");

                if(mysqli_num_rows($admin_search) > 0){
                  while($row = mysqli_fetch_array($admin_search)){
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
                        <div class="card" >
                                                  
                          <div class="card-header d-flex flex-column gap-2">
                            <div class="pic mb-2" >
                              <img src="../student/uploads/<?php echo $student_photo; ?>" >

                              <div class="dropdown" >
                                <button class="btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                  <!-- Three dots icon, you can use your own or a Unicode character like &#8942; for vertical ellipsis -->
                                  &#8942;
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="#" onclick="confirmUpdate()">Update Account</a>
                                  <a class="dropdown-item" href="#" onclick="confirmDelete()">Delete Account</a>
                                </div>
                              </div>   
                            </div>   
                          </div>

                          <div class="card-body" >
                            <p>First Name: <?php echo $row['fname']; ?></p>
                            <p>Last Name: <?php echo $row['lname']; ?></p>
                            <p>Department: <?php echo $row['department']; ?></p>
                            <p>Student: <?php echo $row['studentid']; ?></p>  
                            <p>Email: <?php echo $row['email']; ?></p>  

                            <div class="time" >
                              TOTAL RENDERED TIME: 
                              <b>
                                <?php
                                  $sum = mysqli_query($conn,"SELECT SUM(total_hours) as total FROM attendance WHERE student_id = '$studentID'");
                                  while ($total = mysqli_fetch_assoc($sum)){
                                  echo $total['total']." Hours";
                                  }
                                  ?>
                              </b>    
                            </div>                          
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
</body>

</html>

