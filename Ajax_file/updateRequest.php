<?php
include "../connect.php";
session_start();

$uid = $_POST['uid'];
$role = $_POST['role'];

if ($role == "cMajor") {
    $table = "tbl_community_major_request";
} else {
    $table = "tbl_community_member_request";
}

$query = "UPDATE $table SET status = 2 WHERE uid = $uid";
if (mysqli_query($con, $query)) {

    $userRole = ($role == "cMajor") ? 'cMajor' : 'cMember';
    $queryRole = "UPDATE tbl_user SET role = '$userRole' WHERE id = $uid";
    
    if (mysqli_query($con, $queryRole)) {
        echo "Request accepted and role updated to $userRole.";
    } else {
        echo "Error updating user role: " . mysqli_error($con);
    }
} else {
    echo "Error accepting request: " . mysqli_error($con);
}
?>
