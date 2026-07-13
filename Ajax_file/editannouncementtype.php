<?php
session_start();


include "../connect.php";

if ( isset($_POST['type_name'])) {
    
    
    $announcementtype_name = $_POST['type_name'];
    $id =$_POST['id'];
    // $status=$_POST['status'];

  
    $sql = "update tbl_announcement_type set type_name='$announcementtype_name'  where id='$id'";


    if (mysqli_query($con, $sql)) {
        echo true;
    } else {
        echo "Error inserting record: " . mysqli_error($con);
    }
    
} else {
    echo "Required fields are missing.";
}
?>