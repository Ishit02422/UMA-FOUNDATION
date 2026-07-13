<?php
include "connect.php";


    // Get the POST data
    $id =$_POST['id'];
    $name =  $_POST['name'];
    $uname =$_POST['uname'];
    $email =$_POST['email'];
    $cno = $_POST['cno'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $city = $_POST['city'];

    // Check for empty values and handle validation
   

    // Update the user in the database
    $query = "UPDATE tbl_user SET 
              name = '$name',
              username = '$uname',
              email = '$email',
              contactno = '$cno',
              gender = '$gender',
              dob = '$dob',
              address = '$address',
              cityid = '$city'
              WHERE id = '$id'";

echo (mysqli_query($con, $query)) ;

  

?>
