<?php
session_start(); // Start the session if not started already
include "../conn.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are set
    if (isset($_POST['student_id'])) {
        // Fetch student ID from the form
        $student_id = $_POST['student_id'];

        // Validate input (you can add more validation if needed)
        if (empty($student_id)) {
            echo "Student ID is required.";
            exit();
        }

        // Check if the student exists in the database
        $checkStudentQuery = mysqli_query($conn, "SELECT * FROM student WHERE studentid = '$student_id'");
        if (mysqli_num_rows($checkStudentQuery) == 0) {
            echo "Student with ID $student_id does not exist.";
            exit();
        }

        // Retrieve teacher information from session
        $teacher_department = $_SESSION['teacher_department'];
        $teacher_email = $_SESSION['teacher_email'];

        // Assign the student to the teacher
        $assignStudentQuery = mysqli_query($conn, "UPDATE student SET assigned_teacher_department = '$teacher_department', assigned_teacher_email = '$teacher_email' WHERE studentid = '$student_id'");
        if ($assignStudentQuery) {
            ?>
            <script>
                alert("Student has been successfully assigned");
                window.location.href = "dashboard.php";
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Error assigning student to teacher");
                window.location.href = "dashboard.php";
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert("Student ID is required!");
            window.location.href = "dashboard.php";
        </script>
        <?php
    }
}
?>