<?php
session_start();
$host = "gateway01.ap-southeast-1.prod.aws.tidbcloud.com";
$user = "y3exJBsV1ruN9mw.root";
$pass_db = "Ip3OFyXAqV7huuR8";
$dbname = "test";
$port = 4000;
$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
mysqli_real_connect($conn, $host, $user, $pass_db, $dbname, $port, NULL, MYSQLI_CLIENT_SSL);

if (!$conn) {
    die("Error: " . mysqli_connect_error());
}

$name    = mysqli_real_escape_string($conn, $_POST["name"]);
$uname   = mysqli_real_escape_string($conn, $_POST["uname"]);
$dob     = mysqli_real_escape_string($conn, $_POST["dob"]);
$contect = mysqli_real_escape_string($conn, $_POST["cno"]);
$address = mysqli_real_escape_string($conn, $_POST["address"]);
$city    = intval($_POST["city"]);
$email   = mysqli_real_escape_string($conn, $_POST["email"]);
$pass    = $_POST["password"];
$role    = "Not Verified";

// Convert gender string to tinyint (gender column is tinyint in DB)
$genderStr = strtolower(trim($_POST["gender"]));
if ($genderStr === 'male') {
    $gender = 1;
} elseif ($genderStr === 'female') {
    $gender = 2;
} else {
    $gender = 3; // Other
}

// Check if user exists
$check = mysqli_query($conn, "SELECT id FROM tbl_user WHERE Email='$email' LIMIT 1");
if ($check && mysqli_num_rows($check) > 0) {
    echo "user exists";
    exit();
}

// Handle file upload
$allowTypes = array('pdf');
$filename = $_FILES["file"]["name"];
$tempname = $_FILES["file"]["tmp_name"];
$fileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

if (!in_array($fileType, $allowTypes)) {
    echo 'Please Upload only PDF file for Certificate!';
    exit();
}

$safeFilename = time() . '_' . basename($filename);
$folder = 'certificate/' . $safeFilename;
@move_uploaded_file($tempname, '/tmp/' . $safeFilename);

// Insert using prepared statement
$stmt = mysqli_prepare($conn, "INSERT INTO tbl_user (name, username, gender, dob, contactno, address, email, password, caste_certificate, status, role, cityid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$hashed = md5($pass);
$status = 1; // Active by default
mysqli_stmt_bind_param($stmt, "ssissssssisi", $name, $uname, $gender, $dob, $contect, $address, $email, $hashed, $folder, $status, $role, $city);


if (mysqli_stmt_execute($stmt)) {
    $result = mysqli_query($conn, "SELECT id FROM tbl_user WHERE email='$email'");
    $row = mysqli_fetch_assoc($result);
    $_SESSION["id"] = $row["id"];
    $_SESSION["email"] = $email;
    echo true;
} else {
    echo "DB Error: " . mysqli_stmt_error($stmt);
}
mysqli_stmt_close($stmt);
?>
