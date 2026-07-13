<?php 
require('../razorpay-php-2.9.0/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\Error;
session_start();

// Use your actual Razorpay keys here
$api = new Api('rzp_test_TCIyxi95KsBYIP', 'MI59ZxVZuArG3z2c8Agm89AT');

// Get form data from the request
$name = $_POST['name'] ?? 'Unknown';
$email = "umafoundation123@gmail.com";
$contact = '123';
$amount = $_POST['amount'] ?? 0; // Amount to be donated, in rupees
$_SESSION['price'] = $amount; // Store the price in session for later use

// Convert amount to smallest currency unit (paise) and ensure it is an integer
$amount_in_paise = intval($amount * 100);

try {
    // Create an order in Razorpay
    $orderData = [
        'receipt'         => 'rcptid_' . time(),
        'amount'          => $amount_in_paise, // Amount in paise
        'currency'        => 'INR',
        'payment_capture' => 1 // Auto capture payment
    ];

    $razorpayOrder = $api->order->create($orderData);

    // Prepare the response to send back to the client-side AJAX
    $response = [
        'order_id' => $razorpayOrder['id'], // Razorpay Order ID
        'amount' => $razorpayOrder['amount'], // Amount in paise
        'donor_name' => $name,
        'email' => $email,
        'contact' => $contact
    ];

    // Send the order details as JSON response
    echo json_encode($response);
} catch (Exception $e) {
    // Handle error and send back JSON formatted error message
    echo json_encode(['error' => 'Razorpay Error: ' . $e->getMessage()]);
}
?>
