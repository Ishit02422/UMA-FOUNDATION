<?php
session_start();
include "../connect.php";

// Only process if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "no_data"; exit;
}

$title            = mysqli_real_escape_string($con, $_POST['title'] ?? '');
$description      = mysqli_real_escape_string($con, $_POST['description'] ?? '');
$declaration_date = mysqli_real_escape_string($con, $_POST['declaration_date'] ?? date('Y-m-d'));
$from_date        = mysqli_real_escape_string($con, $_POST['from_date'] ?? date('Y-m-d'));
$to_date          = mysqli_real_escape_string($con, $_POST['to_date'] ?? date('Y-m-d'));
$type_id          = (int)($_POST['type_id'] ?? 1);
$form             = mysqli_real_escape_string($con, $_POST['form'] ?? '');
$imagePath        = '';

// Handle optional image upload
if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
    $allowTypes = array('jpg', 'jpeg', 'png', 'gif', 'JPG', 'GIF', 'PNG', 'JPEG');
    $filename   = basename($_FILES["image"]["name"]);
    $fileType   = pathinfo($filename, PATHINFO_EXTENSION);

    if (in_array($fileType, $allowTypes)) {
        $upload_dir = dirname(__DIR__) . "/image/";
        if (!is_dir($upload_dir)) {
            @mkdir($upload_dir, 0777, true);
        } else {
            @chmod($upload_dir, 0777);
        }
        $folder = $upload_dir . $filename;
        if (@move_uploaded_file($_FILES["image"]["tmp_name"], $folder)) {
            $imagePath = "image/" . $filename;
        }
    }
}

$sql = "INSERT INTO tbl_announcement (title, type_id, description, declaration_date, from_date, to_date, form, image, status)
        VALUES ('$title', '$type_id', '$description', '$declaration_date', '$from_date', '$to_date', '$form', '$imagePath', 1)";

if (mysqli_query($con, $sql)) {
    header("Location: ../Admin/pages/tables/showannouncement.php");
    exit;
} else {
    echo "Error: " . mysqli_error($con);
}
?>