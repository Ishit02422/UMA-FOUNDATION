<?php
session_start();
include "../connect.php";
require('../razorpay-php-2.9.0/Razorpay.php');
use Razorpay\Api\Api;

// Razorpay API key and secret
$api_key = 'rzp_test_qxeuAYL6jOqDSW';  // Replace with your Razorpay API key
$api_secret = 'IxoRKz8mHWNvDpWmN5n74wpI';       // Replace with your Razorpay API secret

// Create Razorpay API instance
$api = new Api($api_key, $api_secret);

// Fetch payment details from POST request
$payment_id = $_POST['payment_id'];
$order_id = $_POST['order_id'];
$razorpay_signature = $_POST['signature'];

// Other form data
$name = $_POST['name'];
$date = $_POST['date'];
$typeid = $_SESSION['typeid'];
$price = $_SESSION["price"]; // Price should be stored in session before creating order

try {
    // Verify the payment signature
    $generated_signature = hash_hmac('sha256', $order_id . '|' . $payment_id, $api_secret);

    if ($generated_signature === $razorpay_signature) {
        // Payment is verified successfully

        // Insert donation record into the database
        $transaction_id = $payment_id; // Use Razorpay payment ID as transaction ID
        $sql = "INSERT INTO tbl_donation (price, name, date, status, transaction_id, typeid) 
                VALUES ('$price', '$name', '$date', 1, '$transaction_id', '$typeid')";

        if (mysqli_query($con, $sql)) {
            // Record inserted successfully, send success response
            echo true;
        } else {
            // Error inserting record into the database
            echo "Error inserting record: " . mysqli_error($con);
        }
    } else {
        // Signature verification failed
        echo "Payment verification failed!";
    }
} catch (Exception $e) {
    // Handle any errors during the process
    echo 'Error: ' . $e->getMessage();
}
?>
