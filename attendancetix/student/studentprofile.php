<?php 
include '../conn.php';
include "../process.php";

if(isset($_SESSION['session_id'])){
  $loggedInID = $_SESSION['session_id'];

  $check_students = mysqli_query($conn, "SELECT * FROM `student` WHERE `id` = '$loggedInID'");
  $fetch_students = mysqli_fetch_assoc($check_students);

  if(!empty($fetch_students)){
    $session_studentname = $fetch_students['fname']." ".$fetch_students['lname'];
    $studentID = $fetch_students['studentid'];
  }

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Student Profile</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
   <!-- Favicons -->
  <link href="assets/img/UI.png" rel="icon">
  <link href="assets/img/UI-icon.png" rel="apple-touch-icon">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->

</head>

<style>
.card{
  width: 60rem;
  height:15rem  ;
  max-height: 100%;
  top:17px;
  left:15px;
  margin-bottom:60px;
}
.card-body{
  position: relative;
  border: 2px solid #003300;
  max-width: 100%;
  max-height: 100%;
  height: 100%;
  font-weight:bold;
}

.card .card-header{
  height:8rem;
  padding:5px 0;
  background-color:#003300;
  display:flex;
  justify-content:space-between;

}
.card .card-header .pic{
  margin:10px 10px 0px 10px;

}
.card .card-header .pic img{
  height:3.8rem;
  width: 5rem;
  border-radius: 50%;
  overflow: hidden;
  border:2px solid white;
}

.card .card-header .d-flex input{
  border:1px solid white;
  margin-left:5px;
  color:black;
  background-color:white;
}

.card .time{
  border-radius:1px;
  font-size:14px;
  margin-left:60%;
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
  margin:5px 0px 0px 100px;
  
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

/* Adjustments for mobile view */
@media (max-width: 768px) {
  .card {
    width: auto; /* Adjust width for responsiveness */
    height: auto; /* Adjust height for responsiveness */
    margin-bottom: 30px; /* Adjust margin for spacing */
  }

  .card .card-header {
    height: auto; /* Adjust height for responsiveness */
    flex-direction: column; /* Stack items vertically */
    align-items: center; /* Center items horizontally */
  }

  .card .card-header .dropdown {
    margin: 0; /* Remove left margin */
    position: static; /* Reset position */
  }

  .card .card-header .dropdown button {
    margin: 0px 0px 0px 430px; /* Adjust margin for spacing */
  }

  .card .card-header .pic img {
    height: auto; /* Adjust height for responsiveness */
    width: 95%; /* Adjust width for responsiveness */
    border-radius: 1%; /* Make image circular */
    margin-left:15px;
  }

  .card .card-body {
    font-size: 14px; /* Adjust font size for readability */
  }

  .card .time {
    margin-left: 50px; /* Reset margin */
    text-align: center; /* Center align text */
  }
}

</style>
<body>
  
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center"  style="background-color:#003300;">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100" style="background-color:#003300;">  
          <a class="navbar-brand brand-logo" href="adminhome.php" style="color:white; background-color:#003300;">Dashboard</a>
          <a class="navbar-brand brand-logo-mini" href="adminhome.php"><img src="images/UI-icon.png" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-view-headline"  style="color:white;"></span>
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
              <span class="nav-profile-name" style="color:white;"><?php echo $session_studentname; ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown" >
              
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
              <a class="nav-link" href="studentdashboard.php">
                  <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Student Record</span>
              </a>
          </li>

          <li class="nav-item">
              <a class="nav-link"  href="studentprofile.php">
                  <i class="mdi mdi-account-multiple menu-icon" style="border:2px solid white; color:white;"></i>
                <span class="menu-title text-white">Student Profile</span>
              </a>
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
                   
                    <!--Student Profile Of student------------------------------------>
                    <?php

                        $select_student = mysqli_query($conn, "SELECT * FROM `student` WHERE `id` = '$loggedInID'");
                    
                        while($fetch_student = mysqli_fetch_assoc($select_student)){

                          $select_photo = mysqli_query($conn, "SELECT * FROM `photo` WHERE `student_id` = '$loggedInID'");
                          $fetch_photo = mysqli_fetch_assoc($select_photo);

                         

                          if($fetch_photo){
                            $student_photo = $fetch_photo['picture'];
                            
                          }else{
                            $student_photo = "../images/UI.png";
                          }
                        
                          ?>

                            <div class="card">                                              
                              <div class="card-header d-flex flex-column gap-2">
                               <div class="dropdown">
                                  <button class="btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                      <!-- Three dots icon, you can use your own or a Unicode character like &#8942; for vertical ellipsis -->
                                      &#8942;
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <a class="dropdown-item" href="#" onclick="confirmDelete()">Delete Photo</a>
                                  </div>
                                </div>   

                                  <div class="pic mb-2">
                                    <img src="uploads/<?php echo $student_photo; ?>">
                                  </div>

                                  <form action="../process.php" method="POST" enctype="multipart/form-data">
                                    <div class="d-flex">
                                      <input type="file" name ="file"> 
                                      <input class="" type="submit" name="sbmtpic" value="Upload Photo">
                                    </div>
                                  </form>
                                 </div>

                              <div class="card-body" style="font-weight:bold;">
                                <p>First Name: <?php echo $fetch_student['fname']; ?></p>
                                <p>Last Name: <?php echo $fetch_student['lname']; ?></p>
                                <p>Department: <?php echo $fetch_student['department']; ?></p>
                                <p>Student: <?php echo $fetch_student['studentid']; ?></p>  
                                <p>Email: <?php echo $fetch_student['email']; ?></p>  

                                 <div class="time">
                                    <h4> TOTAL RENDERED TIME: <b>
                                      <?php                      
                                            $sum = mysqli_query($conn,"SELECT SUM(total_hours) as total FROM attendance WHERE student_id = '$studentID'");
                                            while ($total = mysqli_fetch_assoc($sum)){
                                            echo $total['total']." Hours";
                                            }
                                        ?></b>
                                    </h4>
                                 </div>                       
                              </div>
                            </div>

                          
                                    
                          <?php
                        }
                    ?>
                    
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
         
      </div>
   
    </div>

  </div>



  <script src="vendors/base/vendor.bundle.base.js"></script>
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/dashboard.js"></script>
  <script src="js/data-table.js"></script>
  <script src="js/jquery.dataTables.js"></script>
  <script src="js/dataTables.bootstrap4.js"></script>


  <script src="js/jquery.cookie.js" type="text/javascript"></script>
</body>

</html>

<?php

}


?>

