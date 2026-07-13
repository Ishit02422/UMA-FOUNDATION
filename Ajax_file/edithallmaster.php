<?php
session_start();


include "../connect.php";



$id = $_POST['id'];
$name = $_POST['name'];
$capacity = $_POST['capacity'];
$address = $_POST['address'];
$rent = $_POST['rent'];



$sql="";
if(!isset($_POST["image"]))
{
    $sql = "update tbl_hall_master set name='$name',capacity='$capacity' ,address='$address' , rent='$rent'  where id='$id'";
}
else
{
    $sql = "update tbl_hall_master set name='$name',capacity='$capacity' ,image='".$_POST["image"]."',address='$address' , rent='$rent'  where id='$id'";
}



if (mysqli_query($con, $sql)) {
    echo true;
} else {
    echo "Error inserting record: " . mysqli_error($con);
}
?>
