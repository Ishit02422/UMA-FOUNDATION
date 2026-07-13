<?php 
session_start();
include '../connect.php';

$status = $_POST["status"];
$id = $_POST["id"];
$query = "UPDATE tbl_user SET status = " . $status . " WHERE id = " . $id;
$q = mysqli_query($con, $query);
if($q){
    echo true;
}
?>
