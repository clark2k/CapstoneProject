<?php
include "../conn.php";

$del_id = $_GET['del_id'];

// Delete related records in the `photo` table
$delete_photos = mysqli_query($conn, "DELETE FROM photo WHERE student_id = '$del_id'");

// Then delete the student record
$delete_student = mysqli_query($conn, "DELETE FROM student WHERE id = '$del_id'");

if ($delete_student && $delete_photos) {
    ?>
    <script>
        alert("Account Deleted");
        window.location.href="studentrecords.php";
    </script>
    <?php
} else {
    ?>
    <script>
        alert("No Account Deleted");
        window.location.href="studentrecords.php";
    </script>
    <?php
}
?>
