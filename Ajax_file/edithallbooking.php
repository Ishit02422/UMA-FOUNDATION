<?php
session_start();


include "../connect.php";

$start_date_time = $_POST['start_date_time'];
$id = $_POST['id'];
$end_date_time = $_POST['end_date_time'];
$request_date = $_POST['request_date'];
$payment_date = $_POST['payment_date'];
$hall_id=$_POST['hall_id'];

$sql="";

    $sql = "update tbl_hall_booking set hall_id='$hall_id', start_date_time='$start_date_time' ,end_date_time='$end_date_time',request_date='$request_date',payment_date='$payment_date' where id='$id'";


    if (mysqli_query($con, $sql)) {
        echo true;
    } else {
        echo "Error inserting record: " . mysqli_error($con);
    }

?>
