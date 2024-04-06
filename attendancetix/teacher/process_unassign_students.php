<?php
// ../process.php

session_start();
include "../conn.php";

// Check if the teacher is logged in
if (!isset($_SESSION['teacher_email'])) {
    // Redirect to the login page if not logged in
    header("Location: index.php");
    exit();
}

// Check if the form to unassign student is submitted
if (isset($_POST['unassign_student'])) {
    // Get the student ID from the form submission
    $student_id = $_POST['student_id'];

    // Get the logged-in teacher's email
    $teacher_email = $_SESSION['teacher_email'];

    // Query to unassign the student from the teacher
    $unassign_query = "UPDATE student SET assigned_teacher_department = NULL, assigned_teacher_email = NULL WHERE studentid = '$student_id' AND assigned_teacher_email = '$teacher_email'";

    // Execute the query
    $result = mysqli_query($conn, $unassign_query);

    if ($result) {
        // Student successfully unassigned
        header("Location: dashboard.php");
        exit();
    } else {
        // Error occurred
        echo "Error: " . mysqli_error($conn);
    }
}
?>
