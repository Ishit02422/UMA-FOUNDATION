<?php 

include "../connect.php";
session_start();
$query="update tbl_user set role='Member' where id=".$_SESSION["id"];
echo mysqli_query($con,$query);

?>