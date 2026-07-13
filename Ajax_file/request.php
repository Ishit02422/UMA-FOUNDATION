<?php 
include "../connect.php";
session_start();

$requestType = $_POST["request"];
$uid = $_SESSION["id"];

$table = "";
if ($requestType == "cMajor") {
    $table = "tbl_community_major_request";
} elseif ($requestType == "cMember") {
    $table = "tbl_community_member_request";
} else {
    echo "Invalid request type";
    exit(0);
}

$query = "INSERT INTO $table (uid, status) VALUES ('$uid', 1)";
$result = mysqli_query($con, $query);

if ($result) {
    echo "Request submitted successfully.";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
