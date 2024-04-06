<?php
    session_start();
    include "conn.php";
    date_default_timezone_set("Asia/Hong_Kong");


    if(isset($_POST['student_login'])){
        $student_id = $_POST['login_id'];
        $student_password = $_POST['login_password'];
        
        // Query to fetch student details based on student ID and password
        $student_query = "SELECT * FROM `student` WHERE `studentid` = '$student_id' AND `password` = '$student_password'";
        $student_result = mysqli_query($conn, $student_query);
    
        if ($student_result) {
            if(mysqli_num_rows($student_result) > 0){
                $row_data = mysqli_fetch_assoc($student_result);
             
                // Set session variables
                $_SESSION['session_id'] = $row_data['id'];
                $_SESSION['studentid'] = $row_data['studentid'];
            
                // Redirect to the student dashboard
                 header("Location: student/studentdashboard.php");
                 exit();
            } else {
                // Handle incorrect login credentials
                $_SESSION['student_log'] = "Incorrect Student ID or Password";
            }
        } else {
            // Handle query execution error
            $_SESSION['student_log'] = "Error executing student query: " . mysqli_error($conn);
        }
        // Redirect to the login page after handling the error or incorrect credentials
         header("Location: ../index.php");
         exit();
    }

//////////////////////////////////---------ADMIN  PROCESS-----/////////////////////////////////////////////////////////////////////////////////////
    
if (isset($_POST['admin_login'])) {
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];

    // Query to fetch admin details based on email and password
    $check_admin = mysqli_query($conn, "SELECT * FROM admin WHERE email='$admin_email' AND password='$admin_password'");
    $admin = mysqli_fetch_assoc($check_admin);

    if ($admin) {
        // Set admin session variable
        $_SESSION['admin'] = $admin['email'];

        // Redirect to the admin home page
        header("Location: admin/adminhome.php");
        exit();
    } else {
        $_SESSION['admin_login_error'] = "Incorrect Email or Password";
        header("Location: index.php");
        exit();
    }
}

//////////////////////////////////---------ADMIN LOU-OUT  PROCESS-----/////////////////////////////////////////////////////////////////////////////////////
    if(isset($_POST['logout'])){
        session_destroy();
       
        ?>
            <script>
               
                window.location.href="index.php";
            </script>
         <?php
    }
   
//////////////////////////////////---------DEPARTMENT LOGIN PROCESS-----/////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['department_login'])) {
    $department_email = $_POST['department_email'];
    $department_password = $_POST['department_password'];

    // Query to fetch department details based on email and password
    $check_department = mysqli_query($conn, "SELECT * FROM department WHERE email='$department_email' AND password='$department_password'");
    $department = mysqli_fetch_assoc($check_department);

    if ($department) {
        // Set department session variable
        $_SESSION['department'] = $department['department'];

        // Redirect to the dashboard.php
        header("Location: department/dashboard.php");
        exit();
    } else {
        $_SESSION['department_login_error'] = "Incorrect Email or Password";
        header("Location: index.php");
        exit();
    }
}

 //////////////////////////////////---------DEPARTMENT LOGOUT PROCESS-----/////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

///////////////////////////////////---------DEPATMENT REGISTRATION PROCESS-----/////////////////////////////////////////////////////////////////////////////////////
    if(isset($_POST['dep_reg_button'])){
        $department_name = $_POST['department_name'];
        $email = $_POST['department_email'];
        $password = $_POST['department_password'];
     
 /////////////////////////////////////---------VALIDATION OF DEPARTMENT  PROCESS-----/////////////////////////////////////////////////////////////////////////////////////
        $validate_email = mysqli_query($conn, "SELECT * FROM `department` WHERE `email` = '$email'");
        $count_email = mysqli_num_rows($validate_email);

        if($count_email == 0){
            $insert = mysqli_query($conn, "INSERT INTO `department` (`email`, `password`, `department`) VALUES ('$email', '$password', '$department_name')");
            if($insert){
                echo "<script>alert('Department Registration Successful!');window.location.href='index.php';</script>";
            }else{
                echo "<script>alert('Error in Department Registration');window.location.href='index.php';</script>";
            }
        }else{
            echo "<script>alert('Email already exists');window.location.href='index.php';</script>";
        }
    }

        //////////////////////////////////---------DEPARTMENT LOG-OUT PROCESS-----/////////////////////////////////////////////////////////////////////////////////////
    if(isset($_POST['logout'])){
        session_destroy();
        ?>
        <script>
            window.location.href="index.php";
        </script>
        <?php
    }

   
//////////////////////////////////---------STUDENT REGISTRATION PROCESS-----/////////////////////////////////////////////////////////////////////////////////////
    if(isset($_POST['reg_button'])){

        $fname=$_POST["fname"];
        $lname=$_POST['lname'];
        $department=$_POST['department'];
        $password=$_POST["password"];
        $student_id=$_POST['id'];
        $email=$_POST["email"];
     
///////////////////////////////////////////////////----VALIDATION--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $validate_student_id = mysqli_query($conn, "SELECT * FROM `student` WHERE `studentid` = '$student_id' ");
        $count_student_id = mysqli_num_rows($validate_student_id);

        $validate_email = mysqli_query($conn, "SELECT * FROM `student` WHERE `email` = '$email' ");
        $count_email = mysqli_num_rows($validate_email);

        if($count_student_id == 0){
            if($count_email == 0){
                $insert = mysqli_query($conn, "INSERT INTO `student` 
            (`fname`, `lname`, `department`, `studentid`, `email`, `password`) 
            VALUES ('$fname', '$lname', '$department', '$student_id', '$email', '$password')");


                if($insert){
                    ?>
                    <script>
                        alert("Your Registration was Successful!");
                        window.location.href="index.php"
                    </script>
                    <?php
                }else{
                    $_SESSION['student_log'] = "Registration Failed"; 

                    ?>
                    <script>
                        window.location.href = "index.php";
                    </script>
                    <?php
                }
            }else{
                $_SESSION['student_log'] = "Email already exist"; 

                ?>
                <script>
                    window.location.href = "index.php";
                </script>
                <?php
            }
        }else{
            $_SESSION['student_log'] = "ID number already exist"; 
            ?>
            <script>
                window.location.href = "index.php";
            </script>
            <?php
        }
        
    } 



//////////////////////////////////////STUDENT LOG-IN PROCESS///////////////////////////////////////////
if(isset($_POST['student_login2'])){
    session_start();
    echo $student_id = $_POST['login_id'];
    echo $student_password = $_POST['login_password'];
    
    // Query to fetch student details based on student ID and password
    $student_query = "SELECT * FROM `student` WHERE `studentid` = '$student_id' AND `password` = '$student_password'";
    $student_result = mysqli_query($conn, $student_query);

    if ($student_result) {
        if(mysqli_num_rows($student_result) > 0){
            $row_data = mysqli_fetch_assoc($student_result);
            print_r($row_data);
            // Set session variables
            $_SESSION['session_id'] = $row_data['id'];
            $_SESSION['studentid'] = $row_data['studentid'];
        
            // Redirect to the student dashboard
            // header("Location: student/studentdashboard.php");
            // exit();
        } else {
            // Handle incorrect login credentials
            $_SESSION['student_log'] = "Incorrect Student ID or Password";
        }
    } else {
        // Handle query execution error
        $_SESSION['student_log'] = "Error executing student query: " . mysqli_error($conn);
    }
    // Redirect to the login page after handling the error or incorrect credentials
    // header("Location: ../index.php");
    // exit();
}




//////////////////////////////////---------THIS IS FOR ATTENDANCE PROCESS-----/////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////--------- TIME-IN PROCESS-----/////////////////////////////////////////////////////////////////////////////////////
   if(isset($_POST['time_in'])){

     $student_id = $_POST['student_id'];
     $datetoday = date("M d, Y");
     $timetoday = date("h:i A");
    

     $check=mysqli_query($conn, "SELECT * FROM student WHERE studentid='$student_id'");

     $num = mysqli_num_rows($check);

     if($num >=1){
       
       mysqli_query($conn, "INSERT INTO attendance (`student_id`, `date_recorded`, `time_in`, `time_out`) values
                                                    ('$student_id',  '$datetoday',  '$timetoday', 0)");

                 ?>
                     <script>
                      alert("Time-In");
                      window.location.href="index.php"
                     </script>
                 <?php
     }else{
        $_SESSION['student_log'] = "ID number didn't exist";  

                 ?>
                     <script>
                      window.location.href="index.php"
                     </script>
                 <?php
     }      
 
   }

    ///////////////////////////////////////////////////////////////TIME-OUT PROCESS//////////////////////////////////////////////////////////
   
    
if(isset($_POST['time_out'])){

    $student_id = $_POST['student_id'];
    $datetoday = date("M d, Y");
    $timetoday = date("h:i A");
    $report = isset($_POST['report']) ? $_POST['report'] : ''; // Get the report if provided

    // Check if the student has already timed in
  $sqlSelect = mysqli_query($conn, "SELECT * FROM attendance WHERE student_id = '$student_id' AND date_recorded = '$datetoday' AND time_out = '0'");
    $numRows = mysqli_num_rows($sqlSelect);
    
    if($numRows > 0) { // Student has timed in
        $attendanceRow = mysqli_fetch_assoc($sqlSelect); // Fetch the attendance record
        $time_in = $attendanceRow['time_in']; // Get the time in from the attendance record
        $timeIn = date("H:i:s", strtotime($time_in));
        $out = date("H:i:s", strtotime($timetoday));
        $compute = (minutes($out) - minutes($timeIn)) / 60;
        $result = round($compute, 1);

        $name = mysqli_query($conn, "SELECT * FROM `student` WHERE `studentid` = '$student_id'");

        if($fetch_name = mysqli_fetch_assoc($name)){
            $fname = $fetch_name['fname'];
            $lname = $fetch_name['lname'];

            if($result >= 9){
                $final = $result - 1.5;
            }
            elseif($result >= 10){
                $final = $result - 2;
            }
            else{
                $final = $result;
            }
        
            // Update the attendance record with time-out and total hours
            $update = mysqli_query($conn, "UPDATE attendance SET time_out ='$timetoday', total_hours ='$final' WHERE student_id = '$student_id' AND time_out='0' AND date_recorded = '$datetoday'");
        
            // Insert the report into the reports table
            if($update) {
                mysqli_query($conn, "INSERT INTO reports (`fname`, `lname`, `student_id`, `report`, `timestamp`) VALUES ('$fname', '$lname','$student_id', '$report', CURRENT_TIMESTAMP)");
                ?>
                <script>
                    alert("Time-Out");
                    window.location.href="index.php" 
                </script>
                <?php
            } else {
                header("");
            }
        }

        
    } else { // Student has not timed in
        $_SESSION['student_log'] = "Please time in before timing out"; 
        ?>
        <script>
            window.location.href="index.php"
        </script>
        <?php
    }
    }
    
    function minutes($time){
    $time = explode(':', $time);
    return ($time[0]*60) + ($time[1]) + ($time[2]/60);
    }



///////////////////////////////////////////////////////////STUDENT PROFILE PROCESS///////////////////////////////////////////////////////////
        if(isset($_POST['sbmtpic'])){
            if(isset($_SESSION['session_id'])){
                $loggedInID = $_SESSION['session_id'];

                
                $pic = $_FILES['file']['name'];
                $tmppic = $_FILES['file']['tmp_name'];
                $size = $_FILES['file']['size'];

                $old_photo = mysqli_query($conn, "SELECT `picture` FROM `photo` WHERE `student_id` = '$loggedInID'");
                $fetch_oldPhoto = mysqli_fetch_assoc($old_photo);

                if ($fetch_oldPhoto) {
                    $student_oldPhoto = $fetch_oldPhoto['picture'];
                    if (file_exists($student_oldPhoto)) {
                        unlink($student_oldPhoto);
                    }
                    $destination = "student/uploads/" . $pic;
                
                    $update_pic = mysqli_query($conn, "UPDATE `photo` SET `picture` = '$pic' WHERE `student_id` = $loggedInID");
                } else {
                    $pic_newName = $loggedInID . '_' . $pic; // Removed $destination here
                    $destination = "student/uploads/" . $pic_newName; // Define $destination here
                    $insert_pic = mysqli_query($conn, "INSERT INTO `photo` VALUES('0','$loggedInID','$pic_newName')");
                }
                
                if ($size < 10000000) {
                    if (move_uploaded_file($tmppic, $destination)) {
                        ?>
                        <script>
                            window.location.href="student/studentprofile.php";
                        </script>
                    <?php
                    } else {
                        ?>
                        <script>
                             alert("Picture Error!");
                            window.location.href="student/studentprofile.php";
                        </script>
                    <?php
                    }
                } else {
                    ?>
                        <script>
                             alert("Picture is too big!");
                            window.location.href="student/studentprofile.php";
                        </script>
                    <?php
                }
            }
        }

///////////////////ENABLE DISABLE FORM HERE

        //FOR ENABLE FORM
        if(isset($_POST['enable'])){
            if(isset($_SESSION['teacher_department'])){
                $dept = $_SESSION['teacher_department'];

                $select = mysqli_query($conn, "SELECT * FROM `attendanceform` WHERE `teacher_department` = '$dept'");

                if(mysqli_num_rows($select) == 1){
                    $fetch = mysqli_fetch_assoc($select);

                    if($action = $fetch['action'] == FALSE){
                        $update = mysqli_query($conn, "UPDATE `attendanceform` SET `action` = TRUE WHERE `teacher_department` = '$dept'");

                        ?>
                        <script>
                            window.location.href="teacher/studentrecords.php";
                        </script>
                    <?php
                    }else{
                        ?>
                        <script>
                            window.location.href="teacher/studentrecords.php";
                        </script>
                    <?php
                    }
                }else{
                    $insert = mysqli_query($conn, "INSERT INTO `attendanceform` VALUES ('0','$dept','TRUE')")

                    ?>
                    <script>
                        window.location.href="teacher/studentrecords.php";
                    </script>
                <?php
                }
            }
        }
        //FOR DISABLE FORM
        if(isset($_POST['disable'])){
            if(isset($_SESSION['teacher_department'])){
                $dept = $_SESSION['teacher_department'];

                $select = mysqli_query($conn, "SELECT * FROM `attendanceform` WHERE `teacher_department` = '$dept'");

                if(mysqli_num_rows($select) == 1){
                    $fetch = mysqli_fetch_assoc($select);

                    if($action = $fetch['action'] == TRUE){
                        $update = mysqli_query($conn, "UPDATE `attendanceform` SET `action` = FALSE WHERE `teacher_department` = '$dept'");

               
                        ?>
                            <script>
                                window.location.href="teacher/studentrecords.php";
                            </script>
                        <?php
                    }else{
                        
                    ?>
                        <script>
                            window.location.href="teacher/studentrecords.php";
                        </script>
                     <?php
                    }
                }else{
                    $insert = mysqli_query($conn, "INSERT INTO `attendanceform` VALUES ('0','$dept','TRUE')")

                    
                    ?>
                    <script>;
                        window.location.href="teacher/studentrecords.php";
                    </script>
                    <?php
                                
                }
            }
        }


//////////////////////////////////////TEACHER REGISTRATION PROCESS/////////////////////////////////
if (isset($_POST['teacher_reg_button'])) {

    // Retrieve form data
    $teacher_fname = $_POST['teacher_fname'];
    $teacher_lname = $_POST['teacher_lname'];
    $teacher_department = $_POST['teacher_department'];
    $teacher_email = $_POST['teacher_email'];
    $teacher_pass = $_POST['teacher_pass'];

     // Validation
     $validate_email = mysqli_query($conn, "SELECT * FROM `teachers` WHERE `teacher_email` = '$teacher_email'");
     $count_email = mysqli_num_rows($validate_email);
 
     if($count_email == 0){
         $insert = mysqli_query($conn, "INSERT INTO `teachers` 
                     (`teacher_fname`, `teacher_lname`, `teacher_department`, `teacher_email`, `teacher_pass`) 
                     VALUES ('$teacher_fname', '$teacher_lname', '$teacher_department', '$teacher_email', '$teacher_pass')");
 
         if($insert){
             ?>
             <script>
                 alert("Teacher registration successful!");
                 window.location.href = "department/dashboard.php";
             </script>
             <?php
         } else {
             ?>
             <script>
                 alert("Teacher registration failed!");
                 window.location.href = "department/dashboard.php";
             </script>
             <?php
         }
     } else {
         ?>
         <script>
             alert("Email already exists!");
             window.location.href = "department/dashboard.php";
         </script>
         <?php
     }
 }

////////////////////////////////////////TEACHER LOGIN////////////////////////////////////////

if (isset($_POST['teacher_login'])) {
    if (!empty($_POST['teacher_email']) && !empty($_POST['teacher_password'])) {
        // Teacher login
        $teacher_email = $_POST['teacher_email'];
        $teacher_password = $_POST['teacher_password'];

        $query = "SELECT * FROM teachers WHERE teacher_email='$teacher_email' AND teacher_pass='$teacher_password'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            // Teacher login successful

            // Retrieve department from the database
            $teacher_data = mysqli_fetch_assoc($result);
            $departmentValue = $teacher_data['teacher_department'];

            // Store teacher email and department in session
            $_SESSION['teacher_email'] = $teacher_email;
            $_SESSION['teacher_department'] = $departmentValue;

            header("Location: teacher/dashboard.php"); // Redirect to teacher dashboard
            exit();
        } else {
            // Teacher login failed
            $_SESSION['teacher_login_error'] = "Invalid email or password";
            header("Location: index.php"); // Redirect back to login page
            exit();
        }
    } else {
        $_SESSION['login_error'] = "Please fill in all fields";
        header("Location: index.php"); // Redirect back to login page
        exit();
    }
}


//////////////////////////////////////THIS IS FOR UPDATE ACCOUNT IN DEPAETMENT/////////////////////////////////
       
    ?>
    
    
  
   
