<?php 
$email=$_POST["email"];
include "../connect.php";
session_start();
$query="update  tbl_user set password='".md5($_POST["password"])."' where email='".$email."'";
if(mysqli_query($con,$query)==true)
{
    echo true;
    session_destroy();
}
?>