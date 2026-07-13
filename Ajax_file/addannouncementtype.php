<?php
session_start();


include "../connect.php";

if (isset($_POST['status']) && isset($_POST['type_name'])) {
    
    $announcement_status = $_POST['status'];
    $announcementtype_name = $_POST['type_name'];

  
    $sql = "insert into tbl_announcement_type (status,type_name) values ('$announcement_status', '$announcementtype_name')";


    if (mysqli_query($con, $sql)) {
        header("Location: ../Admin/pages/tables/showannouncementtype.php");
        exit;
    } else {
        echo "Error inserting record: " . mysqli_error($con);
    }
    
} else {
    echo "Required fields are missing.";
}
?>



