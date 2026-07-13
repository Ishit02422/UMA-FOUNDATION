<?php
session_start();
include "../connect.php";

$allowTypes = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'GIF', 'PNG', 'JPEG');
$filename = $_FILES["image"]["name"];
$tempname = $_FILES["image"]["tmp_name"];
// Dynamic path - works regardless of folder name
$folder = dirname(__DIR__) . "/image/" . $filename;
move_uploaded_file($tempname, $folder);

$fileType = pathinfo($folder, PATHINFO_EXTENSION);

if (in_array($fileType, $allowTypes)) {
    $sql = "insert into tbl_hall_master (name,capacity,image,address,rent,status) values('".$_POST["name"]."','".$_POST["capacity"]."','image/".$filename."','".$_POST["address"]."','".$_POST["rent"]."',1)";

    if (mysqli_query($con, $sql)) {
        echo true;
    } else {
        echo "Error inserting record: " . mysqli_error($con);
    }
}
else
{
    echo "not allowed";
}


?>
