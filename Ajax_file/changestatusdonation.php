<?php 
session_start();
    include '../connect.php';

    $status=$_POST["status"];
    $id=$_POST["id"];
    $query="update tbl_donation set status=".$status." where id=".$id."";
    $q = mysqli_query($con,$query);
    if($q){
        echo true;
    }

?>