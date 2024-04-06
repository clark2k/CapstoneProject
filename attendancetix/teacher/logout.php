<?php
session_start(); // Start the session

// Unset or destroy the session variables related to the teacher
unset($_SESSION['teacher_email']);

// Destroy the session
session_destroy();

// Redirect to the login page or any desired page
header("Location: ../index.php");
exit();
?>
