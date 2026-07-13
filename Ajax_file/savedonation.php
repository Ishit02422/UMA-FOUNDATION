<?php
session_start();
include '../connect.php'; // Corrected path to connect.php
if(!isset($_SESSION['id'])){ echo "login_required"; exit; }

$payment_id = mysqli_real_escape_string($con, $_POST['payment_id'] ?? '');
// Using donor_name to match the user's name provided in the form
$donor_name = mysqli_real_escape_string($con, $_POST['donor_name'] ?? 'Unknown');
$doprice    = (float)($_POST['doprice'] ?? 0);
$date       = date('Y-m-d');
$typeid     = isset($_SESSION['typeid']) ? (int)$_SESSION['typeid'] : 0;

$sql = "INSERT INTO tbl_donation (price, name, date, status, transaction_id, typeid)
        VALUES ('$doprice', '$donor_name', '$date', 1, '$payment_id', '$typeid')";

if(mysqli_query($con, $sql)){
    echo "1";
} else {
    echo "error: ".mysqli_error($con);
}
?>
