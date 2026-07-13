<?php
include "../connect.php";
session_start();

$uid = $_POST['uid'];

$query = "UPDATE tbl_user SET role = 'Member' WHERE id = $uid";
if (mysqli_query($con, $query)) {
    echo "User role updated to Member.";
} else {
    echo "Error updating user role: " . mysqli_error($con);
}
?>
