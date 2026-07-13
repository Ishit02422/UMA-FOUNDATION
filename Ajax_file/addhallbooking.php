<?php
session_start();
include "../connect.php";


  
    $sql = "insert into tbl_hall_booking (uid,hall_id,status,start_date_time,end_date_time,request_date,transaction_id,payment_date) values ('".$_SESSION["id"]."','".$_POST["hall_id"]."',1,'".$_POST["start_date_time"]."','".$_POST["end_date_time"]."','".$_POST["request_date"]."','".$_POST["transaction_id"]."','".$_POST["payment_date"]."')";


    if (mysqli_query($con, $sql)) {
        echo true;
    } else {
        echo "Error inserting record: " . mysqli_error($con);
    }

?>
