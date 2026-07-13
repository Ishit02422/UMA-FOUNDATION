<?php
session_start();
include "../connect.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_FILES["image"])) {
    echo "no_data"; exit;
}

$allowTypes = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'GIF', 'PNG', 'JPEG');
$filename = $_FILES["image"]["name"];
$tempname = $_FILES["image"]["tmp_name"];
// Dynamic path - works regardless of folder name
$upload_dir = dirname(__DIR__) . "/image/";
if (!is_dir($upload_dir)) {
    @mkdir($upload_dir, 0777, true);
} else {
    @chmod($upload_dir, 0777);
}
$folder = $upload_dir . $filename;
@move_uploaded_file($tempname, $folder);

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
